@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Date Filter Section with Collapse -->
<div class="card border-0 shadow-sm mb-4">
  <div class="card-header bg-white">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title mb-0 fw-semibold">
        <i class="bi bi-calendar-range me-2"></i>Dashboard Report
      </h5>
      <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#dateFilterCollapse" aria-expanded="false" aria-controls="dateFilterCollapse">
        <i class="bi bi-funnel me-1"></i>
        <span class="filter-toggle-text">Show Filters</span>
      </button>
    </div>
  </div>
  <div class="collapse" id="dateFilterCollapse">
    <div class="card-body">
      <form id="dateFilterForm" method="GET" action="{{ route('admin.dashboard') }}" class="row g-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label small text-muted mb-1">From Date</label>
          <input type="date" name="date_from" id="date_from" value="{{ $dateFrom ?? '' }}" class="form-control form-control-sm">
        </div>
        <div class="col-md-3">
          <label class="form-label small text-muted mb-1">To Date</label>
          <input type="date" name="date_to" id="date_to" value="{{ $dateTo ?? '' }}" class="form-control form-control-sm">
        </div>
        <div class="col-md-3">
          <label class="form-label small text-muted mb-1">Quick Filters</label>
          <div class="btn-group w-100" role="group">
            <button type="button" class="btn btn-sm btn-outline-secondary quick-filter" data-days="7">Last 7 Days</button>
            <button type="button" class="btn btn-sm btn-outline-secondary quick-filter" data-days="30">Last 30 Days</button>
            <button type="button" class="btn btn-sm btn-outline-secondary quick-filter" data-days="90">Last 90 Days</button>
          </div>
        </div>
        <div class="col-md-3">
          <label class="form-label small text-muted mb-1 d-block">&nbsp;</label>
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-sm btn-primary">
              <i class="bi bi-check-circle me-1"></i>Apply
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
              <i class="bi bi-x-circle me-1"></i>Reset
            </a>
          </div>
        </div>
      </form>
      @if(isset($dateFrom) && isset($dateTo) && $dateFrom && $dateTo)
      <div class="mt-3 pt-3 border-top">
        <small class="text-muted">
          <i class="bi bi-info-circle me-1"></i>
          Showing report from <strong>{{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}</strong>
        </small>
      </div>
      @else
      <div class="mt-3 pt-3 border-top">
        <small class="text-success">
          <i class="bi bi-info-circle me-1"></i>
          Showing <strong>all data</strong> (no date filter applied)
        </small>
      </div>
      @endif
    </div>
  </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
  <!-- Total Revenue -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
      <div class="card-body text-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small opacity-75 mb-1">Filtered Revenue</div>
            <div class="h3 mb-0 fw-bold">@currency($filteredStats['revenue'] ?? 0)</div>
            @if(isset($revenueGrowth) && $revenueGrowth != 0)
            <div class="small mt-2">
              <i class="bi bi-arrow-{{ $revenueGrowth > 0 ? 'up' : 'down' }}-circle"></i>
              {{ number_format(abs($revenueGrowth), 1) }}% vs previous period
            </div>
            @endif
            <div class="small mt-1 opacity-50">
              Total: @currency($stats['total_revenue'])
            </div>
          </div>
          <div class="opacity-75">
            <i class="bi bi-cash-coin" style="font-size: 2.5rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Orders -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
      <div class="card-body text-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small opacity-75 mb-1">Filtered Orders</div>
            <div class="h3 mb-0 fw-bold">{{ number_format($filteredStats['orders'] ?? 0) }}</div>
            <div class="small mt-2">
              <span class="opacity-75">Today: {{ $todayStats['orders'] }}</span>
            </div>
            <div class="small mt-1 opacity-50">
              Total: {{ number_format($stats['total_orders']) }}
            </div>
          </div>
          <div class="opacity-75">
            <i class="bi bi-bag-check" style="font-size: 2.5rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Products -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
      <div class="card-body text-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small opacity-75 mb-1">Total Products</div>
            <div class="h3 mb-0 fw-bold">{{ number_format($stats['total_products']) }}</div>
            <div class="small mt-2">
              <span class="opacity-75">Low stock: {{ $lowStock->count() }}</span>
            </div>
          </div>
          <div class="opacity-75">
            <i class="bi bi-box-seam" style="font-size: 2.5rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Customers -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
      <div class="card-body text-white">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small opacity-75 mb-1">Total Customers</div>
            <div class="h3 mb-0 fw-bold">{{ number_format($stats['total_customers']) }}</div>
            <div class="small mt-2">
              <span class="opacity-75">Categories: {{ $stats['total_categories'] }}</span>
            </div>
          </div>
          <div class="opacity-75">
            <i class="bi bi-people" style="font-size: 2.5rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Secondary Stats Row -->
<div class="row g-4 mb-4">
  <!-- This Month Revenue -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted small mb-1">This Month Revenue</div>
            <div class="h4 mb-0 fw-bold text-primary">@currency($monthStats['revenue'])</div>
          </div>
          <div class="text-primary">
            <i class="bi bi-calendar-month" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- This Month Orders -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted small mb-1">This Month Orders</div>
            <div class="h4 mb-0 fw-bold text-success">{{ number_format($monthStats['orders']) }}</div>
            @if($ordersGrowth != 0)
            <div class="small text-{{ $ordersGrowth > 0 ? 'success' : 'danger' }}">
              <i class="bi bi-arrow-{{ $ordersGrowth > 0 ? 'up' : 'down' }}"></i>
              {{ number_format(abs($ordersGrowth), 1) }}%
            </div>
            @endif
          </div>
          <div class="text-success">
            <i class="bi bi-cart-check" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Orders -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted small mb-1">Pending Orders</div>
            <div class="h4 mb-0 fw-bold text-warning">{{ number_format($pendingOrders) }}</div>
          </div>
          <div class="text-warning">
            <i class="bi bi-clock-history" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Today Revenue -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted small mb-1">Today Revenue</div>
            <div class="h4 mb-0 fw-bold text-info">@currency($todayStats['revenue'])</div>
          </div>
          <div class="text-info">
            <i class="bi bi-calendar-day" style="font-size: 2rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
  <!-- Sales & Orders Chart -->
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-semibold">
          <i class="bi bi-graph-up me-2"></i>Sales & Orders Report
          @if(isset($dateFrom) && isset($dateTo) && $dateFrom && $dateTo)
            <small class="text-muted">({{ \Carbon\Carbon::parse($dateFrom)->format('M d') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }})</small>
          @else
            <small class="text-muted">(Last 30 days chart, all data stats)</small>
          @endif
        </h5>
      </div>
      <div class="card-body">
        <canvas id="salesChart" height="100"></canvas>
      </div>
    </div>
  </div>

  <!-- Order Status Breakdown -->
  <div class="col-lg-4">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-semibold">
          <i class="bi bi-pie-chart me-2"></i>Order Status
        </h5>
      </div>
      <div class="card-body">
        <canvas id="statusChart" height="250"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Data Tables Row -->
<div class="row g-4">
  <!-- Recent Orders -->
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white">
        <div class="d-flex align-items-center gap-2">
          <h5 class="card-title mb-0 fw-semibold">
            <i class="bi bi-clock-history me-2"></i>Recent Orders
          </h5>
          <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">
            View All <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentOrders as $order)
                <tr>
                  <td><strong>{{ $order->number }}</strong></td>
                  <td>
                    @if($order->user)
                      {{ $order->user->name ?? $order->billing_name }}
                    @else
                      {{ $order->billing_name }}
                    @endif
                  </td>
                  <td>
                    @php
                      $statusColors = [
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        'refunded' => 'secondary'
                      ];
                      $color = $statusColors[$order->status] ?? 'secondary';
                    @endphp
                    <span class="badge text-bg-{{ $color }}">{{ ucfirst($order->status) }}</span>
                  </td>
                  <td><strong>@currency($order->grand_total)</strong></td>
                  <td>{{ $order->created_at->format('M d, Y') }}</td>
                  <td>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye"></i>
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4 text-muted">No orders yet</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Top Products & Low Stock -->
  <div class="col-lg-4">
    <!-- Top Selling Products -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white">
        <div class="d-flex align-items-center gap-2">
          <h5 class="card-title mb-0 fw-semibold">
            <i class="bi bi-trophy me-2"></i>Top Products
          </h5>
          <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-sm mb-0">
            <thead class="table-light">
              <tr>
                <th>Product</th>
                <th class="text-end">Sold</th>
              </tr>
            </thead>
            <tbody>
              @forelse($topProducts as $product)
                <tr>
                  <td>
                    <div class="fw-semibold small">{{ Str::limit($product->name, 25) }}</div>
                    <div class="text-muted small">@currency($product->total_revenue)</div>
                  </td>
                  <td class="text-end">
                    <span class="badge text-bg-success">{{ $product->total_sold }}</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center py-3 text-muted small">No sales yet</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="card border-0 shadow-sm" style="border-left: 4px solid #dc3545 !important;">
      <div class="card-header bg-white">
        <div class="d-flex align-items-center gap-2">
          <h5 class="card-title mb-0 fw-semibold text-danger">
            <i class="bi bi-exclamation-triangle me-2"></i>Low Stock Alert
          </h5>
          <a href="{{ route('admin.products.index') }}?filter_stock=low_stock" class="btn btn-sm btn-outline-danger">
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-sm mb-0">
            <thead class="table-light">
              <tr>
                <th>Product</th>
                <th class="text-end">Stock</th>
              </tr>
            </thead>
            <tbody>
              @forelse($lowStock as $product)
                <tr>
                  <td>
                    <div class="fw-semibold small">{{ Str::limit($product->name, 25) }}</div>
                  </td>
                  <td class="text-end">
                    <span class="badge text-bg-{{ $product->stock == 0 ? 'danger' : 'warning' }}">
                      {{ $product->stock }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center py-3 text-success small">
                    <i class="bi bi-check-circle me-1"></i>All products in stock
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  // Update filter toggle text based on collapse state
  const filterCollapse = document.getElementById('dateFilterCollapse');
  const filterToggle = document.querySelector('[data-bs-target="#dateFilterCollapse"]');
  const filterToggleText = filterToggle?.querySelector('.filter-toggle-text');
  
  if (filterCollapse && filterToggle && filterToggleText) {
    filterCollapse.addEventListener('show.bs.collapse', function () {
      filterToggleText.textContent = 'Hide Filters';
    });
    filterCollapse.addEventListener('hide.bs.collapse', function () {
      filterToggleText.textContent = 'Show Filters';
    });
    
    // Check if filters are active (date parameters exist and have values)
    const urlParams = new URLSearchParams(window.location.search);
    const hasDateFrom = urlParams.has('date_from') && urlParams.get('date_from') !== '';
    const hasDateTo = urlParams.has('date_to') && urlParams.get('date_to') !== '';
    if (hasDateFrom || hasDateTo) {
      // Auto-expand if filters are active
      const bsCollapse = new bootstrap.Collapse(filterCollapse, {
        toggle: true
      });
    }
  }
  
  // Quick filter buttons
  document.querySelectorAll('.quick-filter').forEach(btn => {
    btn.addEventListener('click', function() {
      const days = parseInt(this.dataset.days);
      const toDate = new Date();
      const fromDate = new Date();
      fromDate.setDate(toDate.getDate() - days);
      
      document.getElementById('date_from').value = fromDate.toISOString().split('T')[0];
      document.getElementById('date_to').value = toDate.toISOString().split('T')[0];
      
      // Submit form
      document.getElementById('dateFilterForm').submit();
    });
  });
  
  // Sales & Orders Chart
  const salesCtx = document.getElementById('salesChart');
  if(salesCtx) {
    new Chart(salesCtx, {
      type: 'line',
      data: {
        labels: @json($labels),
        datasets: [
          {
            label: 'Orders',
            data: @json($ordersSeries),
            borderColor: '#667eea',
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            tension: 0.4,
            fill: true
          },
          {
            label: 'Revenue',
            data: @json($revenueSeries),
            borderColor: '#f5576c',
            backgroundColor: 'rgba(245, 87, 108, 0.1)',
            tension: 0.4,
            fill: true,
            yAxisID: 'y1'
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 15,
              usePointStyle: true
            }
          },
          tooltip: {
            mode: 'index',
            intersect: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Orders',
              color: '#667eea'
            },
            grid: {
              color: 'rgba(0,0,0,0.05)'
            }
          },
          y1: {
            beginAtZero: true,
            position: 'right',
            grid: {
              drawOnChartArea: false
            },
            title: {
              display: true,
              text: 'Revenue',
              color: '#f5576c'
            }
          },
          x: {
            grid: {
              color: 'rgba(0,0,0,0.05)'
            }
          }
        },
        interaction: {
          mode: 'nearest',
          axis: 'x',
          intersect: false
        }
      }
    });
  }

  // Order Status Pie Chart
  const statusCtx = document.getElementById('statusChart');
  if(statusCtx) {
    const statusData = @json($orderStatusBreakdown);
    const statusLabels = Object.keys(statusData);
    const statusValues = Object.values(statusData);
    const statusColors = {
      'pending': '#ffc107',
      'processing': '#0dcaf0',
      'shipped': '#0d6efd',
      'delivered': '#198754',
      'cancelled': '#dc3545',
      'refunded': '#6c757d'
    };

    new Chart(statusCtx, {
      type: 'doughnut',
      data: {
        labels: statusLabels.map(s => s.charAt(0).toUpperCase() + s.slice(1)),
        datasets: [{
          data: statusValues,
          backgroundColor: statusLabels.map(s => statusColors[s] || '#6c757d'),
          borderWidth: 2,
          borderColor: '#fff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 15,
              usePointStyle: true
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const label = context.label || '';
                const value = context.parsed || 0;
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const percentage = ((value / total) * 100).toFixed(1);
                return label + ': ' + value + ' (' + percentage + '%)';
              }
            }
          }
        }
      }
    });
  }
});
</script>
@endpush
@endsection
