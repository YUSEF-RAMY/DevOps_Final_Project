<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Support\CurrencyManager;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(20);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function invoice(Order $order)
    {
        $order->load(['user', 'items']);
        return view('admin.orders.invoice', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:unpaid,paid,refunded',
            'shipping_status' => 'required|in:unshipped,shipped,delivered',
        ]);

        $order->update($request->only(['status', 'payment_status', 'shipping_status']));

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully');
    }

    public function create()
    {
        $q = request()->string('q')->toString();
        $query = Product::query()->where('is_active', true);
        if ($q !== '') {
            $query->where(function($qq) use ($q){
                $qq->where('name','like',"%$q%")
                   ->orWhere('sku','like',"%$q%")
                   ->orWhere('id', $q);
            });
        }
        $products = $query->orderBy('name')->paginate(24)->withQueryString(['q']);
        return view('admin.orders.create', compact('products','q'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_identifier' => ['nullable','string','max:191'],
            'billing_name' => ['nullable','string','max:191'],
            'billing_email' => ['nullable','string','max:191'],
            'billing_phone' => ['nullable','string','max:50'],
            'items' => ['required','array','min:1'],
            'items.*.product_id' => ['required','integer','exists:products,id'],
            'items.*.quantity' => ['required','integer','min:1'],
            'items.*.unit_price' => ['nullable','numeric','min:0'],
            'discount_total' => ['nullable','numeric'],
            'tax_total' => ['nullable','numeric'],
            'shipping_total' => ['nullable','numeric'],
        ]);

        $user = null;
        if (!empty($data['user_identifier'])) {
            $uid = $data['user_identifier'];
            $user = User::where('id', $uid)
                ->orWhere('email', $uid)
                ->orWhere('phone', $uid)
                ->first();
        }

        if (!$user && empty($data['billing_name'])) {
            return back()->withErrors(['billing_name' => 'Provide billing_name for guest order or select a user'])->withInput();
        }

        $products = Product::whereIn('id', collect($data['items'])->pluck('product_id'))
            ->get(['id','name','sku','price','stock','is_active'])
            ->keyBy('id');

        $lines = [];
        $subtotal = 0;
        foreach ($data['items'] as $line) {
            $p = $products[$line['product_id']] ?? null;
            if (!$p || !$p->is_active) {
                return back()->withErrors(['items' => 'One or more products are inactive'])->withInput();
            }
            $qty = (int) $line['quantity'];
            $unit = array_key_exists('unit_price', $line) && $line['unit_price'] !== null ? (float) $line['unit_price'] : (float) $p->price;
            $total = $unit * $qty;
            $subtotal += $total;
            $lines[] = [
                'product_id' => $p->id,
                'product_name' => $p->name,
                'product_sku' => $p->sku,
                'quantity' => $qty,
                'unit_price' => $unit,
                'line_total' => $total,
            ];
        }

        $discount = (float) ($data['discount_total'] ?? 0.0);
        $tax = (float) ($data['tax_total'] ?? 0.0);
        $shipping = (float) ($data['shipping_total'] ?? 0.0);
        $grand = $subtotal - $discount + $tax + $shipping;

        $order = null;
        DB::transaction(function () use (&$order, $user, $data, $subtotal, $discount, $tax, $shipping, $grand, $lines) {
            $billingName = $user?->name ?: ($data['billing_name'] ?? '');
            $billingEmail = $user?->email ?: ($data['billing_email'] ?? '');
            $billingPhone = $user?->phone ?: ($data['billing_phone'] ?? '');
            $order = Order::create([
                'number' => 'POS-'.now()->format('Ymd-His').'-'.rand(100,999),
                'user_id' => $user?->id,
                'status' => 'processing',
                'payment_status' => 'paid',
                'shipping_status' => 'unshipped',
                'subtotal' => $subtotal,
                'discount_total' => $discount,
                'tax_total' => $tax,
                'shipping_total' => $shipping,
                'grand_total' => $grand,
                'currency' => CurrencyManager::current()->code,
                'billing_name' => $billingName,
                'billing_email' => $billingEmail,
                'billing_phone' => $billingPhone,
            ]);
            foreach ($lines as $li) {
                OrderItem::create($li + ['order_id' => $order->id]);
            }
        });

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order created');
    }
}