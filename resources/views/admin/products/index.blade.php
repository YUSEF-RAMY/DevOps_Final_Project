@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-2">
            <h3 class="card-title mb-0 fw-semibold">Products</h3>
            <div class="d-flex gap-2 align-items-center">
                <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
                    <i class="bi bi-funnel me-1"></i>
                    <span class="filter-toggle-text">Show Filters</span>
                </button>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>New Product
                </a>
            </div>
        </div>
        
        <!-- Advanced Filters Section with Collapse -->
        <div class="collapse" id="filtersCollapse">
            <div class="filters-container">
            <div class="row g-2 mb-2">
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Product Name</label>
                    <select id="filter_product_name" class="form-select form-select-sm">
                        <option value="">ALL</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Category</label>
                    <select id="filter_category" class="form-select form-select-sm">
                        <option value="" selected>ALL</option>
                        @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('name')->get(['id','name']) as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Subcategory</label>
                    <select id="filter_subcategory" class="form-select form-select-sm" disabled>
                        <option value="" selected>ALL</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Stock Status</label>
                    <select id="filter_stock" class="form-select form-select-sm">
                        <option value="" selected>ALL</option>
                        <option value="in_stock">In Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                        <option value="low_stock">Low Stock (&lt;10)</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Featured</label>
                    <select id="filter_featured" class="form-select form-select-sm">
                        <option value="" selected>ALL</option>
                        <option value="1">Featured</option>
                        <option value="0">Not Featured</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Sale Status</label>
                    <select id="filter_on_sale" class="form-select form-select-sm">
                        <option value="" selected>ALL</option>
                        <option value="1">On Sale</option>
                        <option value="0">Regular Price</option>
                    </select>
                </div>
            </div>
            <div class="row g-2 mb-2">
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Min Price</label>
                    <input type="number" id="filter_price_min" class="form-control form-control-sm" placeholder="0.00" step="0.01" min="0">
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Max Price</label>
                    <input type="number" id="filter_price_max" class="form-control form-control-sm" placeholder="0.00" step="0.01" min="0">
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label small text-muted mb-1">Status</label>
                    <select id="filter_active" class="form-select form-select-sm">
                        <option value="" selected>ALL</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-2 d-flex align-items-end">
                    <button type="button" id="clear_filters" class="btn btn-outline-secondary btn-sm w-100">
                        <i class="bi bi-x-circle me-1"></i>Clear Filters
                    </button>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="productsTable" class="table table-striped mb-0 align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:80px" class="text-center">Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Original Price</th>
                        <th>Qty Available</th>
                        <th>Active</th>
                        <th style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<style>
/* Select2 Custom Styling for Filters */
.select2-container {
    width: 100% !important;
    z-index: 9999;
}
.select2-container--bootstrap-5 .select2-selection {
    min-height: 31px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 0.875rem;
}
.select2-container--bootstrap-5 .select2-selection--single {
    height: 31px;
    line-height: 31px;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    line-height: 31px;
    padding-left: 8px;
    padding-right: 20px;
    font-size: 0.875rem;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 29px;
    right: 8px;
}
.select2-dropdown {
    z-index: 10000;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 0.875rem;
}
.select2-search--dropdown .select2-search__field {
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}
.select2-results__option {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
}
.filters-container {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 6px;
    margin-top: 0.5rem;
    border: 1px solid #e9ecef;
}
.filters-container .form-label {
    font-weight: 500;
    color: #495057;
}
#filtersCollapse {
    margin-top: 0.5rem;
}
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Reset all filters on page load
    function resetAllFilters() {
        // Reset native selects
        document.getElementById('filter_product_name').value = '';
        document.getElementById('filter_category').value = '';
        document.getElementById('filter_subcategory').value = '';
        document.getElementById('filter_subcategory').disabled = true;
        document.getElementById('filter_stock').value = '';
        document.getElementById('filter_featured').value = '';
        document.getElementById('filter_on_sale').value = '';
        document.getElementById('filter_active').value = '';
        document.getElementById('filter_price_min').value = '';
        document.getElementById('filter_price_max').value = '';
        
        // Reset subcategory HTML
        document.getElementById('filter_subcategory').innerHTML = '<option value="" selected>ALL</option>';
    }
    
    // Reset filters immediately
    resetAllFilters();
    
    // Toggle filter button text
    const filtersCollapse = document.getElementById('filtersCollapse');
    const filterToggleBtn = document.querySelector('[data-bs-toggle="collapse"][data-bs-target="#filtersCollapse"]');
    const filterToggleText = filterToggleBtn?.querySelector('.filter-toggle-text');
    
    if (filtersCollapse && filterToggleBtn) {
        filtersCollapse.addEventListener('show.bs.collapse', function () {
            if (filterToggleText) filterToggleText.textContent = 'Hide Filters';
            filterToggleBtn.querySelector('i').classList.remove('bi-funnel');
            filterToggleBtn.querySelector('i').classList.add('bi-funnel-fill');
        });
        
        filtersCollapse.addEventListener('hide.bs.collapse', function () {
            if (filterToggleText) filterToggleText.textContent = 'Show Filters';
            filterToggleBtn.querySelector('i').classList.remove('bi-funnel-fill');
            filterToggleBtn.querySelector('i').classList.add('bi-funnel');
        });
    }
    const table = initDataTableWithExport('#productsTable', {
        processing: true,
        serverSide: true,
        searching: true,
        lengthChange: true,
        ajax: {
            url: '{{ route('admin.datatables', 'products') }}',
            data: function(d){
                // Get values from Select2 or native selects
                const getSelectValue = (id) => {
                    const element = document.getElementById(id);
                    if (!element) return '';
                    // Check if Select2 is initialized
                    if (typeof jQuery !== 'undefined' && jQuery(element).data('select2')) {
                        return jQuery(element).val() || '';
                    }
                    return element.value || '';
                };
                
                d.product_id = getSelectValue('filter_product_name');
                d.category_id = getSelectValue('filter_category');
                d.subcategory_id = getSelectValue('filter_subcategory');
                d.stock = getSelectValue('filter_stock');
                d.is_featured = getSelectValue('filter_featured');
                d.on_sale = getSelectValue('filter_on_sale');
                d.price_min = document.getElementById('filter_price_min')?.value || '';
                d.price_max = document.getElementById('filter_price_max')?.value || '';
                d.is_active = getSelectValue('filter_active');
            }
        },
        columns: [
            { data: 'image', name: 'image', orderable: false, searchable: false, className: 'text-center', exportable: false },
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category', orderable: true, searchable: true },
            { data: 'subcategory', name: 'subcategory', orderable: false, searchable: false, className: 'text-center' },
            { data: 'price', name: 'price', className: 'text-center', orderable: true, searchable: false },
            { data: 'compare_at_price', name: 'compare_at_price', className: 'text-center', orderable: true, searchable: false },
            { data: 'stock', name: 'stock', className: 'text-center', orderable: true, searchable: false },
            { data: 'is_active', name: 'is_active', className: 'text-center', orderable: true, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', exportable: false }
        ],
        order: [[0, 'asc']],
    }, 'Products');

    // Initialize Select2 for Product Name Search
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
        // Ensure value is empty
        jQuery('#filter_product_name').val('').trigger('change');
        jQuery('#filter_product_name').select2({
            theme: 'bootstrap-5',
            placeholder: 'ALL',
            allowClear: true,
            width: '100%',
            ajax: {
                url: '{{ route('admin.datatables', 'products') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        draw: 1,
                        start: 0,
                        length: 20,
                        search: {
                            value: params.term || ''
                        },
                        search_only: 'name'
                    };
                },
                processResults: function (data) {
                    const results = [];
                    if (data.data && Array.isArray(data.data)) {
                        data.data.forEach(function(item) {
                            // Extract product name from HTML if needed
                            let productName = item.name;
                            if (typeof productName === 'string' && productName.includes('<')) {
                                // Remove HTML tags
                                const tempDiv = document.createElement('div');
                                tempDiv.innerHTML = productName;
                                productName = tempDiv.textContent || tempDiv.innerText || '';
                            }
                            if (productName && item.id) {
                                results.push({
                                    id: item.id,
                                    text: productName.trim()
                                });
                            }
                        });
                    }
                    return {
                        results: results
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        }).on('select2:select', function (e) {
            table.ajax.reload();
        }).on('select2:clear', function (e) {
            table.ajax.reload();
        });
    }
    
    // Initialize Select2 for Category
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
        // Ensure value is empty/ALL
        jQuery('#filter_category').val('').trigger('change');
        jQuery('#filter_category').select2({
            theme: 'bootstrap-5',
            placeholder: 'ALL',
            allowClear: false,
            width: '100%'
        }).on('change', function(){
            const categoryId = jQuery(this).val();
            const subcategorySelect = document.getElementById('filter_subcategory');
            
            // Clear and disable subcategory
            subcategorySelect.innerHTML = '<option value="" selected>ALL</option>';
            subcategorySelect.disabled = !categoryId;
            
            // Destroy and reinitialize Select2 for subcategory
            if (jQuery(subcategorySelect).data('select2')) {
                jQuery(subcategorySelect).select2('destroy');
            }
            
            if(categoryId) {
                fetch(`{{ url('/admin/api/categories') }}/${categoryId}/subcategories`)
                    .then(response => response.json())
                    .then(data => {
                        if(data.subcategories && data.subcategories.length > 0) {
                            data.subcategories.forEach(sub => {
                                const option = document.createElement('option');
                                option.value = sub.id;
                                option.textContent = sub.name;
                                subcategorySelect.appendChild(option);
                            });
                        }
                        // Re-initialize Select2
                        jQuery(subcategorySelect).select2({
                            theme: 'bootstrap-5',
                            placeholder: 'ALL',
                            allowClear: false,
                            width: '100%'
                        });
                        subcategorySelect.disabled = false;
                    })
                    .catch(error => console.error('Error loading subcategories:', error));
            } else {
                // Re-initialize Select2 as disabled
                jQuery(subcategorySelect).select2({
                    theme: 'bootstrap-5',
                    placeholder: 'ALL',
                    allowClear: false,
                    width: '100%',
                    disabled: true
                });
            }
            table.ajax.reload();
        });
    }
    
    // Initialize Select2 for Subcategory
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
        // Ensure value is empty/ALL
        jQuery('#filter_subcategory').val('').trigger('change');
        jQuery('#filter_subcategory').select2({
            theme: 'bootstrap-5',
            placeholder: 'ALL',
            allowClear: false,
            width: '100%',
            disabled: true
        });
    }
    
    // Initialize Select2 for other dropdowns and attach change events
    ['filter_subcategory', 'filter_stock', 'filter_featured', 'filter_on_sale', 'filter_active'].forEach(id => {
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
            const isSubcategory = id === 'filter_subcategory';
            // Skip if already initialized (subcategory)
            if (isSubcategory && jQuery('#' + id).data('select2')) {
                return;
            }
            // Ensure value is empty/ALL before initializing
            jQuery('#' + id).val('').trigger('change');
            jQuery('#' + id).select2({
                theme: 'bootstrap-5',
                width: '100%',
                minimumResultsForSearch: isSubcategory ? -1 : Infinity,
                placeholder: 'ALL',
                allowClear: false,
                disabled: isSubcategory ? true : false
            }).on('change', function() {
                table.ajax.reload();
            });
        }
    });
    
    // Price filters with debounce
    ['filter_price_min', 'filter_price_max'].forEach(id => {
        const element = document.getElementById(id);
        if(element) {
            element.addEventListener('input', () => {
                clearTimeout(window.priceFilterTimeout);
                window.priceFilterTimeout = setTimeout(() => table.ajax.reload(), 500);
            });
        }
    });
    
    // Clear Filters Button
    document.getElementById('clear_filters').addEventListener('click', function() {
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
            // Clear Select2 elements
            jQuery('#filter_product_name').val(null).trigger('change');
            jQuery('#filter_category').val(null).trigger('change');
            
            // Clear subcategory
            const subcategorySelect = document.getElementById('filter_subcategory');
            subcategorySelect.innerHTML = '<option value="" selected>ALL</option>';
            subcategorySelect.disabled = true;
            if (jQuery(subcategorySelect).data('select2')) {
                jQuery(subcategorySelect).select2('destroy');
            }
            jQuery(subcategorySelect).select2({
                theme: 'bootstrap-5',
                placeholder: 'ALL',
                allowClear: false,
                width: '100%',
                disabled: true
            });
            
            // Clear other Select2 dropdowns
            ['filter_stock', 'filter_featured', 'filter_on_sale', 'filter_active'].forEach(id => {
                jQuery('#' + id).val(null).trigger('change');
            });
        } else {
            // Fallback for native selects
            document.getElementById('filter_product_name').value = '';
            document.getElementById('filter_category').value = '';
            document.getElementById('filter_subcategory').value = '';
            document.getElementById('filter_subcategory').disabled = true;
            document.getElementById('filter_stock').value = '';
            document.getElementById('filter_featured').value = '';
            document.getElementById('filter_on_sale').value = '';
            document.getElementById('filter_active').value = '';
        }
        
        // Clear price inputs
        document.getElementById('filter_price_min').value = '';
        document.getElementById('filter_price_max').value = '';
        
        // Reload table
        table.ajax.reload();
    });
});
</script>
@endpush
@endsection


