@extends('admin.layouts.app')

@section('title', 'New Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-plus-circle-fill me-2 fs-5"></i>
                        <h3 class="card-title mb-0 fw-semibold">Create New Product</h3>
                    </div>
                </div>
                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-4">
                        <!-- Basic Information Section -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-3">
                                <h5 class="mb-0 fw-semibold text-primary">
                                    <i class="bi bi-info-circle me-2"></i>Basic Information
                                </h5>
                                <hr class="mt-2 mb-0">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-tag me-1 text-muted"></i>Product Name <span class="text-danger">*</span>
                                    </label>
                                    <input name="name" id="product_name" class="form-control form-control-lg" required placeholder="Enter product name" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-link-45deg me-1 text-muted"></i>Slug <span class="text-danger">*</span>
                                    </label>
                                    <input name="slug" id="product_slug" class="form-control form-control-lg" required placeholder="product-slug" />
                                    <div id="slug_error" class="text-danger small mt-1 fw-semibold" style="display: none;"></div>
                                    <div id="slug_success" class="text-success small mt-1 fw-semibold" style="display: none;"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-upc-scan me-1 text-muted"></i>SKU
                                    </label>
                                    <input name="sku" class="form-control form-control-lg" placeholder="Product SKU (optional)" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-folder me-1 text-muted"></i>Category
                                    </label>
                                    <select name="category_id" id="category_id" class="form-select form-select-lg">
                                        <option value="">Select Category (Optional)</option>
                                        @foreach($parentCategories as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6" id="subcategory_wrapper" style="display: none;">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-folder2-open me-1 text-muted"></i>Subcategory
                                    </label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-select form-select-lg" disabled>
                                        <option value="">Select Subcategory (Optional)</option>
                                    </select>
                                    <small class="text-muted">Select a category first to see subcategories</small>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing & Inventory Section -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-3">
                                <h5 class="mb-0 fw-semibold text-primary">
                                    <i class="bi bi-currency-dollar me-2"></i>Pricing & Inventory
                                </h5>
                                <hr class="mt-2 mb-0">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-cash-stack me-1 text-muted"></i>Price <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light">৳</span>
                                        <input name="price" type="number" step="0.01" min="0" class="form-control" required placeholder="0.00" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-tag me-1 text-muted"></i>Compare at Price
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light">৳</span>
                                        <input name="compare_at_price" type="number" step="0.01" min="0" class="form-control" placeholder="0.00" />
                                    </div>
                                    <small class="text-muted">Original price for showing discounts</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-box-seam me-1 text-muted"></i>Stock Quantity <span class="text-danger">*</span>
                                    </label>
                                    <input name="stock" type="number" min="0" class="form-control form-control-lg" value="0" required placeholder="0" />
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-3">
                                <h5 class="mb-0 fw-semibold text-primary">
                                    <i class="bi bi-file-text me-2"></i>Description
                                </h5>
                                <hr class="mt-2 mb-0">
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-card-text me-1 text-muted"></i>Short Description
                                    </label>
                                    <textarea name="short_description" rows="3" class="form-control" placeholder="Brief description that appears in product listings..."></textarea>
                                    <small class="text-muted">This will be shown in product cards and search results</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-file-earmark-text me-1 text-muted"></i>Full Description
                                    </label>
                                    <textarea name="description" id="product_description" rows="6" class="form-control" placeholder="Detailed product description..."></textarea>
                                    <small class="text-muted">Rich text editor - format your content with headings, lists, links, and more</small>
                                </div>
                            </div>
                        </div>

                        <!-- Product Images Section -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-3">
                                <h5 class="mb-0 fw-semibold text-primary">
                                    <i class="bi bi-images me-2"></i>Product Images
                                </h5>
                                <hr class="mt-2 mb-0">
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-upload me-1 text-muted"></i>Upload Images
                                    </label>
                                    <div class="image-upload-area border rounded p-4 bg-light text-center" style="min-height: 200px; border-style: dashed !important;">
                                        <input type="file" name="images[]" id="product_images" class="d-none" multiple accept="image/*">
                                        <div id="image_upload_placeholder" class="upload-placeholder">
                                            <i class="bi bi-cloud-upload fs-1 text-muted d-block mb-3"></i>
                                            <p class="text-muted mb-2">Click to upload or drag and drop</p>
                                            <p class="text-muted small">PNG, JPG, GIF up to 5MB each</p>
                                            <button type="button" class="btn btn-outline-primary mt-2" onclick="document.getElementById('product_images').click()">
                                                <i class="bi bi-plus-circle me-1"></i>Select Images
                                            </button>
                                        </div>
                                        <div id="image_preview_container" class="row g-3 mt-3 sortable-images" style="display: none;"></div>
                                    </div>
                                    <small class="text-muted">You can upload multiple images. Drag to reorder - the first image will be set as primary.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Status & Options Section -->
                        <div class="form-section mb-4">
                            <div class="section-header mb-3">
                                <h5 class="mb-0 fw-semibold text-primary">
                                    <i class="bi bi-toggle-on me-2"></i>Status & Options
                                </h5>
                                <hr class="mt-2 mb-0">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-check form-switch form-switch-lg p-3 border rounded bg-light">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked />
                                        <label class="form-check-label fw-semibold ms-2" for="is_active">
                                            <i class="bi bi-check-circle me-1 text-success"></i>Active Product
                                        </label>
                                        <small class="d-block text-muted ms-5 mt-1">Product will be visible to customers</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch form-switch-lg p-3 border rounded bg-light">
                                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" />
                                        <label class="form-check-label fw-semibold ms-2" for="is_featured">
                                            <i class="bi bi-star me-1 text-warning"></i>Featured Product
                                        </label>
                                        <small class="d-block text-muted ms-5 mt-1">Show on homepage featured section</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-top py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-4" id="submit_btn">
                                <i class="bi bi-check-circle me-2"></i>Create Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<!-- Quill Editor CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
/* Select2 Custom Styling - Ensure it doesn't break Quill Editor */
.select2-container {
    width: 100% !important;
    z-index: 9999;
}
.select2-container--bootstrap-5 .select2-selection {
    min-height: 48px;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 0.375rem 0.75rem;
}
.select2-container--bootstrap-5 .select2-selection--single {
    height: 48px;
    line-height: 48px;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    line-height: 48px;
    padding-left: 0;
    padding-right: 20px;
    font-size: 1rem;
    font-weight: 400;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 46px;
    right: 8px;
}
.select2-dropdown {
    z-index: 10000;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    font-size: 1rem;
}
.select2-search--dropdown .select2-search__field {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
}
.select2-results__option {
    font-size: 1rem;
    padding: 0.5rem 0.75rem;
    line-height: 1.5;
}
.select2-results__option--highlighted {
    font-size: 1rem;
}
.select2-container--bootstrap-5 .select2-selection {
    font-size: 1rem;
}
/* Ensure Quill Editor is not affected */
#product_editor {
    z-index: 1;
}
.ql-toolbar {
    z-index: 1;
}
.ql-container {
    z-index: 1;
}
</style>
<!-- SortableJS CSS -->
<style>
    .sortable-images {
        display: flex;
        flex-wrap: wrap;
    }
    .sortable-images .image-item {
        transition: transform 0.2s;
        cursor: move;
    }
    .sortable-images .image-item.sortable-ghost {
        opacity: 0.4;
        background: #f0f0f0;
        border: 2px dashed #667eea !important;
    }
    .sortable-images .image-item.sortable-drag {
        opacity: 0.8;
        transform: scale(1.05);
        z-index: 1000;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .image-sortable-item {
        user-select: none;
        cursor: move !important;
    }
    .image-sortable-item:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .image-sortable-item img,
    .image-sortable-item .badge {
        pointer-events: none;
    }
    .image-sortable-item .btn {
        pointer-events: auto;
        cursor: pointer;
    }
    .image-order-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        z-index: 10;
        font-weight: bold;
    }
</style>
<style>
    
    .form-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        border: 1px solid #e9ecef;
    }
    
    .section-header h5 {
        color: #667eea;
        font-size: 1.1rem;
    }
    
    .section-header hr {
        border: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea 0%, transparent 100%);
        opacity: 0.3;
    }
    
    .form-label {
        color: #495057;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .form-control, .form-select {
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    
    .input-group-text {
        border-color: #dee2e6;
        color: #6c757d;
        font-weight: 600;
    }
    
    .form-check-switch-lg {
        font-size: 1.1rem;
    }
    
    .form-check-switch-lg .form-check-input {
        width: 3rem;
        height: 1.5rem;
    }
    
    .form-check-switch-lg .form-check-label {
        font-size: 1rem;
    }
    
    #product_editor {
        height: 400px;
        background: #fff;
        border-radius: 0.375rem;
        border: 1px solid #dee2e6;
    }
    
    .ql-editor {
        min-height: 400px;
        font-size: 14px;
    }
    
    .ql-toolbar {
        border-top-left-radius: 0.375rem;
        border-top-right-radius: 0.375rem;
        border-bottom: 1px solid #dee2e6;
    }
    
    .ql-container {
        border-bottom-left-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    
    .btn-outline-secondary {
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }
    
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .card-header {
        border-radius: 0 !important;
    }
    
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    .is-valid {
        border-color: #28a745 !important;
    }
    
    .form-check {
        transition: all 0.3s ease;
    }
    
    .form-check:hover {
        transform: translateX(5px);
    }
    
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Quill Editor JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create editor container
    const textarea = document.getElementById('product_description');
    const editorDiv = document.createElement('div');
    editorDiv.id = 'product_editor';
    textarea.parentNode.insertBefore(editorDiv, textarea);
    textarea.style.display = 'none';
    
    // Initialize Quill
    const quill = new Quill('#product_editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link'],
                ['blockquote', 'code-block'],
                ['clean']
            ]
        },
        placeholder: 'Start writing your product description...'
    });
    
    // Set initial content
    @if(old('description'))
        quill.root.innerHTML = @json(old('description'));
    @endif
    
    // Update textarea before form submit
    const form = textarea.closest('form');
    form.addEventListener('submit', function(e) {
        textarea.value = quill.root.innerHTML;
        
        // Prevent submission if slug is duplicate
        if (window.slugDuplicate) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Slug Error',
                text: 'Please fix the slug error before submitting.',
                confirmButtonColor: '#667eea'
            });
            return false;
        }
    });
    
    // Auto-generate slug from name
    const nameInput = document.getElementById('product_name');
    const slugInput = document.getElementById('product_slug');
    const slugError = document.getElementById('slug_error');
    const slugSuccess = document.getElementById('slug_success');
    const submitBtn = document.getElementById('submit_btn');
    let slugCheckTimeout;
    let slugDuplicate = false;
    window.slugDuplicate = false;
    
    // Function to generate slug from text
    function generateSlug(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }
    
    // Auto-generate slug when name changes
    let isManualSlugEdit = false;
    nameInput.addEventListener('input', function() {
        if (!isManualSlugEdit) {
            const slug = generateSlug(this.value);
            slugInput.value = slug;
            if (slug) {
                checkSlugAvailability(slug);
            }
        }
    });
    
    // Track manual slug edits
    slugInput.addEventListener('input', function() {
        isManualSlugEdit = true;
        const slug = this.value.trim();
        if (slug) {
            checkSlugAvailability(slug);
        } else {
            hideSlugMessages();
        }
    });
    
    // Check slug availability
    function checkSlugAvailability(slug) {
        if (!slug || slug.trim() === '') {
            hideSlugMessages();
            return;
        }
        
        clearTimeout(slugCheckTimeout);
        slugCheckTimeout = setTimeout(function() {
            // Show loading state
            slugError.style.display = 'none';
            slugSuccess.style.display = 'none';
            
            fetch('{{ route("admin.products.check-slug") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    slug: slug.trim(),
                    product_id: null
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Slug check response:', data);
                if (data.available) {
                    slugError.style.display = 'none';
                    slugSuccess.style.display = 'block';
                    slugSuccess.textContent = data.message || 'Slug is available';
                    slugInput.classList.remove('is-invalid');
                    slugInput.classList.add('is-valid');
                    slugDuplicate = false;
                    window.slugDuplicate = false;
                    // Enable submit button
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('disabled');
                    }
                } else {
                    slugSuccess.style.display = 'none';
                    slugError.style.display = 'block';
                    slugError.textContent = data.message || 'This slug is already taken';
                    slugInput.classList.remove('is-valid');
                    slugInput.classList.add('is-invalid');
                    slugDuplicate = true;
                    window.slugDuplicate = true;
                    // Disable submit button
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('disabled');
                    }
                }
            })
            .catch(error => {
                console.error('Error checking slug:', error);
                slugError.style.display = 'block';
                slugError.textContent = 'Error checking slug availability. Please try again.';
                slugInput.classList.add('is-invalid');
                // Disable submit button on error
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('disabled');
                }
            });
        }, 500);
    }
    
    function hideSlugMessages() {
        slugError.style.display = 'none';
        slugSuccess.style.display = 'none';
        slugInput.classList.remove('is-invalid', 'is-valid');
        // Enable submit button when slug is cleared
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('disabled');
        }
    }
});

// Subcategory functionality with Select2
// Initialize Select2 after page load
setTimeout(function() {
    if (typeof jQuery === 'undefined' || typeof jQuery.fn.select2 === 'undefined') {
        console.error('jQuery or Select2 not loaded');
        return;
    }
    
    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');
    
    if (!categorySelect || !subcategorySelect) {
        console.error('Category or subcategory select not found');
        return;
    }
    
    const subcategoryWrapper = document.getElementById('subcategory_wrapper');
    
    // Initialize Select2 on category dropdown
    jQuery(categorySelect).select2({
        theme: 'bootstrap-5',
        placeholder: 'Select Category (Optional)',
        allowClear: true,
        width: '100%'
    });
    
    // Initialize Select2 on subcategory dropdown
    jQuery(subcategorySelect).select2({
        theme: 'bootstrap-5',
        placeholder: 'Select Subcategory (Optional)',
        allowClear: true,
        width: '100%',
        disabled: true
    });
    
    function loadSubcategories(categoryId) {
        if (!categoryId) {
            // Hide subcategory wrapper if no category selected
            if (subcategoryWrapper) {
                subcategoryWrapper.style.display = 'none';
            }
            jQuery(subcategorySelect).empty().append('<option value="">Select Subcategory (Optional)</option>').prop('disabled', true).trigger('change');
            return;
        }
        
        // Hide subcategory wrapper by default
        if (subcategoryWrapper) {
            subcategoryWrapper.style.display = 'none';
        }
        
        // Clear subcategory dropdown
        jQuery(subcategorySelect).empty().append('<option value="">Select Subcategory (Optional)</option>');
        jQuery(subcategorySelect).prop('disabled', true).trigger('change');
        
        // Fetch subcategories for selected category
        fetch(`/admin/api/categories/${categoryId}/subcategories`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.subcategories && data.subcategories.length > 0) {
                    // Show subcategory wrapper
                    if (subcategoryWrapper) {
                        subcategoryWrapper.style.display = 'block';
                    }
                    
                    data.subcategories.forEach(sub => {
                        const option = new Option(sub.name, sub.id, false, false);
                        jQuery(subcategorySelect).append(option);
                    });
                    jQuery(subcategorySelect).prop('disabled', false).trigger('change');
                } else {
                    // Hide subcategory wrapper if no subcategories
                    if (subcategoryWrapper) {
                        subcategoryWrapper.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching subcategories:', error);
                // Hide subcategory wrapper on error
                if (subcategoryWrapper) {
                    subcategoryWrapper.style.display = 'none';
                }
            });
    }
    
    // Use Select2 change event
    jQuery(categorySelect).on('change', function() {
        const categoryId = jQuery(this).val();
        loadSubcategories(categoryId);
    });
    
    // Handle form submission - use subcategory if selected, otherwise use category
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const subcategoryId = jQuery(subcategorySelect).val();
            
            // If subcategory is selected, use it; otherwise use the parent category
            if (subcategoryId) {
                // Create a hidden input to override category_id with subcategory_id
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'category_id';
                hiddenInput.value = subcategoryId;
                form.appendChild(hiddenInput);
                // Disable the original category select
                jQuery(categorySelect).prop('disabled', true);
            }
        });
    }
}, 100);

// Image upload functionality
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('product_images');
    const previewContainer = document.getElementById('image_preview_container');
    const placeholder = document.getElementById('image_upload_placeholder');
    let selectedImages = [];

    // Handle file selection
        imageInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            // Add new files to selectedImages if not already present
            newFiles.forEach(file => {
                if (!selectedImages.find(img => img.name === file.name && img.size === file.size)) {
                    selectedImages.push(file);
                }
            });
            handleFiles(newFiles);
        });

    // Drag and drop
    const uploadArea = document.querySelector('.image-upload-area');
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('border-primary');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-primary');
    });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('border-primary');
            const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
            // Add new files to selectedImages
            files.forEach(file => {
                if (!selectedImages.find(img => img.name === file.name && img.size === file.size)) {
                    selectedImages.push(file);
                }
            });
            handleFiles(files);
            // Update input files
            updateFileInput();
        });

    function handleFiles(files) {
        files.forEach(file => {
            if (!file.type.startsWith('image/')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File',
                    text: `${file.name} is not an image file`,
                    confirmButtonColor: '#667eea'
                });
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: `${file.name} is too large. Maximum size is 5MB`,
                    confirmButtonColor: '#667eea'
                });
                return;
            }

            selectedImages.push(file);
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-3 col-6 image-item';
                const orderNumber = selectedImages.length;
                col.innerHTML = `
                    <div class="position-relative image-sortable-item" style="cursor: move;">
                        <div class="position-absolute top-0 start-0 m-1">
                            <span class="badge bg-secondary image-order-badge">${orderNumber}</span>
                        </div>
                        <img src="${e.target.result}" class="img-fluid rounded border" style="height: 150px; width: 100%; object-fit: cover;">
                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 remove-image" data-filename="${file.name}">
                            <i class="bi bi-x"></i>
                        </button>
                        ${selectedImages.indexOf(file) === 0 ? '<span class="badge bg-primary position-absolute bottom-0 start-0 m-1">Primary</span>' : ''}
                    </div>
                `;
                previewContainer.appendChild(col);
                previewContainer.style.display = 'flex';
                placeholder.style.display = 'none';
                
                // Initialize Sortable if not already done
                if (typeof Sortable !== 'undefined' && !previewContainer.sortableInstance) {
                    previewContainer.sortableInstance = Sortable.create(previewContainer, {
                        animation: 150,
                        handle: '.image-sortable-item',
                        ghostClass: 'sortable-ghost',
                        dragClass: 'sortable-drag',
                        filter: '.btn',
                        preventOnFilter: false,
                        onEnd: function() {
                            updateOrderBadges();
                            updatePrimaryBadge();
                            updateFileOrder();
                        }
                    });
                }
                
                updateOrderBadges();
            };
            reader.readAsDataURL(file);
        });
    }

    function updateOrderBadges() {
        const items = previewContainer.querySelectorAll('.image-item');
        items.forEach((item, index) => {
            const badge = item.querySelector('.image-order-badge');
            if (badge) {
                badge.textContent = index + 1;
            }
        });
    }

    function updatePrimaryBadge() {
        // Remove all primary badges
        previewContainer.querySelectorAll('.badge.bg-primary').forEach(badge => {
            if (badge.textContent === 'Primary') {
                badge.remove();
            }
        });
        // Add primary badge to first image
        const firstItem = previewContainer.querySelector('.image-item');
        if (firstItem) {
            const primaryBadge = document.createElement('span');
            primaryBadge.className = 'badge bg-primary position-absolute bottom-0 start-0 m-1';
            primaryBadge.textContent = 'Primary';
            firstItem.querySelector('.position-relative').appendChild(primaryBadge);
        }
    }

    function updateFileOrder() {
        // Reorder selectedImages array based on DOM order
        const items = previewContainer.querySelectorAll('.image-item');
        const newOrder = [];
        items.forEach(item => {
            const filename = item.querySelector('.remove-image').dataset.filename;
            const file = selectedImages.find(img => img.name === filename);
            if (file) {
                newOrder.push(file);
            }
        });
        selectedImages = newOrder;
        
        // Update input files to match new order
        updateFileInput();
    }

    // Remove image
    previewContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-image')) {
            const btn = e.target.closest('.remove-image');
            const filename = btn.dataset.filename;
            selectedImages = selectedImages.filter(img => img.name !== filename);
            btn.closest('.image-item').remove();
            
            // Update input files
            updateFileInput();

            if (selectedImages.length === 0) {
                previewContainer.style.display = 'none';
                placeholder.style.display = 'block';
            } else {
                updateOrderBadges();
                updatePrimaryBadge();
            }
        }
    });

    // Function to update file input with selected images
    function updateFileInput() {
        if (imageInput && selectedImages.length > 0) {
            const dataTransfer = new DataTransfer();
            selectedImages.forEach(file => {
                if (file instanceof File) {
                    dataTransfer.items.add(file);
                }
            });
            imageInput.files = dataTransfer.files;
        }
    }

    // Ensure files are attached before form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Update file input one more time before submission
            updateFileInput();
            
            // Verify files are attached
            if (imageInput && imageInput.files.length === 0 && selectedImages.length > 0) {
                console.warn('Files not properly attached to input, attempting to fix...');
                updateFileInput();
            }
        });
    }
});
</script>
@endpush
@endsection
