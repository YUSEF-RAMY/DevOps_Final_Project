@php
  $s = $siteSettings ?? null;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice {{ $order->number }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
      .no-print { display: none !important; }
      body { margin: 0; }
      .container { width: 100%; max-width: 100%; padding: 0 24px; }
      a { text-decoration: none; color: inherit; }
    }
    .invoice-box { background: #fff; border: 1px solid #e9ecef; border-radius: .5rem; padding: 24px; }
    .table> :not(caption)>*>*{ padding: .5rem .5rem; }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function(){
      if(new URLSearchParams(window.location.search).get('print')==='1'){
        setTimeout(()=>window.print(), 150);
      }
    });
  </script>
</head>
<body class="bg-light">
  <div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
      <a href="{{ route('admin.orders.show',$order) }}" class="btn btn-outline-secondary">Back</a>
      <div class="d-flex gap-2">
        <a href="?print=1" class="btn btn-primary" onclick="setTimeout(()=>window.print(),50); return true;"><i class="bi bi-printer me-1"></i> Print / Save PDF</a>
      </div>
    </div>

    <div class="invoice-box shadow-sm">
      <div class="row align-items-start mb-4">
        <div class="col-8">
          <h2 class="mb-1">Invoice</h2>
          <div class="text-muted">Order #: {{ $order->number }}</div>
          <div class="text-muted">Date: @formatDate($order->created_at)</div>
        </div>
        <div class="col-4 text-end">
          @if($s && ($s->site_name ?? false))
            <div class="fw-bold">{{ $s->site_name }}</div>
          @else
            <div class="fw-bold">E-Commerce</div>
          @endif
          @if($s && ($s->contact_email ?? false))
            <div class="text-muted">{{ $s->contact_email }}</div>
          @endif
          @if($s && ($s->contact_phone ?? false))
            <div class="text-muted">{{ $s->contact_phone }}</div>
          @endif
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <div class="fw-semibold mb-1">Bill To</div>
          <div>{{ $order->billing_name ?: ($order->user->name ?? '-') }}</div>
          <div class="text-muted">{{ $order->billing_email ?: ($order->user->email ?? '-') }}</div>
          <div class="text-muted">{{ $order->billing_phone ?: ($order->user->phone ?? '-') }}</div>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
          <div><span class="text-muted">Status:</span> <span class="fw-semibold">{{ ucfirst($order->status) }}</span></div>
          <div><span class="text-muted">Payment:</span> <span class="fw-semibold">{{ ucfirst($order->payment_status ?? 'paid') }}</span></div>
          <div><span class="text-muted">Currency:</span> <span class="fw-semibold">{{ $order->currency ?: ($currentCurrency->code ?? '') }}</span></div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Product</th>
              <th>SKU</th>
              <th class="text-end">Qty</th>
              <th class="text-end">Unit Price</th>
              <th class="text-end">Line Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->items as $item)
            <tr>
              <td>{{ $item->product_name }}</td>
              <td class="text-muted">{{ $item->product_sku }}</td>
              <td class="text-end">{{ $item->quantity }}</td>
              <td class="text-end">@currency($item->unit_price)</td>
              <td class="text-end">@currency($item->line_total)</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="row justify-content-end mt-3">
        <div class="col-md-6">
          <table class="table table-sm mb-0">
            <tr>
              <td class="text-muted">Subtotal</td>
              <td class="text-end">@currency($order->subtotal)</td>
            </tr>
            @if((float)$order->discount_total > 0)
            <tr>
              <td class="text-muted">Discount</td>
              <td class="text-end">-@currency($order->discount_total)</td>
            </tr>
            @endif
            <tr>
              <td class="text-muted">Tax</td>
              <td class="text-end">@currency($order->tax_total)</td>
            </tr>
            <tr>
              <td class="text-muted">Shipping</td>
              <td class="text-end">@currency($order->shipping_total)</td>
            </tr>
            <tr class="table-light">
              <th>Total</th>
              <th class="text-end">@currency($order->grand_total)</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


