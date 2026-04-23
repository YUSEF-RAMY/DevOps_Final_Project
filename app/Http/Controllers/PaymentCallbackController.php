<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PaymentGateway\PaymentGatewayManager;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    /**
     * SSL Commerce Success Callback
     */
    public function sslCommerceSuccess(Request $request)
    {
        try {
            $tranId = $request->input('tran_id');
            $valId = $request->input('val_id');
            $status = $request->input('status');
            $amount = $request->input('amount');
            
            // Extract order ID from transaction ID (format: SSL_ORDERID_TIMESTAMP)
            $orderId = null;
            if ($tranId && preg_match('/SSL_(\d+)_/', $tranId, $matches)) {
                $orderId = $matches[1];
            }
            
            if (!$orderId) {
                return redirect()->route('checkout.show')->with('error', 'Invalid payment response.');
            }
            
            $order = Order::find($orderId);
            if (!$order) {
                return redirect()->route('checkout.show')->with('error', 'Order not found.');
            }
            
            // Verify payment with SSL Commerce
            $gatewayManager = new PaymentGatewayManager();
            $gateway = $gatewayManager->getGateway('ssl_commerce');
            
            if ($gateway && $status === 'VALID') {
                // Verify payment
                $verification = $gateway->verifyPayment($valId);
                
                if ($verification['success'] ?? false) {
                    $order->payment_status = 'paid';
                    $order->payment_transaction_id = $valId;
                    $order->save();
                    
                    // Clear cart if exists
                    if (auth()->check()) {
                        $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                        if ($cart) {
                            $cart->items()->delete();
                            $cart->delete();
                        }
                    }
                    
                    return redirect()->route('orders.show', $order->id)
                        ->with('success', 'Payment successful! Your order has been confirmed.');
                }
            }
            
            return redirect()->route('orders.show', $order->id)
                ->with('warning', 'Payment is being processed. Please wait for confirmation.');
                
        } catch (\Exception $e) {
            Log::error('SSL Commerce success callback error: ' . $e->getMessage());
            return redirect()->route('checkout.show')->with('error', 'Payment verification failed.');
        }
    }
    
    /**
     * SSL Commerce Fail Callback
     */
    public function sslCommerceFail(Request $request)
    {
        $tranId = $request->input('tran_id');
        $orderId = null;
        
        if ($tranId && preg_match('/SSL_(\d+)_/', $tranId, $matches)) {
            $orderId = $matches[1];
        }
        
        if ($orderId) {
            $order = Order::find($orderId);
            if ($order) {
                $order->payment_status = 'failed';
                $order->save();
            }
        }
        
        return redirect()->route('checkout.show')
            ->with('error', 'Payment failed. Please try again or choose a different payment method.');
    }
    
    /**
     * SSL Commerce Cancel Callback
     */
    public function sslCommerceCancel(Request $request)
    {
        $tranId = $request->input('tran_id');
        $orderId = null;
        
        if ($tranId && preg_match('/SSL_(\d+)_/', $tranId, $matches)) {
            $orderId = $matches[1];
        }
        
        if ($orderId) {
            $order = Order::find($orderId);
            if ($order) {
                return redirect()->route('orders.show', $order->id)
                    ->with('info', 'Payment was cancelled. You can complete the payment later.');
            }
        }
        
        return redirect()->route('checkout.show')
            ->with('info', 'Payment was cancelled.');
    }
    
    /**
     * Stripe Success Callback
     */
    public function stripeSuccess(Request $request)
    {
        try {
            $sessionId = $request->input('session_id');
            
            if (!$sessionId) {
                return redirect()->route('checkout.show')->with('error', 'Invalid payment session.');
            }
            
            // Verify with Stripe
            $gatewayManager = new PaymentGatewayManager();
            $gateway = $gatewayManager->getGateway('stripe');
            
            if ($gateway) {
                $session = \Stripe\Checkout\Session::retrieve($sessionId);
                
                if ($session->payment_status === 'paid') {
                    // Extract order ID from metadata
                    $orderId = $session->metadata->order_id ?? null;
                    
                    if ($orderId) {
                        $order = Order::find($orderId);
                        if ($order) {
                            $order->payment_status = 'paid';
                            $order->payment_transaction_id = $sessionId;
                            $order->save();
                            
                            // Clear cart
                            if (auth()->check()) {
                                $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                                if ($cart) {
                                    $cart->items()->delete();
                                    $cart->delete();
                                }
                            }
                            
                            return redirect()->route('orders.show', $order->id)
                                ->with('success', 'Payment successful! Your order has been confirmed.');
                        }
                    }
                }
            }
            
            return redirect()->route('orders.index')
                ->with('success', 'Payment successful!');
                
        } catch (\Exception $e) {
            Log::error('Stripe success callback error: ' . $e->getMessage());
            return redirect()->route('checkout.show')->with('error', 'Payment verification failed.');
        }
    }
    
    /**
     * Stripe Cancel Callback
     */
    public function stripeCancel(Request $request)
    {
        return redirect()->route('checkout.show')
            ->with('info', 'Payment was cancelled.');
    }
    
    /**
     * PayPal Success Callback
     */
    public function paypalSuccess(Request $request)
    {
        try {
            // PayPal returns 'token' which is the order ID
            $token = $request->input('token');
            $orderId = $request->input('order_id');
            
            if (!$token) {
                return redirect()->route('checkout.show')->with('error', 'Invalid payment response from PayPal.');
            }
            
            // Verify with PayPal
            $gatewayManager = new PaymentGatewayManager();
            $gateway = $gatewayManager->getGateway('paypal');
            
            if ($gateway) {
                // Verify payment using the token (PayPal order ID)
                $verification = $gateway->verifyPayment($token);
                
                if ($verification['success'] ?? false && ($verification['paid'] ?? false)) {
                    // Get order ID from URL parameter or find by payment transaction
                    if (!$orderId) {
                        $order = Order::where('payment_transaction_id', $token)
                            ->orWhere('payment_transaction_details', 'like', '%' . $token . '%')
                            ->first();
                        if ($order) {
                            $orderId = $order->id;
                        }
                    }
                    
                    if ($orderId) {
                        $order = Order::find($orderId);
                        if ($order) {
                            $order->payment_status = 'paid';
                            $order->payment_transaction_id = $token;
                            $order->save();
                            
                            // Clear cart
                            if (auth()->check()) {
                                $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                                if ($cart) {
                                    $cart->items()->delete();
                                    $cart->delete();
                                }
                            }
                            
                            return redirect()->route('orders.show', $order->id)
                                ->with('success', 'Payment successful! Your order has been confirmed.');
                        }
                    }
                }
            }
            
            return redirect()->route('checkout.show')
                ->with('error', 'Payment verification failed. Please contact support.');
                
        } catch (\Exception $e) {
            Log::error('PayPal success callback error: ' . $e->getMessage());
            return redirect()->route('checkout.show')->with('error', 'Payment verification failed.');
        }
    }
    
    /**
     * PayPal Cancel Callback
     */
    public function paypalCancel(Request $request)
    {
        return redirect()->route('checkout.show')
            ->with('info', 'Payment was cancelled.');
    }
    
    /**
     * bKash Callback - Handle response from bKash payment gateway
     */
    public function bkashCallback(Request $request)
    {
        try {
            $paymentId = $request->input('paymentID');
            $status = $request->input('status');
            
            if (!$paymentId) {
                return redirect()->route('checkout.show')->with('error', 'Invalid payment response from bKash.');
            }
            
            // Get order from payment transaction details
            $order = Order::where('payment_transaction_id', 'like', '%' . $paymentId . '%')
                ->orWhere('payment_transaction_details', 'like', '%' . $paymentId . '%')
                ->first();
            
            if (!$order) {
                // Try to extract order ID from payment ID format: BKASH_{order_id}_{timestamp}
                if (preg_match('/BKASH_(\d+)_/', $paymentId, $matches)) {
                    $order = Order::find($matches[1]);
                }
            }
            
            if (!$order) {
                return redirect()->route('checkout.show')->with('error', 'Order not found.');
            }
            
            // Verify payment with bKash API - ALWAYS verify, don't trust the status parameter
            $gatewayManager = new PaymentGatewayManager();
            $gateway = $gatewayManager->getGateway('bkash');
            
            if (!$gateway) {
                Log::error('bKash gateway not found during callback');
                $order->payment_status = 'failed';
                $order->save();
                return redirect()->route('checkout.show')
                    ->with('error', 'Payment gateway error. Please contact support.');
            }
            
            // Always verify payment with bKash API, regardless of status parameter
            $verifyResult = $gateway->verifyPayment($paymentId);
            
            // Only mark as paid if verification is successful
            if ($verifyResult['success'] ?? false) {
                $order->payment_status = 'paid';
                $order->payment_transaction_id = $paymentId;
                $order->payment_transaction_details = json_encode($verifyResult);
                $order->save();
                
                // Clear cart
                if (auth()->check()) {
                    $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                    if ($cart) {
                        $cart->items()->delete();
                        $cart->delete();
                    }
                }
                
                return redirect()->route('orders.show', $order->id)
                    ->with('success', 'Payment successful! Your order has been confirmed.');
            }
            
            // Verification failed
            $order->payment_status = 'failed';
            $order->save();
            
            Log::warning('bKash payment verification failed', [
                'order_id' => $order->id,
                'payment_id' => $paymentId,
                'verification_result' => $verifyResult,
            ]);
            
            return redirect()->route('checkout.show')
                ->with('error', 'Payment verification failed. Please try again or contact support.');
                
        } catch (\Exception $e) {
            Log::error('bKash callback error: ' . $e->getMessage());
            return redirect()->route('checkout.show')->with('error', 'Payment processing error occurred.');
        }
    }
    
    /**
     * Nagad Callback - Handle response from Nagad payment gateway
     */
    public function nagadCallback(Request $request)
    {
        try {
            $paymentId = $request->input('payment_id') ?? $request->input('transaction_id');
            
            if (!$paymentId) {
                return redirect()->route('checkout.show')->with('error', 'Invalid payment response from Nagad.');
            }
            
            Log::info('Nagad callback received', $request->all());
            
            // Find order by payment transaction ID
            $order = Order::where('payment_transaction_id', $paymentId)
                ->orWhere('payment_transaction_details', 'like', '%' . $paymentId . '%')
                ->first();
            
            if (!$order) {
                // Try to extract order ID from payment ID format: NAGAD_{order_id}_{timestamp}
                if (preg_match('/NAGAD_(\d+)_/', $paymentId, $matches)) {
                    $order = Order::find($matches[1]);
                }
            }
            
            if (!$order) {
                return redirect()->route('checkout.show')->with('error', 'Order not found.');
            }
            
            // Verify payment with Nagad API - ALWAYS verify, don't trust status parameter
            $gatewayManager = new PaymentGatewayManager();
            $gateway = $gatewayManager->getGateway('nagad');
            
            if (!$gateway) {
                Log::error('Nagad gateway not found during callback');
                $order->payment_status = 'failed';
                $order->save();
                return redirect()->route('checkout.show')
                    ->with('error', 'Payment gateway error. Please contact support.');
            }
            
            // Always verify payment with Nagad API
            $verifyResult = $gateway->verifyPayment($paymentId);
            
            // Only mark as paid if verification is successful
            if ($verifyResult['success'] ?? false) {
                $order->payment_status = 'paid';
                $order->payment_transaction_id = $paymentId;
                $order->payment_transaction_details = json_encode($verifyResult);
                $order->save();
                
                // Clear cart
                if (auth()->check()) {
                    $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                    if ($cart) {
                        $cart->items()->delete();
                        $cart->delete();
                    }
                }
                
                return redirect()->route('orders.show', $order->id)
                    ->with('success', 'Payment successful! Your order has been confirmed.');
            }
            
            // Verification failed
            $order->payment_status = 'failed';
            $order->save();
            
            Log::warning('Nagad payment verification failed', [
                'order_id' => $order->id,
                'payment_id' => $paymentId,
                'verification_result' => $verifyResult,
            ]);
            
            return redirect()->route('checkout.show')
                ->with('error', 'Payment verification failed. Please try again or contact support.');
                
        } catch (\Exception $e) {
            Log::error('Nagad callback error: ' . $e->getMessage());
            return redirect()->route('checkout.show')->with('error', 'Payment processing error occurred.');
        }
    }
    
    /**
     * Rocket Callback - Handle response from Rocket payment gateway
     */
    public function rocketCallback(Request $request)
    {
        try {
            $paymentId = $request->input('payment_id') ?? $request->input('transaction_id');
            
            if (!$paymentId) {
                return redirect()->route('checkout.show')->with('error', 'Invalid payment response from Rocket.');
            }
            
            Log::info('Rocket callback received', $request->all());
            
            // Find order by payment transaction ID
            $order = Order::where('payment_transaction_id', $paymentId)
                ->orWhere('payment_transaction_details', 'like', '%' . $paymentId . '%')
                ->first();
            
            if (!$order) {
                // Try to extract order ID from payment ID format: ROCKET_{order_id}_{timestamp}
                if (preg_match('/ROCKET_(\d+)_/', $paymentId, $matches)) {
                    $order = Order::find($matches[1]);
                }
            }
            
            if (!$order) {
                return redirect()->route('checkout.show')->with('error', 'Order not found.');
            }
            
            // Verify payment with Rocket API - ALWAYS verify, don't trust status parameter
            $gatewayManager = new PaymentGatewayManager();
            $gateway = $gatewayManager->getGateway('rocket');
            
            if (!$gateway) {
                Log::error('Rocket gateway not found during callback');
                $order->payment_status = 'failed';
                $order->save();
                return redirect()->route('checkout.show')
                    ->with('error', 'Payment gateway error. Please contact support.');
            }
            
            // Always verify payment with Rocket API
            $verifyResult = $gateway->verifyPayment($paymentId);
            
            // Only mark as paid if verification is successful
            if ($verifyResult['success'] ?? false) {
                $order->payment_status = 'paid';
                $order->payment_transaction_id = $paymentId;
                $order->payment_transaction_details = json_encode($verifyResult);
                $order->save();
                
                // Clear cart
                if (auth()->check()) {
                    $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                    if ($cart) {
                        $cart->items()->delete();
                        $cart->delete();
                    }
                }
                
                return redirect()->route('orders.show', $order->id)
                    ->with('success', 'Payment successful! Your order has been confirmed.');
            }
            
            // Verification failed
            $order->payment_status = 'failed';
            $order->save();
            
            Log::warning('Rocket payment verification failed', [
                'order_id' => $order->id,
                'payment_id' => $paymentId,
                'verification_result' => $verifyResult,
            ]);
            
            return redirect()->route('checkout.show')
                ->with('error', 'Payment verification failed. Please try again or contact support.');
                
        } catch (\Exception $e) {
            Log::error('Rocket callback error: ' . $e->getMessage());
            return redirect()->route('checkout.show')->with('error', 'Payment processing error occurred.');
        }
    }
}

