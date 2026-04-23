<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Payment - {{ $gateway_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .payment-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            padding: 40px;
        }
        .gateway-icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 20px;
        }
        .amount-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }
        .order-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .btn-payment {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            color: white;
            transition: transform 0.2s;
        }
        .btn-payment:hover {
            transform: translateY(-2px);
            color: white;
        }
        .btn-cancel {
            background: #6c757d;
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            color: white;
        }
        .btn-cancel:hover {
            background: #5a6268;
            color: white;
        }
        .sandbox-badge {
            background: #ffc107;
            color: #000;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="payment-container text-center">
        <div class="sandbox-badge">
            <i class="bi bi-shield-check me-1"></i>Sandbox Mode - Testing
        </div>
        
        <div class="gateway-icon">
            @if($gateway === 'bKash')
                <i class="bi bi-phone"></i>
            @elseif($gateway === 'Nagad')
                <i class="bi bi-phone"></i>
            @elseif($gateway === 'Rocket')
                <i class="bi bi-phone"></i>
            @endif
        </div>
        
        <h2 class="mb-3">{{ $gateway_name }} Payment</h2>
        
        <div class="amount-display">
            ৳{{ number_format($amount, 2) }}
        </div>
        
        <div class="order-info text-start">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Order ID:</span>
                <strong>#{{ $order->id }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Transaction ID:</span>
                <strong>{{ $transaction_id }}</strong>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Customer:</span>
                <strong>{{ $order->billing_name }}</strong>
            </div>
        </div>
        
        <p class="text-muted mb-4">
            Enter your {{ $gateway_name }} mobile number and PIN to complete the payment.
        </p>
        
        <form action="{{ $complete_url }}" method="POST" id="paymentForm">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
            <input type="hidden" name="status" value="success" id="payment_status">
            
            <div class="mb-3 text-start">
                <label for="mobile_number" class="form-label fw-semibold">
                    <i class="bi bi-phone me-1"></i>Mobile Number
                </label>
                <input type="tel" 
                       class="form-control form-control-lg" 
                       id="mobile_number" 
                       name="mobile_number" 
                       placeholder="01XXXXXXXXX" 
                       pattern="[0-9]{11}" 
                       required>
                <small class="text-muted">Enter your {{ $gateway_name }} registered mobile number</small>
            </div>
            
            <div class="mb-4 text-start">
                <label for="pin" class="form-label fw-semibold">
                    <i class="bi bi-lock me-1"></i>PIN
                </label>
                <input type="password" 
                       class="form-control form-control-lg" 
                       id="pin" 
                       name="pin" 
                       placeholder="Enter your PIN" 
                       maxlength="6" 
                       pattern="[0-9]{4,6}" 
                       required>
                <small class="text-muted">Enter your {{ $gateway_name }} PIN</small>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-payment" id="successBtn">
                    <i class="bi bi-check-circle me-2"></i>Pay ৳{{ number_format($amount, 2) }}
                </button>
                <button type="button" class="btn btn-cancel" onclick="cancelPayment()">
                    <i class="bi bi-x-circle me-2"></i>Cancel Payment
                </button>
            </div>
        </form>
        
        <div class="mt-4">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                This is a sandbox payment page for testing purposes.
            </small>
        </div>
    </div>
    
    <script>
        function cancelPayment() {
            Swal.fire({
                icon: 'warning',
                title: 'Cancel Payment?',
                text: 'Are you sure you want to cancel this payment?',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Cancel',
                cancelButtonText: 'No, Continue'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('payment_status').value = 'failed';
                    document.getElementById('paymentForm').submit();
                }
            });
        }
    </script>
</body>
</html>

