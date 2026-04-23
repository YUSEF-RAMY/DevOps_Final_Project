@extends('admin.layouts.app')

@section('title', 'Storage & CDN Settings')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>Please fix the errors below.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-cloud-upload me-2"></i>Storage & CDN Configuration</h5>
        </div>
        <form action="{{ route('admin.storage-settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- Storage Driver Selection -->
                <div class="card mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-semibold">Storage Driver</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Storage Provider</label>
                            <select name="storage_driver" id="storage_driver" class="form-select" required>
                                <option value="local" {{ $currentDriver === 'local' ? 'selected' : '' }}>Local Storage</option>
                                <option value="s3" {{ $currentDriver === 's3' ? 'selected' : '' }}>AWS S3</option>
                                <option value="cloudflare" {{ $currentDriver === 'cloudflare' ? 'selected' : '' }}>Cloudflare R2</option>
                                <option value="digitalocean" {{ $currentDriver === 'digitalocean' ? 'selected' : '' }}>DigitalOcean Spaces</option>
                                <option value="wasabi" {{ $currentDriver === 'wasabi' ? 'selected' : '' }}>Wasabi</option>
                                <option value="backblaze" {{ $currentDriver === 'backblaze' ? 'selected' : '' }}>Backblaze B2</option>
                            </select>
                            <small class="text-muted">Choose where your files will be stored</small>
                        </div>
                    </div>
                </div>

                <!-- AWS S3 Settings -->
                <div class="card mb-4 storage-provider" id="s3-settings" style="display: {{ $currentDriver === 's3' ? 'block' : 'none' }};">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-amazon me-2"></i>AWS S3 Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Access Key ID <span class="text-danger">*</span></label>
                                <input type="text" name="s3_key" class="form-control" value="{{ old('s3_key', $storageSettings['s3']['key']) }}" placeholder="AKIAIOSFODNN7EXAMPLE">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Secret Access Key <span class="text-danger">*</span></label>
                                <input type="password" name="s3_secret" class="form-control" value="{{ old('s3_secret', $storageSettings['s3']['secret']) }}" placeholder="wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Region <span class="text-danger">*</span></label>
                                <input type="text" name="s3_region" class="form-control" value="{{ old('s3_region', $storageSettings['s3']['region']) }}" placeholder="us-east-1">
                                <small class="text-muted">e.g., us-east-1, ap-southeast-1</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bucket Name <span class="text-danger">*</span></label>
                                <input type="text" name="s3_bucket" class="form-control" value="{{ old('s3_bucket', $storageSettings['s3']['bucket']) }}" placeholder="my-bucket">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">S3 URL (Optional)</label>
                                <input type="url" name="s3_url" class="form-control" value="{{ old('s3_url', $storageSettings['s3']['url']) }}" placeholder="https://my-bucket.s3.amazonaws.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Endpoint (Optional)</label>
                                <input type="url" name="s3_endpoint" class="form-control" value="{{ old('s3_endpoint', $storageSettings['s3']['endpoint']) }}" placeholder="https://s3.amazonaws.com">
                                <small class="text-muted">For S3-compatible services</small>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="s3_use_path_style" id="s3_use_path_style" value="1" {{ $storageSettings['s3']['use_path_style'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="s3_use_path_style">Use Path Style Endpoint</label>
                                    <small class="text-muted d-block">Required for some S3-compatible services</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cloudflare R2 Settings -->
                <div class="card mb-4 storage-provider" id="cloudflare-settings" style="display: {{ $currentDriver === 'cloudflare' ? 'block' : 'none' }};">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-cloud me-2"></i>Cloudflare R2 Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Account ID <span class="text-danger">*</span></label>
                                <input type="text" name="cloudflare_account_id" class="form-control" value="{{ old('cloudflare_account_id', $storageSettings['cloudflare']['account_id']) }}" placeholder="your-account-id">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Access Key ID <span class="text-danger">*</span></label>
                                <input type="text" name="cloudflare_access_key_id" class="form-control" value="{{ old('cloudflare_access_key_id', $storageSettings['cloudflare']['access_key_id']) }}" placeholder="your-access-key-id">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Secret Access Key <span class="text-danger">*</span></label>
                                <input type="password" name="cloudflare_secret_access_key" class="form-control" value="{{ old('cloudflare_secret_access_key', $storageSettings['cloudflare']['secret_access_key']) }}" placeholder="your-secret-key">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bucket Name <span class="text-danger">*</span></label>
                                <input type="text" name="cloudflare_bucket" class="form-control" value="{{ old('cloudflare_bucket', $storageSettings['cloudflare']['bucket']) }}" placeholder="my-r2-bucket">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Endpoint (Optional)</label>
                                <input type="url" name="cloudflare_endpoint" class="form-control" value="{{ old('cloudflare_endpoint', $storageSettings['cloudflare']['endpoint']) }}" placeholder="https://your-account-id.r2.cloudflarestorage.com">
                                <small class="text-muted">Auto-generated if empty: https://{account-id}.r2.cloudflarestorage.com</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DigitalOcean Spaces Settings -->
                <div class="card mb-4 storage-provider" id="digitalocean-settings" style="display: {{ $currentDriver === 'digitalocean' ? 'block' : 'none' }};">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-droplet me-2"></i>DigitalOcean Spaces Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Spaces Key <span class="text-danger">*</span></label>
                                <input type="text" name="digitalocean_key" class="form-control" value="{{ old('digitalocean_key', $storageSettings['digitalocean']['key']) }}" placeholder="your-spaces-key">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Spaces Secret <span class="text-danger">*</span></label>
                                <input type="password" name="digitalocean_secret" class="form-control" value="{{ old('digitalocean_secret', $storageSettings['digitalocean']['secret']) }}" placeholder="your-spaces-secret">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Region <span class="text-danger">*</span></label>
                                <input type="text" name="digitalocean_region" class="form-control" value="{{ old('digitalocean_region', $storageSettings['digitalocean']['region']) }}" placeholder="nyc3">
                                <small class="text-muted">e.g., nyc3, sgp1, ams3</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bucket Name <span class="text-danger">*</span></label>
                                <input type="text" name="digitalocean_bucket" class="form-control" value="{{ old('digitalocean_bucket', $storageSettings['digitalocean']['bucket']) }}" placeholder="my-space">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Endpoint (Optional)</label>
                                <input type="url" name="digitalocean_endpoint" class="form-control" value="{{ old('digitalocean_endpoint', $storageSettings['digitalocean']['endpoint']) }}" placeholder="https://nyc3.digitaloceanspaces.com">
                                <small class="text-muted">Auto-generated if empty: https://{region}.digitaloceanspaces.com</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wasabi Settings -->
                <div class="card mb-4 storage-provider" id="wasabi-settings" style="display: {{ $currentDriver === 'wasabi' ? 'block' : 'none' }};">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-water me-2"></i>Wasabi Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Access Key <span class="text-danger">*</span></label>
                                <input type="text" name="wasabi_key" class="form-control" value="{{ old('wasabi_key', $storageSettings['wasabi']['key']) }}" placeholder="your-access-key">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Secret Key <span class="text-danger">*</span></label>
                                <input type="password" name="wasabi_secret" class="form-control" value="{{ old('wasabi_secret', $storageSettings['wasabi']['secret']) }}" placeholder="your-secret-key">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Region <span class="text-danger">*</span></label>
                                <input type="text" name="wasabi_region" class="form-control" value="{{ old('wasabi_region', $storageSettings['wasabi']['region']) }}" placeholder="us-east-1">
                                <small class="text-muted">e.g., us-east-1, eu-central-1</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bucket Name <span class="text-danger">*</span></label>
                                <input type="text" name="wasabi_bucket" class="form-control" value="{{ old('wasabi_bucket', $storageSettings['wasabi']['bucket']) }}" placeholder="my-wasabi-bucket">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Endpoint (Optional)</label>
                                <input type="url" name="wasabi_endpoint" class="form-control" value="{{ old('wasabi_endpoint', $storageSettings['wasabi']['endpoint']) }}" placeholder="https://s3.us-east-1.wasabisys.com">
                                <small class="text-muted">Auto-generated if empty: https://s3.{region}.wasabisys.com</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Backblaze B2 Settings -->
                <div class="card mb-4 storage-provider" id="backblaze-settings" style="display: {{ $currentDriver === 'backblaze' ? 'block' : 'none' }};">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-shield-check me-2"></i>Backblaze B2 Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Key ID <span class="text-danger">*</span></label>
                                <input type="text" name="backblaze_key_id" class="form-control" value="{{ old('backblaze_key_id', $storageSettings['backblaze']['key_id']) }}" placeholder="your-key-id">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Application Key <span class="text-danger">*</span></label>
                                <input type="password" name="backblaze_application_key" class="form-control" value="{{ old('backblaze_application_key', $storageSettings['backblaze']['application_key']) }}" placeholder="your-application-key">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bucket ID <span class="text-danger">*</span></label>
                                <input type="text" name="backblaze_bucket_id" class="form-control" value="{{ old('backblaze_bucket_id', $storageSettings['backblaze']['bucket_id']) }}" placeholder="your-bucket-id">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bucket Name <span class="text-danger">*</span></label>
                                <input type="text" name="backblaze_bucket_name" class="form-control" value="{{ old('backblaze_bucket_name', $storageSettings['backblaze']['bucket_name']) }}" placeholder="my-b2-bucket">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CDN Settings -->
                <div class="card mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-lightning-charge me-2"></i>CDN Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="cdn_enabled" id="cdn_enabled" value="1" {{ $storageSettings['cdn']['enabled'] ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="cdn_enabled">Enable CDN</label>
                                    <small class="text-muted d-block">Enable CDN for serving static files (images, CSS, JS)</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">CDN URL</label>
                                <input type="url" name="cdn_url" class="form-control" value="{{ old('cdn_url', $storageSettings['cdn']['url']) }}" placeholder="https://cdn.yourdomain.com or https://your-cloudflare-cdn.com">
                                <small class="text-muted">CDN URL for serving static assets. Leave empty if using Cloudflare automatic CDN.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Settings
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const driverSelect = document.getElementById('storage_driver');
    const providerSettings = document.querySelectorAll('.storage-provider');

    function toggleProviderSettings() {
        const selectedDriver = driverSelect.value;
        providerSettings.forEach(provider => {
            provider.style.display = 'none';
        });
        
        if (selectedDriver !== 'local') {
            const selectedProvider = document.getElementById(selectedDriver + '-settings');
            if (selectedProvider) {
                selectedProvider.style.display = 'block';
            }
        }
    }

    driverSelect.addEventListener('change', toggleProviderSettings);
});
</script>
@endpush
@endsection

