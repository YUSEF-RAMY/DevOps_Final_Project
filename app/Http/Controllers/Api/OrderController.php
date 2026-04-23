<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Support\CurrencyManager;
use App\Models\ShippingSetting;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        if ($perPage < 1) { $perPage = 20; }
        if ($perPage > 100) { $perPage = 100; }
        $orders = Order::where('user_id', $request->user()->id)
            ->latest()
            ->paginate($perPage);
        $data = $orders->getCollection()->map(fn ($o) => $this->orderSummary($o));
        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    public function show(Request $request, int $id)
    {
        $order = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);
        return response()->json($this->orderResource($order));
    }

    public function place(Request $request)
    {
        $request->validate([
            'billing_name' => ['required','string','max:255'],
            'billing_email' => ['required','email'],
            'billing_phone' => ['required','string','max:20'],
            'billing_division' => ['nullable','string','max:255'],
            'billing_district' => ['nullable','string','max:255'],
            'billing_upazila' => ['nullable','string','max:255'],
            'billing_address' => ['nullable','string','max:500'],
            'billing_postcode' => ['nullable','string','max:20'],
            'billing_country' => ['nullable','string','max:255'],
            'shipping_name' => ['nullable','string','max:255'],
            'shipping_phone' => ['nullable','string','max:20'],
            'shipping_division' => ['nullable','string','max:255'],
            'shipping_district' => ['nullable','string','max:255'],
            'shipping_upazila' => ['nullable','string','max:255'],
            'shipping_address' => ['nullable','string','max:500'],
            'shipping_postcode' => ['nullable','string','max:20'],
            'shipping_country' => ['nullable','string','max:255'],
            'gateway' => ['required','in:bkash,nagad,rocket,ssl_commerce,cod,stripe,paypal'],
        ]);

        $cart = Cart::where('user_id', $request->user()->id)->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 422);
        }
        foreach ($cart->items as $ci) {
            if (!$ci->product || !$ci->product->is_active || (int) $ci->product->stock <= 0) {
                return response()->json(['message' => 'Some items are out of stock.'], 422);
            }
            if ($ci->quantity > (int) $ci->product->stock) {
                return response()->json(['message' => 'Some item quantities exceed stock.'], 422);
            }
        }

        $order = new Order();
        $order->fill($request->only([
            'billing_name', 'billing_email', 'billing_phone', 'billing_address', 'billing_postcode', 'billing_country',
            'billing_division', 'billing_district', 'billing_upazila',
            'shipping_name', 'shipping_phone', 'shipping_address', 'shipping_postcode', 'shipping_country',
            'shipping_division', 'shipping_district', 'shipping_upazila',
        ]));
        $order->number = strtoupper(Str::random(10));
        $order->user_id = $request->user()->id;
        $order->status = 'pending';
        $order->subtotal = $cart->subtotal;
        $order->discount_total = $cart->discount_total;
        
        // Recalculate shipping and tax based on Bangladeshi settings
        $shipping = 0.0;
        $tax = 0.0;
        try {
            $s = ShippingSetting::get();
            $taxableAmount = $cart->subtotal - $cart->discount_total;
            
            if ($s->enabled) {
                if ($s->free_shipping_enabled && $taxableAmount >= (float) $s->free_shipping_min_total) {
                    $shipping = 0.0;
                } else {
                    $division = trim((string) ($request->input('billing_division') ?: ''));
                    $district = trim((string) ($request->input('billing_district') ?: ''));
                    
                    $found = null;
                    if ($district && !empty($s->district_rates)) {
                        $districtRates = (array) ($s->district_rates ?? []);
                        foreach ($districtRates as $conf) {
                            if (!is_array($conf)) continue;
                            $d = trim((string) ($conf['district'] ?? ''));
                            if ($d && strcasecmp($d, $district) === 0) {
                                $found = $conf;
                                break;
                            }
                        }
                    }
                    
                    if (!$found && $division && !empty($s->division_rates)) {
                        $divisionRates = (array) ($s->division_rates ?? []);
                        foreach ($divisionRates as $conf) {
                            if (!is_array($conf)) continue;
                            $div = trim((string) ($conf['division'] ?? ''));
                            if ($div && strcasecmp($div, $division) === 0) {
                                $found = $conf;
                                break;
                            }
                        }
                    }
                    
                    if ($found) {
                        $type = $found['type'] ?? 'flat';
                        $amount = (float) ($found['amount'] ?? 0);
                        if ($type === 'percent') {
                            $shipping = round($taxableAmount * ($amount/100), 2);
                        } else {
                            $shipping = $amount;
                        }
                    } else if ($s->flat_rate > 0) {
                        $shipping = (float) $s->flat_rate;
                    }
                }
            }
            
            // Calculate tax
            if ($s && $s->tax_enabled && $s->tax_rate > 0) {
                if ($s->tax_type === 'percent') {
                    $tax = round($taxableAmount * ($s->tax_rate / 100), 2);
                } else {
                    $tax = round((float) $s->tax_rate, 2);
                }
            }
        } catch (\Throwable $e) {}
        
        $order->tax_total = $tax;
        $order->shipping_total = $shipping;
        $order->grand_total = (float) $order->subtotal - (float) $order->discount_total + (float) $order->tax_total + (float) $order->shipping_total;
        $order->currency = 'BDT'; // Default to Bangladeshi Taka
        $order->payment_method = $request->string('gateway');
        $order->payment_status = 'unpaid';
        $order->shipping_status = 'unshipped';
        
        // Save order first to get the ID
        $order->save();
        
        // Process payment for mobile banking gateways
        $gatewayName = $request->string('gateway');
        if (in_array($gatewayName, ['bkash', 'nagad', 'rocket', 'ssl_commerce'])) {
            $gatewayManager = new \App\Http\Controllers\PaymentGateway\PaymentGatewayManager();
            $gateway = $gatewayManager->getGateway($gatewayName);
            if ($gateway) {
                $paymentData = [
                    'amount' => (float) $order->grand_total,
                    'currency' => 'BDT',
                    'order_id' => $order->id,
                    'customer_name' => $order->billing_name,
                    'customer_email' => $order->billing_email,
                    'customer_phone' => $order->billing_phone,
                    'customer_address' => $order->billing_address,
                    'customer_district' => $order->billing_district,
                    'customer_division' => $order->billing_division,
                    'customer_upazila' => $order->billing_upazila,
                    'customer_postcode' => $order->billing_postcode,
                ];
                try {
                    $paymentResult = $gateway->processPayment($paymentData);
                    if ($paymentResult['success'] ?? false) {
                        $order->payment_transaction_id = $paymentResult['transaction_id'] ?? $paymentResult['payment_id'] ?? null;
                        $order->payment_transaction_details = json_encode($paymentResult);
                        $order->save(); // Update order with payment transaction details
                    }
                } catch (\Exception $e) {
                    // Log error but don't fail the order
                    \Log::error('Payment processing error: ' . $e->getMessage());
                }
            }
        }

        foreach ($cart->items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'product_sku' => $cartItem->product->sku,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->unit_price,
                'line_total' => $cartItem->line_total,
            ]);
        }

        $cart->items()->delete();
        $cart->delete();

        return response()->json($this->orderResource($order->load('items.product')), 201);
    }

    private function money(float $amount): array
    {
        return [
            'amount' => $amount,
            'formatted' => CurrencyManager::format($amount),
        ];
    }

    private function orderSummary(Order $o): array
    {
        return [
            'id' => $o->id,
            'number' => $o->number,
            'status' => $o->status,
            'grand_total' => $this->money((float) $o->grand_total),
            'created_at' => $o->created_at?->toIso8601String(),
        ];
    }

    private function orderResource(Order $o): array
    {
        return [
            'id' => $o->id,
            'number' => $o->number,
            'status' => $o->status,
            'payment_status' => $o->payment_status,
            'shipping_status' => $o->shipping_status,
            'totals' => [
                'subtotal' => $this->money((float) $o->subtotal),
                'discount_total' => $this->money((float) $o->discount_total),
                'tax_total' => $this->money((float) $o->tax_total),
                'shipping_total' => $this->money((float) $o->shipping_total),
                'grand_total' => $this->money((float) $o->grand_total),
            ],
            'currency' => $o->currency,
            'items' => $o->items->map(function ($it) {
                return [
                    'id' => $it->id,
                    'product' => $it->product ? [
                        'id' => $it->product->id,
                        'name' => $it->product->name,
                        'slug' => $it->product->slug,
                        'sku' => $it->product->sku,
                    ] : null,
                    'quantity' => (int) $it->quantity,
                    'unit_price' => $this->money((float) $it->unit_price),
                    'line_total' => $this->money((float) $it->line_total),
                ];
            }),
            'billing' => [
                'name' => $o->billing_name,
                'email' => $o->billing_email,
                'phone' => $o->billing_phone,
                'address' => $o->billing_address,
                'postcode' => $o->billing_postcode,
                'country' => $o->billing_country,
                'division' => $o->billing_division,
                'district' => $o->billing_district,
                'upazila' => $o->billing_upazila,
            ],
            'shipping' => [
                'name' => $o->shipping_name,
                'phone' => $o->shipping_phone,
                'address' => $o->shipping_address,
                'postcode' => $o->shipping_postcode,
                'country' => $o->shipping_country,
                'division' => $o->shipping_division,
                'district' => $o->shipping_district,
                'upazila' => $o->shipping_upazila,
            ],
            'payment_transaction_id' => $o->payment_transaction_id,
            'shipping_courier' => $o->shipping_courier,
            'shipping_tracking_number' => $o->shipping_tracking_number,
            'created_at' => $o->created_at?->toIso8601String(),
        ];
    }
}


