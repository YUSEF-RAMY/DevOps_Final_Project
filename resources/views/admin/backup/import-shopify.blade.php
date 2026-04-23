@extends('admin.layouts.app')

@section('title', 'Import from Shopify')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-shop me-2"></i>Import from Shopify
                    </h3>
                    <a href="{{ route('admin.backup.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Back to Backup
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('import_details'))
                    @php $details = session('import_details'); @endphp
                    <div class="alert alert-info">
                        <h6><i class="bi bi-info-circle me-2"></i>Import Details:</h6>
                        <ul class="mb-0">
                            <li>Imported: <strong>{{ $details['imported'] }}</strong></li>
                            <li>Updated: <strong>{{ $details['updated'] }}</strong></li>
                            <li>Skipped: <strong>{{ $details['skipped'] }}</strong></li>
                            @if(!empty($details['errors']))
                                <li>Errors: <strong>{{ count($details['errors']) }}</strong></li>
                                <details class="mt-2">
                                    <summary>View Errors</summary>
                                    <ul class="mt-2">
                                        @foreach($details['errors'] as $error)
                                            <li class="text-danger small">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </details>
                            @endif
                        </ul>
                    </div>
                @endif

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Shopify Import Guide:</strong>
                    <ol class="mb-0 mt-2">
                        <li>Go to Shopify Admin → Products</li>
                        <li>Click "Export" button</li>
                        <li>Select "Export all products" or choose specific products</li>
                        <li>Download the CSV file</li>
                        <li>Upload the CSV file here</li>
                        <li>Products, variants, prices, and images will be imported automatically</li>
                    </ol>
                </div>

                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Important:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Supported format: CSV (Shopify product export)</li>
                        <li>Maximum file size: 10MB</li>
                        <li>Make sure you have a backup before importing</li>
                        <li>Categories will be created from Product Type</li>
                        <li>Product variants will be imported as separate products</li>
                        <li>Product images will be imported from Shopify</li>
                    </ul>
                </div>

                <form action="{{ route('admin.backup.process-shopify-import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Upload Shopify Export File
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Select Shopify CSV File</label>
                                        <input type="file" class="form-control" id="file" name="file" accept=".csv,.txt" required>
                                        <div class="form-text">Accepted format: CSV (Shopify product export) - Max: 10MB</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="import_mode" class="form-label">Import Mode</label>
                                        <select class="form-select" id="import_mode" name="import_mode" required>
                                            <option value="create">Create Only (Skip existing)</option>
                                            <option value="update">Update or Create</option>
                                            <option value="replace">Replace (Delete & Create)</option>
                                        </select>
                                        <div class="form-text">
                                            <strong>Create:</strong> Only import new products, skip existing ones.<br>
                                            <strong>Update:</strong> Update existing products or create new ones.<br>
                                            <strong>Replace:</strong> Delete existing products and create new ones (use with caution).
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-upload me-2"></i>Start Shopify Import
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">
                                        <i class="bi bi-info-circle me-2"></i>Shopify Export Guide
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <h6>How to Export from Shopify:</h6>
                                    <ol class="small">
                                        <li>Go to Shopify Admin → Products</li>
                                        <li>Click "Export" button (top right)</li>
                                        <li>Select "Export all products" or choose specific products</li>
                                        <li>Click "Export products"</li>
                                        <li>Download the CSV file when ready</li>
                                        <li>Upload it here</li>
                                    </ol>
                                    
                                    <h6 class="mt-3">What Gets Imported:</h6>
                                    <ul class="small">
                                        <li>Product titles and descriptions</li>
                                        <li>Variant prices and compare prices</li>
                                        <li>Inventory quantities</li>
                                        <li>Product types (as categories)</li>
                                        <li>Product images (up to 5 per product)</li>
                                        <li>Variant SKUs</li>
                                        <li>Product tags</li>
                                    </ul>
                                    
                                    <div class="alert alert-warning small mt-3">
                                        <strong>Note:</strong> Each product variant will be imported as a separate product.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('importForm');
    const fileInput = document.getElementById('file');
    
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const maxSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'File size must be less than 10MB.',
                });
                this.value = '';
                return;
            }
            
            const extension = file.name.split('.').pop().toLowerCase();
            if (!['csv', 'txt'].includes(extension)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Please select a Shopify CSV export file.',
                });
                this.value = '';
                return;
            }
        }
    });
    
    form.addEventListener('submit', function(e) {
        const importMode = document.getElementById('import_mode').value;
        
        if (importMode === 'replace') {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Confirm Replace Mode',
                text: 'Replace mode will DELETE existing products and create new ones. This action cannot be undone. Are you sure?',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Continue',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
@endpush
@endsection

