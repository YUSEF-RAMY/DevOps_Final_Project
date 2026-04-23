@extends('admin.layouts.app')

@section('title', 'Import Backup')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-upload me-2"></i>Import Backup
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

                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Important:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Supported formats: JSON and CSV</li>
                        <li>Maximum file size: 10MB</li>
                        <li>Make sure you have a backup before importing</li>
                        <li>Import mode will determine how products are handled</li>
                    </ul>
                </div>

                <form action="{{ route('admin.backup.process-import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Upload Backup File
                                    </h5>
                                    
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Select Backup File</label>
                                        <input type="file" class="form-control" id="file" name="file" accept=".json,.csv,.txt" required>
                                        <div class="form-text">Accepted formats: JSON, CSV (Max: 10MB)</div>
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

                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-upload me-2"></i>Start Import
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0">
                                        <i class="bi bi-info-circle me-2"></i>Import Guide
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <h6>JSON Format:</h6>
                                    <pre class="bg-light p-2 small">{
  "products": [
    {
      "name": "Product Name",
      "slug": "product-slug",
      "price": 99.99,
      ...
    }
  ]
}</pre>
                                    
                                    <h6 class="mt-3">CSV Format:</h6>
                                    <p class="small">Must include headers: ID, Name, Slug, SKU, Category, Price, Stock, etc.</p>
                                    
                                    <div class="alert alert-warning small mt-3">
                                        <strong>Note:</strong> Categories will be created automatically if they don't exist.
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
            if (!['json', 'csv', 'txt'].includes(extension)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Please select a JSON or CSV file.',
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

