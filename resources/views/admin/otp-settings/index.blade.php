@extends('admin.layouts.app')

@section('title', 'OTP Settings')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.otp-settings.update') }}">
        @csrf
        @method('PUT')

        <div class="row g-3">
          <div class="col-md-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="email_enabled" name="email_enabled" value="1" {{ $settings->email_enabled ? 'checked' : '' }}>
              <label class="form-check-label" for="email_enabled">Enable Email OTP</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="sms_enabled" name="sms_enabled" value="1" {{ $settings->sms_enabled ? 'checked' : '' }}>
              <label class="form-check-label" for="sms_enabled">Enable SMS OTP</label>
            </div>
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-3">
            <label class="form-label" for="length">Code Length</label>
            <input type="number" min="4" max="8" class="form-control @error('length') is-invalid @enderror" id="length" name="length" value="{{ old('length', $settings->length) }}" required>
            @error('length')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-3">
            <label class="form-label" for="ttl_minutes">TTL (minutes)</label>
            <input type="number" min="1" max="60" class="form-control @error('ttl_minutes') is-invalid @enderror" id="ttl_minutes" name="ttl_minutes" value="{{ old('ttl_minutes', $settings->ttl_minutes) }}" required>
            @error('ttl_minutes')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-3">
            <label class="form-label" for="max_attempts">Max Attempts</label>
            <input type="number" min="1" max="10" class="form-control @error('max_attempts') is-invalid @enderror" id="max_attempts" name="max_attempts" value="{{ old('max_attempts', $settings->max_attempts) }}" required>
            @error('max_attempts')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-4">
            <label class="form-label" for="sms_package">SMS Package/Provider <span class="text-danger">*</span></label>
            <select class="form-select @error('sms_package') is-invalid @enderror" id="sms_package" name="sms_package" required>
              <option value="">Select Package</option>
              @foreach($smsPackages as $key => $package)
                <option value="{{ $key }}" 
                  {{ old('sms_package', $settings->sms_package) === $key ? 'selected' : '' }}
                  data-sandbox="{{ $package['sandbox'] ? 'true' : 'false' }}"
                  data-required="{{ json_encode($package['required_fields'] ?? []) }}"
                  data-optional="{{ json_encode($package['optional_fields'] ?? []) }}">
                  {{ $package['name'] }}{{ $package['sandbox'] ? ' (Sandbox Available)' : '' }}
                </option>
              @endforeach
            </select>
            @error('sms_package')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted">Select the SMS service provider package you want to use</small>
            @if($settings->sms_package && isset($smsPackages[$settings->sms_package]))
              <div class="alert alert-info mt-2 small">
                <strong>{{ $smsPackages[$settings->sms_package]['name'] }}:</strong> 
                {{ $smsPackages[$settings->sms_package]['description'] ?? 'Configure credentials below' }}
              </div>
            @endif
          </div>
          <div class="col-md-4" id="sandbox_mode_container" style="display: none;">
            <div class="form-check form-switch mt-4">
              <input type="hidden" name="sandbox_mode" value="0">
              <input class="form-check-input" type="checkbox" id="sandbox_mode" name="sandbox_mode" value="1" {{ old('sandbox_mode', $settings->sandbox_mode) ? 'checked' : '' }}>
              <label class="form-check-label" for="sandbox_mode">
                Enable Sandbox/Test Mode
              </label>
            </div>
            <small class="form-text text-muted">Use sandbox/test credentials for testing (no real SMS will be sent)</small>
          </div>
        </div>

        <div class="row g-3 mt-1" id="custom_gateway_row" style="display: {{ ($settings->sms_package === 'laravel_bdsms' || $settings->sms_package === 'custom') ? 'block' : 'none' }};">
          <div class="col-md-4">
            <label class="form-label" for="sms_gateway" id="sms_gateway_label">
              SMS Gateway <span class="field-required-indicator" style="display: none;"><span class="text-danger">*</span></span>
            </label>
            <input type="text" class="form-control @error('sms_gateway') is-invalid @enderror" id="sms_gateway" name="sms_gateway" value="{{ old('sms_gateway', $settings->sms_gateway ?? config('services.sms.gateway')) }}" placeholder="e.g., mim_sms, ssl, robi, etc.">
            @error('sms_gateway')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted field-help-text" id="sms_gateway_help">Required for Laravel BDSMS (e.g., mim_sms, ssl, robi, gp, banglalink, teletalk)</small>
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-6">
            <label class="form-label" for="sms_api_url" id="sms_api_url_label">
              SMS API URL <span class="field-required-indicator" style="display: none;"><span class="text-danger">*</span></span>
            </label>
            <input type="text" class="form-control @error('sms_api_url') is-invalid @enderror" id="sms_api_url" name="sms_api_url" value="{{ old('sms_api_url', $settings->sms_api_url) }}" placeholder="API endpoint URL or Region">
            @error('sms_api_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted field-help-text" id="sms_api_url_help">Required for Custom package and Clickatell (AWS SNS: region like us-east-1)</small>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="sms_api_key" id="sms_api_key_label">
              SMS API Key <span class="field-required-indicator" style="display: none;"><span class="text-danger">*</span></span>
            </label>
            <input type="password" class="form-control @error('sms_api_key') is-invalid @enderror" id="sms_api_key" name="sms_api_key" value="{{ old('sms_api_key', $settings->sms_api_key) }}" placeholder="API Key/Token">
            @error('sms_api_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted field-help-text" id="sms_api_key_help">Required for: Twilio (Account SID), Vonage (API Key), MessageBird (API Key), Clickatell, Custom</small>
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-6">
            <label class="form-label" for="sms_username" id="sms_username_label">
              SMS Username / Account ID <span class="field-required-indicator" style="display: none;"><span class="text-danger">*</span></span>
            </label>
            <input type="text" class="form-control @error('sms_username') is-invalid @enderror" id="sms_username" name="sms_username" value="{{ old('sms_username', $settings->sms_username) }}" placeholder="Username or Account ID">
            @error('sms_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted field-help-text" id="sms_username_help">Twilio: Account SID (or use API Key field) | Plivo: Auth ID | AWS: Access Key ID | Custom: Username</small>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="sms_password" id="sms_password_label">
              SMS Password / Auth Token <span class="field-required-indicator" style="display: none;"><span class="text-danger">*</span></span>
            </label>
            <input type="password" class="form-control @error('sms_password') is-invalid @enderror" id="sms_password" name="sms_password" value="{{ old('sms_password', $settings->sms_password) }}" placeholder="Password or Auth Token">
            @error('sms_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted field-help-text" id="sms_password_help">Twilio: Auth Token | Vonage: API Secret | Plivo: Auth Token | AWS: Secret Access Key | Custom: Password</small>
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-6">
            <label class="form-label" for="sms_sender" id="sms_sender_label">
              SMS Sender / From Number <span class="field-required-indicator" style="display: none;"><span class="text-danger">*</span></span>
            </label>
            <input type="text" class="form-control @error('sms_sender') is-invalid @enderror" id="sms_sender" name="sms_sender" value="{{ old('sms_sender', $settings->sms_sender) }}" placeholder="Phone number or sender ID">
            @error('sms_sender')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted field-help-text" id="sms_sender_help">Required for: Twilio (From number), Vonage (From number), MessageBird (Originator), Plivo (From number)</small>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="sms_masking" id="sms_masking_label">
              SMS Masking/Sender ID <span class="field-required-indicator" style="display: none;"><span class="text-danger">*</span></span>
            </label>
            <input type="text" class="form-control @error('sms_masking') is-invalid @enderror" id="sms_masking" name="sms_masking" value="{{ old('sms_masking', $settings->sms_masking ?? config('services.sms.masking')) }}" placeholder="e.g., YourBrand">
            @error('sms_masking')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="form-text text-muted field-help-text" id="sms_masking_help">The name/number that appears as sender</small>
          </div>
        </div>
        
        <div class="alert alert-info mt-3">
          <h6 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Configuration Guide</h6>
          <ul class="mb-0 small">
            <li><strong>Laravel BDSMS:</strong> Requires SMS Gateway (e.g., mim_sms), SMS Masking, Username, Password</li>
            <li><strong>Twilio:</strong> Requires API Key (Account SID), Password (Auth Token), Sender (From number)</li>
            <li><strong>Vonage:</strong> Requires API Key, Password (API Secret), Sender (From number)</li>
            <li><strong>MessageBird:</strong> Requires API Key, Sender (Originator)</li>
            <li><strong>AWS SNS:</strong> Requires Username (Access Key ID), Password (Secret Access Key), API URL (Region)</li>
            <li><strong>Clickatell:</strong> Requires API Key, API URL (endpoint)</li>
            <li><strong>Plivo:</strong> Requires Username (Auth ID), Password (Auth Token), Sender (From number)</li>
            <li><strong>Custom:</strong> Requires API URL, and either API Key or Username/Password</li>
          </ul>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Save Settings</button>
        </div>
      </form>
    </div>
  </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const smsPackageSelect = document.getElementById('sms_package');
    const sandboxContainer = document.getElementById('sandbox_mode_container');
    const sandboxCheckbox = document.getElementById('sandbox_mode');
    const customGatewayRow = document.getElementById('custom_gateway_row');
    
    // Field mapping
    const fieldMap = {
        'sms_gateway': { row: customGatewayRow, label: 'SMS Gateway', help: {} },
        'sms_api_url': { label: 'SMS API URL', help: {} },
        'sms_api_key': { label: 'SMS API Key', help: {} },
        'sms_username': { label: 'SMS Username / Account ID', help: {} },
        'sms_password': { label: 'SMS Password / Auth Token', help: {} },
        'sms_sender': { label: 'SMS Sender / From Number', help: {} },
        'sms_masking': { label: 'SMS Masking/Sender ID', help: {} },
    };
    
    // Help text for each package and field
    const helpTexts = {
        'laravel_bdsms': {
            'sms_gateway': 'Required: SMS Gateway (e.g., mim_sms, ssl, robi, gp, banglalink, teletalk)',
            'sms_username': 'Required: Username for SMS gateway',
            'sms_password': 'Required: Password for SMS gateway',
            'sms_masking': 'Required: SMS Masking/Sender ID',
            'sms_sender': 'Optional: Additional sender information',
        },
        'twilio': {
            'sms_api_key': 'Required: Twilio Account SID',
            'sms_password': 'Required: Twilio Auth Token',
            'sms_sender': 'Required: Twilio From number (e.g., +1234567890)',
            'sms_username': 'Optional: Additional account identifier',
        },
        'vonage': {
            'sms_api_key': 'Required: Vonage API Key',
            'sms_password': 'Required: Vonage API Secret',
            'sms_sender': 'Required: Vonage From number or name',
        },
        'messagebird': {
            'sms_api_key': 'Required: MessageBird API Key',
            'sms_sender': 'Required: MessageBird Originator (sender name or number)',
        },
        'aws_sns': {
            'sms_username': 'Required: AWS Access Key ID',
            'sms_password': 'Required: AWS Secret Access Key',
            'sms_api_url': 'Required: AWS Region (e.g., us-east-1, eu-west-1)',
            'sms_sender': 'Optional: Sender ID (if supported in your region)',
        },
        'clickatell': {
            'sms_api_key': 'Required: Clickatell API Key',
            'sms_api_url': 'Required: Clickatell API endpoint URL',
            'sms_sender': 'Optional: Sender ID',
        },
        'plivo': {
            'sms_username': 'Required: Plivo Auth ID',
            'sms_password': 'Required: Plivo Auth Token',
            'sms_sender': 'Required: Plivo From number',
        },
        'custom': {
            'sms_api_url': 'Required: Custom API endpoint URL',
            'sms_api_key': 'Optional: API Key (if using API key authentication)',
            'sms_username': 'Optional: Username (if using basic authentication)',
            'sms_password': 'Optional: Password (if using basic authentication)',
            'sms_sender': 'Optional: Sender ID',
            'sms_gateway': 'Optional: Gateway identifier',
        },
    };
    
    function toggleFields() {
        const selectedOption = smsPackageSelect.options[smsPackageSelect.selectedIndex];
        const hasSandbox = selectedOption.getAttribute('data-sandbox') === 'true';
        const packageValue = smsPackageSelect.value;
        
        // Get required and optional fields
        let requiredFields = [];
        let optionalFields = [];
        
        try {
            requiredFields = JSON.parse(selectedOption.getAttribute('data-required') || '[]');
            optionalFields = JSON.parse(selectedOption.getAttribute('data-optional') || '[]');
        } catch (e) {
            console.error('Error parsing field data:', e);
        }
        
        // Toggle sandbox mode
        if (hasSandbox && packageValue) {
            sandboxContainer.style.display = 'block';
        } else {
            sandboxContainer.style.display = 'none';
            sandboxCheckbox.checked = false;
        }
        
        // Update all fields
        Object.keys(fieldMap).forEach(fieldId => {
            const field = document.getElementById(fieldId);
            const label = document.getElementById(fieldId + '_label');
            const help = document.getElementById(fieldId + '_help');
            const requiredIndicator = label ? label.querySelector('.field-required-indicator') : null;
            const fieldInfo = fieldMap[fieldId];
            
            if (!field || !label) return;
            
            const isRequired = requiredFields.includes(fieldId);
            const isOptional = optionalFields.includes(fieldId);
            const isRelevant = isRequired || isOptional || packageValue === 'custom';
            
            // Show/hide field based on relevance
            // For SMS Gateway, handle via custom row
            if (fieldId === 'sms_gateway') {
                if (packageValue === 'laravel_bdsms' || packageValue === 'custom') {
                    customGatewayRow.style.display = 'block';
                } else {
                    customGatewayRow.style.display = 'none';
                }
            } else {
                // For other fields, find the parent column
                const fieldCol = field.closest('.col-md-6') || field.closest('.col-md-4');
                if (fieldCol) {
                    // Show if required, optional, custom package, or no package selected
                    if (isRequired || isOptional || packageValue === 'custom' || packageValue === '') {
                        fieldCol.style.display = '';
                        field.style.display = '';
                    } else if (packageValue) {
                        // Hide if not relevant and a package is selected
                        fieldCol.style.display = 'none';
                    } else {
                        // Show all fields if no package selected
                        fieldCol.style.display = '';
                    }
                }
            }
            
            // Update required indicator
            if (requiredIndicator) {
                if (isRequired) {
                    requiredIndicator.style.display = 'inline';
                    field.setAttribute('required', 'required');
                    field.classList.add('border-warning');
                } else {
                    requiredIndicator.style.display = 'none';
                    field.removeAttribute('required');
                    field.classList.remove('border-warning');
                }
            }
            
            // Update help text
            if (packageValue && help) {
                if (helpTexts[packageValue] && helpTexts[packageValue][fieldId]) {
                    help.textContent = helpTexts[packageValue][fieldId];
                    help.style.display = 'block';
                } else if (isRequired) {
                    help.textContent = 'This field is required for the selected package.';
                    help.style.display = 'block';
                } else if (isOptional) {
                    help.textContent = 'This field is optional but recommended.';
                    help.style.display = 'block';
                } else if (!isRelevant && packageValue !== 'custom') {
                    help.style.display = 'none';
                } else {
                    help.style.display = 'block';
                }
            } else if (help) {
                // Show default help text when no package selected
                help.style.display = 'block';
            }
        });
    }
    
    // Initial check
    toggleFields();
    
    // Listen for changes
    smsPackageSelect.addEventListener('change', toggleFields);
});
</script>
@endpush
@endsection
