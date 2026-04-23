<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(!empty($siteSettings->favicon_url ?? null))
    <link rel="icon" type="image/x-icon" href="{{ $siteSettings->favicon_url }}" />
    @else
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" media="print" onload="this.media='all'" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.css') }}" />
    <!-- DataTables (Bootstrap 5) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/css/dataTables.bootstrap5.min.css" />
    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-buttons-bs5@2.4.2/css/buttons.bootstrap5.min.css" />
    <style>
    /* Remove underline from all links */
    a {
        text-decoration: none !important;
    }
    a:hover {
        text-decoration: none !important;
    }
    a:focus {
        text-decoration: none !important;
    }
    a:visited {
        text-decoration: none !important;
    }
    
    /* Admin DataTable Improvements */
    .card.shadow-sm {
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }
    .card-header.bg-white {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
        border-bottom: 2px solid #e9ecef !important;
        padding: 1rem 1.25rem;
    }
    .card-header .card-title {
        color: #2c3e50;
        font-weight: 600;
    }
    .card-body {
        padding: 1.25rem !important;
    }
    /* Filter Design Improvements */
    .filter-group {
        position: relative;
    }
    .filter-select,
    .filter-input {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        transition: all 0.3s ease;
        min-width: 140px;
    }
    .filter-select:focus,
    .filter-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
    }
    .filter-select:hover,
    .filter-input:hover {
        border-color: #adb5bd;
    }
    /* DataTable Styling */
    .table-responsive {
        border-radius: 6px;
        overflow: hidden;
    }
    .table thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
        padding: 0.75rem 1rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .table tbody td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    /* DataTables Wrapper */
    .dataTables_wrapper {
        padding-top: 1rem;
    }
    .dataTables_filter input {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 0.375rem 0.75rem;
        transition: all 0.3s ease;
    }
    .dataTables_filter input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
    }
    .dataTables_length select {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 0.375rem 2rem 0.375rem 0.75rem;
    }
    .dataTables_paginate .pagination {
        margin-top: 1rem;
    }
    .dataTables_paginate .page-link {
        border-radius: 6px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #667eea;
        transition: all 0.2s ease;
    }
    .dataTables_paginate .page-link:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
        transform: translateY(-2px);
    }
    .dataTables_paginate .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: white !important;
    }
    /* Button Improvements */
    .btn-sm {
        border-radius: 6px;
        font-weight: 500;
        padding: 0.375rem 0.75rem;
        transition: all 0.2s ease;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    /* Badge Color Fixes - Ensure all badges have readable text */
    .badge {
        font-weight: 600 !important;
        padding: 0.35em 0.65em !important;
    }
    /* Fix text-bg-* classes to ensure proper contrast */
    .badge.text-bg-primary,
    .badge.text-bg-success,
    .badge.text-bg-info,
    .badge.text-bg-danger {
        color: #ffffff !important;
    }
    .badge.text-bg-warning {
        background-color: #ffc107 !important;
        color: #000000 !important;
    }
    .badge.text-bg-secondary {
        background-color: #6c757d !important;
        color: #ffffff !important;
    }
    .badge.text-bg-light {
        background-color: #f8f9fa !important;
        color: #000000 !important;
    }
    .badge.text-bg-dark {
        background-color: #212529 !important;
        color: #ffffff !important;
    }
    /* Fix old badge-* classes if they exist */
    .badge.badge-primary,
    .badge.badge-success,
    .badge.badge-info,
    .badge.badge-danger,
    .badge.badge-secondary,
    .badge.badge-dark {
        color: #ffffff !important;
    }
    .badge.badge-warning {
        background-color: #ffc107 !important;
        color: #000000 !important;
    }
    .badge.badge-light {
        background-color: #f8f9fa !important;
        color: #000000 !important;
    }
    /* Fix bg-* classes without text color */
    .badge.bg-primary,
    .badge.bg-success,
    .badge.bg-info,
    .badge.bg-danger,
    .badge.bg-secondary,
    .badge.bg-dark {
        color: #ffffff !important;
    }
    .badge.bg-warning {
        background-color: #ffc107 !important;
        color: #000000 !important;
    }
    .badge.bg-light {
        background-color: #f8f9fa !important;
        color: #000000 !important;
    }
    
    /* DataTables Buttons Styling */
    .dt-buttons {
        margin-bottom: 1rem;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .dt-buttons .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
    }
    .dt-buttons .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .dt-buttons .btn i {
        font-size: 0.875rem;
    }
    
    /* Button Group Spacing */
    .btn-group {
        gap: 0.25rem;
    }
    .btn-group .btn,
    .btn-group form {
        margin: 0;
    }
    .btn-group form {
        display: inline-block;
    }
    </style>
    @stack('styles')
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      @include('admin.partials.header')
      @include('admin.partials.sidebar')
      <main class="app-main">
        <div class="app-content">
          <div class="container-fluid py-3">
            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @hasSection('breadcrumbs')
              @yield('breadcrumbs')
            @else
              @include('admin.partials.breadcrumb')
            @endif
            @yield('content')
          </div>
        </div>
      </main>
      @include('admin.partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('admin-assets/js/adminlte.js') }}"></script>
    <!-- jQuery + DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.10/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Buttons -->
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-buttons@2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-buttons-bs5@2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-buttons@2.4.2/js/buttons.html5.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Replace all confirm() calls with SweetAlert2
    (function() {
        function replaceFormConfirms() {
            // Handle forms with onsubmit="return confirm()"
            document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
                const originalOnsubmit = form.getAttribute('onsubmit');
                if (originalOnsubmit && originalOnsubmit.includes('confirm')) {
                    const match = originalOnsubmit.match(/confirm\(['"]([^'"]+)['"]\)/);
                    const confirmMessage = match ? match[1] : 'Are you sure?';
                    
                    form.removeAttribute('onsubmit');
                    
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formElement = this;
                        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Confirm Action',
                            text: confirmMessage,
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, Continue',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                formElement.removeEventListener('submit', arguments.callee);
                                formElement.submit();
                            }
                        });
                    });
                }
            });
            
            // Handle buttons with onclick="return confirm()"
            document.querySelectorAll('button[onclick*="confirm"], input[type="submit"][onclick*="confirm"]').forEach(btn => {
                const originalOnclick = btn.getAttribute('onclick');
                if (originalOnclick && originalOnclick.includes('confirm')) {
                    const match = originalOnclick.match(/confirm\(['"]([^'"]+)['"]\)/);
                    const confirmMessage = match ? match[1] : 'Are you sure?';
                    
                    btn.removeAttribute('onclick');
                    
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const buttonElement = this;
                        const form = buttonElement.closest('form');
                        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Confirm Action',
                            text: confirmMessage,
                            showCancelButton: true,
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, Continue',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (form) {
                                    form.submit();
                                } else {
                                    buttonElement.click();
                                }
                            }
                        });
                    });
                }
            });
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', replaceFormConfirms);
        } else {
            replaceFormConfirms();
        }
        
        // Also run after a delay to catch dynamically added forms
        setTimeout(replaceFormConfirms, 500);
    })();
    
    // DataTables CSV Export Helper
    window.initDataTableWithExport = function(tableId, options, exportTitle) {
        // Find columns that should be excluded from export (actions, etc.)
        const columns = options.columns || [];
        const exportableColumns = columns.map((col, index) => {
            return col.exportable !== false ? index : null;
        }).filter(index => index !== null);
        
        const defaultOptions = {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="bi bi-file-earmark-spreadsheet me-1"></i>Export Current View',
                    className: 'btn btn-sm btn-primary',
                    exportOptions: {
                        columns: exportableColumns,
                        modifier: {
                            page: 'current'
                        },
                        format: {
                            body: function(data, row, column, node) {
                                // Remove HTML tags from exported data
                                if (typeof data === 'string') {
                                    return data.replace(/<[^>]*>/g, '').trim();
                                }
                                return data;
                            }
                        }
                    },
                    filename: function() {
                        return (exportTitle || 'export') + '_current_view_' + new Date().toISOString().split('T')[0];
                    }
                },
                {
                    extend: 'csv',
                    text: '<i class="bi bi-file-earmark-spreadsheet-fill me-1"></i>Export All',
                    className: 'btn btn-sm btn-success',
                    exportOptions: {
                        columns: exportableColumns,
                        modifier: {
                            page: 'all'
                        },
                        format: {
                            body: function(data, row, column, node) {
                                // Remove HTML tags from exported data
                                if (typeof data === 'string') {
                                    return data.replace(/<[^>]*>/g, '').trim();
                                }
                                return data;
                            }
                        }
                    },
                    filename: function() {
                        return (exportTitle || 'export') + '_all_' + new Date().toISOString().split('T')[0];
                    }
                }
            ],
            language: {
                buttons: {
                    csv: 'CSV'
                }
            }
        };
        
        // Merge user options with defaults
        const mergedOptions = Object.assign({}, defaultOptions, options);
        
        // If user provided buttons, merge them
        if (options && options.buttons) {
            mergedOptions.buttons = [...defaultOptions.buttons, ...options.buttons];
        }
        
        // Update export options with column indices
        mergedOptions.buttons.forEach(btn => {
            if (btn.exportOptions) {
                btn.exportOptions.columns = exportableColumns;
            }
        });
        
        return $(tableId).DataTable(mergedOptions);
    };

    // Clear cache link (SweetAlert2)
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('adminClearCacheLink');
        if (!el) return;
        el.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'question',
                title: 'Clear cache?',
                text: 'This will clear application, config, view, route and optimize caches.',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Clear cache'
            }).then(function(result) {
                if (!result.isConfirmed) return;
                var url = '{{ route("admin.clear-cache") }}';
                var token = document.querySelector('meta[name="csrf-token"]');
                token = token ? token.getAttribute('content') : '';
                Swal.fire({
                    title: 'Clearing cache...',
                    html: 'Please wait',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: function() { Swal.showLoading(); }
                });
                var formData = new FormData();
                formData.append('_token', token);
                fetch(url, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                    body: formData
                }).then(function(r) {
                    return r.text().then(function(text) {
                        try { return { ok: r.ok, data: JSON.parse(text) }; }
                        catch (e) { return { ok: r.ok, data: { success: false, message: text || r.statusText } }; }
                    });
                }).then(function(res) {
                    var data = res.data;
                    var html = (data.results && data.results.length ? data.results : [data.message || '']).join('<br>').replace(/\n/g, '<br>');
                    Swal.fire({
                        icon: res.ok && data.success ? 'success' : (res.ok ? 'warning' : 'error'),
                        title: res.ok ? (data.success ? 'Cache cleared' : 'Completed with issues') : 'Request failed',
                        html: html || (res.ok ? '' : 'Check console or try again.'),
                        confirmButtonColor: '#0d6efd',
                        width: 520
                    });
                }).catch(function(err) {
                    Swal.fire({ icon: 'error', title: 'Failed', text: err.message || 'Request failed', confirmButtonColor: '#0d6efd' });
                });
            });
        });
    });
    </script>
    @stack('scripts')
  </body>
</html>


