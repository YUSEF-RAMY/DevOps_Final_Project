@extends('admin.layouts.app')

@section('title', 'Create Order (POS)')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><i class="bi bi-bag-plus me-2"></i>Create Order (POS)</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back to Orders</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger">
        <div class="fw-semibold mb-1">Please fix the following and try again:</div>
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="post" action="{{ route('admin.orders.store') }}" id="posForm">
        @csrf
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">User (ID / Email / Phone)</label>
            <div class="input-group">
              <input type="text" name="user_identifier" class="form-control" id="user_identifier" placeholder="e.g. 3 or user@example.com or 018..." value="{{ old('user_identifier') }}">
              <button class="btn btn-outline-secondary" type="button" id="fetchUserBtn">Fetch</button>
              <button class="btn btn-outline-warning" type="button" id="clearUserBtn">Clear</button>
            </div>
            <div class="form-text">Leave empty for guest order; fill billing fields below. Fetch will auto-fill from user.</div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Billing Name (guest)</label>
            <input type="text" name="billing_name" class="form-control" value="{{ old('billing_name') }}">
          </div>
          <div class="col-md-2">
            <label class="form-label">Billing Email (guest)</label>
            <input type="email" name="billing_email" class="form-control" value="{{ old('billing_email') }}">
          </div>
          <div class="col-md-2">
            <label class="form-label">Billing Phone (guest)</label>
            <input type="text" name="billing_phone" class="form-control" value="{{ old('billing_phone') }}">
          </div>
        </div>

        <hr class="my-4">

        <h5 class="mb-2">Items</h5>
        
        <div class="table-responsive">
          <table class="table table-bordered align-middle" id="itemsTable">
            <thead>
              <tr>
                <th style="width:45%">Product</th>
                <th style="width:15%">Unit Price</th>
                <th style="width:15%">Qty</th>
                <th style="width:15%">Line Total</th>
                <th style="width:10%"></th>
              </tr>
            </thead>
            <tbody id="itemsWrap">
              <!-- rows inserted here -->
            </tbody>
          </table>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary mt-2" id="browseBtn"><i class="bi bi-grid"></i> Browse Products</button>

        <div class="mt-4">
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label">Coupon Code</label>
              <div class="input-group">
                <input type="text" class="form-control" id="coupon_code" placeholder="Enter coupon code">
                <button class="btn btn-outline-secondary" type="button" id="applyCouponBtn">Apply</button>
              </div>
              <div class="form-text" id="couponFeedback"></div>
            </div>
          </div>

          <div class="row g-2 justify-content-end mt-2">
            <div class="col-auto">
              <label class="form-label">Discount</label>
              <input type="number" step="0.01" class="form-control text-end" id="discount_total" name="discount_total" value="0">
            </div>
            <div class="col-auto">
              <label class="form-label">Tax</label>
              <input type="number" step="0.01" class="form-control text-end" id="tax_total" name="tax_total" value="0">
            </div>
            <div class="col-auto">
              <label class="form-label">Shipping</label>
              <input type="number" step="0.01" class="form-control text-end" id="shipping_total" name="shipping_total" value="0">
            </div>
            <div class="col-auto d-flex align-items-end">
              <div class="fs-6 text-muted me-3"><strong>Items Subtotal:</strong> <span id="subtotal">0.00</span></div>
              <div class="fs-5"><strong>Total:</strong> <span id="grand_total">0.00</span></div>
            </div>
          </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
          <button class="btn btn-primary" type="submit"><i class="bi bi-save me-1"></i>Create Order</button>
        </div>
      </form>
    </div>
  </div>
</div>

<datalist id="productsList">
  @foreach($products as $p)
    <option value="{{ $p->id }}">#{{ $p->id }} — {{ $p->name }} ({{ $p->sku }}) — {{ number_format($p->price,2) }}</option>
  @endforeach
  </datalist>

<template id="rowTpl">
  <tr class="item-row">
    <td>
      <div class="d-flex align-items-center gap-2">
        <span class="fw-semibold" data-field="product_name">(Select a product)</span>
        <span class="text-muted small" data-field="product_sku"></span>
      </div>
      <input type="hidden" data-field="product_id">
    </td>
    <td>
      <input type="number" step="0.01" min="0" class="form-control text-end" data-field="unit_price" value="0">
    </td>
    <td>
      <div class="input-group">
        <button class="btn btn-outline-secondary" type="button" data-qty="-1">-</button>
        <input type="number" min="1" value="1" class="form-control text-center" data-field="quantity">
        <button class="btn btn-outline-secondary" type="button" data-qty="1">+</button>
      </div>
    </td>
    <td class="text-end">
      <span data-field="line_total">0.00</span>
    </td>
    <td class="text-end">
      <button type="button" class="btn btn-outline-danger" data-action="remove"><i class="bi bi-x"></i></button>
    </td>
  </tr>
  </template>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
  const CURRENCY = {
    symbol: @json($currentCurrency->symbol ?? ''),
    symbol_first: @json((bool)($currentCurrency->symbol_first ?? true)),
    precision: @json((int)($currentCurrency->precision ?? 2)),
    decimal: @json($currentCurrency->decimal_separator ?? '.'),
    thousand: @json($currentCurrency->thousand_separator ?? ','),
  };
  function formatCurrency(value){
    const n = Number(value||0);
    const sign = n < 0 ? '-' : '';
    const abs = Math.abs(n);
    const fixed = abs.toFixed(CURRENCY.precision);
    const parts = fixed.split('.');
    let intPart = parts[0];
    const re = /(\d+)(\d{3})/;
    while(re.test(intPart)) { intPart = intPart.replace(re, `$1${CURRENCY.thousand}$2`); }
    const frac = parts.length > 1 ? CURRENCY.decimal + parts[1] : '';
    const num = sign + intPart + frac;
    return CURRENCY.symbol_first ? (sign + CURRENCY.symbol + intPart + frac).replace('--','-') : (num + ' ' + CURRENCY.symbol).trim();
  }
  const wrap = document.getElementById('itemsWrap');
  const tpl = document.getElementById('rowTpl');
  const addBtn = document.getElementById('addRowBtn');
  const subtotalEl = document.getElementById('subtotal');
  const form = document.getElementById('posForm');
  // product list add buttons
  const fetchUserBtn = document.getElementById('fetchUserBtn');
  const clearUserBtn = document.getElementById('clearUserBtn');
  const userInput = document.getElementById('user_identifier');
  const billName = document.querySelector('input[name="billing_name"]');
  const billEmail = document.querySelector('input[name="billing_email"]');
  const billPhone = document.querySelector('input[name="billing_phone"]');
  const browseBtn = document.getElementById('browseBtn');
  // Live totals recalc when discount/tax/shipping changes
  ['discount_total','tax_total','shipping_total'].forEach(id=>{
    const el = document.getElementById(id); if(!el) return;
    el.addEventListener('input', function(){ rebuildHiddenInputs(); });
  });
  const applyCouponBtn = document.getElementById('applyCouponBtn');
  const couponCodeInput = document.getElementById('coupon_code');
  const couponFeedback = document.getElementById('couponFeedback');
  const grandEl = document.getElementById('grand_total');

  function addRow(pid='', qty=1, meta){
    const node = tpl.content.cloneNode(true);
    const row = node.querySelector('.item-row');
    const pidEl = row.querySelector('[data-field="product_id"]');
    const qtyEl = row.querySelector('[data-field="quantity"]');
    const priceEl = row.querySelector('[data-field="unit_price"]');
    const nameEl = row.querySelector('[data-field="product_name"]');
    const skuEl = row.querySelector('[data-field="product_sku"]');
    const lineEl = row.querySelector('[data-field="line_total"]');
    pidEl.value = pid; qtyEl.value = qty;
    function recalc(){
      const q = Math.max(1, parseInt(qtyEl.value||'1',10));
      const up = Math.max(0, parseFloat(priceEl.value||'0'));
      lineEl.textContent = formatCurrency(q*up);
      rebuildHiddenInputs();
    }
    row.addEventListener('click', function(e){
      const b = e.target.closest('[data-qty]'); if(!b) return;
      e.preventDefault(); const d = parseInt(b.getAttribute('data-qty'),10);
      qtyEl.value = Math.max(1, parseInt(qtyEl.value||'1',10) + d);
      recalc();
    });
    row.addEventListener('input', function(e){ if(e.target===qtyEl || e.target===priceEl){ recalc(); }});
    wrap.appendChild(node);
    if(meta && meta.name){ nameEl.textContent = meta.name; }
    if(meta && typeof meta.sku !== 'undefined'){ skuEl.textContent = meta.sku ? `(${meta.sku})` : ''; }
    if(meta && typeof meta.price !== 'undefined' && meta.price !== null){ priceEl.value = Number(meta.price).toFixed(2); }
    if(pid && !(meta && meta.skipFetch === true)){
      fetch(`{{ url('/admin/products') }}/${pid}/json`, { headers:{ 'Accept':'application/json' }})
      .then(r=>r.json()).then(p=>{
        if(!p || p.is_active===false) return;
        if(!meta || !meta.name){ nameEl.textContent = p.name; }
        if(!meta || typeof meta.sku === 'undefined'){ skuEl.textContent = p.sku ? `(${p.sku})` : ''; }
        if(!meta || typeof meta.price === 'undefined') { priceEl.value = Number(p.display_price ?? p.price).toFixed(2); }
        recalc();
      }).catch(()=>{ recalc(); });
    } else {
      recalc();
    }
  }
  function rebuildHiddenInputs(){
    // remove previous hidden
    form.querySelectorAll('input[name^="items["]').forEach(e=>e.remove());
    const rows = wrap.querySelectorAll('.item-row');
    let idx = 0; let subtotal = 0;
    rows.forEach((r, i) => {
      const pid = r.querySelector('[data-field="product_id"]').value.trim();
      const qty = Math.max(1, parseInt(r.querySelector('[data-field="quantity"]').value||'1',10));
      const up  = Math.max(0, parseFloat(r.querySelector('[data-field="unit_price"]').value||'0'));
      if(!pid) return;
      const hi1 = document.createElement('input');
      hi1.type = 'hidden'; hi1.name = `items[${idx}][product_id]`; hi1.value = pid; form.appendChild(hi1);
      const hi2 = document.createElement('input');
      hi2.type = 'hidden'; hi2.name = `items[${idx}][quantity]`; hi2.value = String(qty); form.appendChild(hi2);
      const hi3 = document.createElement('input');
      hi3.type = 'hidden'; hi3.name = `items[${idx}][unit_price]`; hi3.value = String(up); form.appendChild(hi3);
      idx++;
    });
    // Compute client-side subtotal
    let running = 0;
    rows.forEach(r=>{
      const q = Math.max(1, parseInt(r.querySelector('[data-field="quantity"]').value||'1',10));
      const up = Math.max(0, parseFloat(r.querySelector('[data-field="unit_price"]').value||'0'));
      running += q*up;
    });
    const disc = Math.max(0, parseFloat(document.getElementById('discount_total').value||'0'));
    const tax  = Math.max(0, parseFloat(document.getElementById('tax_total').value||'0'));
    const ship = Math.max(0, parseFloat(document.getElementById('shipping_total').value||'0'));
    subtotalEl.textContent = formatCurrency(running);
    const grand = running - disc + tax + ship;
    if(grandEl){ grandEl.textContent = formatCurrency(grand); }
  }
  if(addBtn){ addBtn.addEventListener('click', function(){ addRow(); }); }
  
  wrap.addEventListener('click', function(e){ const btn = e.target.closest('[data-action="remove"]'); if(!btn) return; btn.closest('.item-row').remove(); rebuildHiddenInputs(); });
  wrap.addEventListener('input', function(){ rebuildHiddenInputs(); });
  form.addEventListener('submit', function(){ rebuildHiddenInputs(); });
  // Do not add a blank row by default; rows come from product selection

  // Open separate product browser (public products page in select-mode)
  browseBtn.addEventListener('click', function(){
    const w = window.open("{{ route('products.index') }}?select=1", 'product_select', 'width=1200,height=800');
    if(w) w.focus();
  });
  // Receive product selections
  window.addEventListener('message', function(ev){
    if(!ev || !ev.data || ev.data.type !== 'POS_SELECT_PRODUCT') return;
    const pid = String(ev.data.product_id || '').trim(); if(!pid) return;
    const name = ev.data.name || '';
    const sku  = ev.data.sku || '';
    const price = typeof ev.data.price !== 'undefined' ? Number(ev.data.price) : null;
    const qty = typeof ev.data.quantity !== 'undefined' ? Math.max(1, parseInt(ev.data.quantity,10)) : 1;
    // Allow fetch to confirm latest price from backend
    addRow(pid, qty, { name, sku, price, skipFetch: false });
  });

  // User fetch
  fetchUserBtn.addEventListener('click', function(){
    const id = (userInput.value||'').trim(); if(!id) return;
    fetch(`{{ route('admin.users.lookup') }}?identifier=${encodeURIComponent(id)}`, { headers:{ 'Accept':'application/json' }})
    .then(r=>r.json()).then(res=>{
      if(!res || !res.found) return;
      if(res.user){
        billName.value = res.user.name||'';
        billEmail.value = res.user.email||'';
        billPhone.value = res.user.phone||'';
        // normalize identifier to user id for reliable matching
        userInput.value = String(res.user.id);
        // Show a quick preview
        let pv = document.getElementById('userPreview');
        if(!pv){ pv = document.createElement('div'); pv.id='userPreview'; pv.className='mt-2'; userInput.closest('.input-group').insertAdjacentElement('afterend', pv); }
        pv.innerHTML = `<span class="badge text-bg-info">User: ${res.user.name||'-'} / ${res.user.email||'-'} / ${res.user.phone||'-'}</span>`;
      }
    }).catch(()=>{});
  });
  clearUserBtn.addEventListener('click', function(){ userInput.value=''; });

  applyCouponBtn.addEventListener('click', function(){
    const code = (couponCodeInput.value||'').trim(); if(!code) return;
    // Build product_ids and subtotal for preview
    const rows = wrap.querySelectorAll('.item-row');
    const ids = []; let subtotal = 0;
    rows.forEach(r=>{
      const pid = r.querySelector('[data-field="product_id"]').value.trim();
      const q = Math.max(1, parseInt(r.querySelector('[data-field="quantity"]').value||'1',10));
      const up = Math.max(0, parseFloat(r.querySelector('[data-field="unit_price"]').value||'0'));
      if(pid){ ids.push(pid); subtotal += q*up; }
    });
    const params = new URLSearchParams();
    params.set('code', code);
    params.set('subtotal', String(subtotal));
    const uid = (userInput.value||'').trim();
    if(uid){
      if(/^\d+$/.test(uid)){
        params.set('user_id', uid);
      } else {
        params.set('user_identifier', uid);
      }
    }
    ids.forEach(v=>params.append('product_ids[]', v));
    fetch(`{{ route('admin.coupons.preview') }}?${params.toString()}`, { headers:{ 'Accept':'application/json' }})
      .then(r=>r.json())
      .then(res=>{
        if(res && res.valid){
          document.getElementById('discount_total').value = Number(res.discount||0).toFixed(2);
          couponFeedback.textContent = 'Applied: -' + formatCurrency(res.discount||0);
          couponFeedback.className = 'form-text text-success';
          rebuildHiddenInputs();
        } else {
          couponFeedback.textContent = res && res.message ? res.message : 'Invalid coupon';
          couponFeedback.className = 'form-text text-danger';
        }
      }).catch(()=>{
        couponFeedback.textContent = 'Unable to apply coupon';
        couponFeedback.className = 'form-text text-danger';
      });
  });
});
</script>
@endpush
@endsection


