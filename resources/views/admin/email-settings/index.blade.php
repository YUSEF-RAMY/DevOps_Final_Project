@extends('admin.layouts.app')

@section('title', 'Email Settings')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($cpanelSmtp)
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <h6 class="alert-heading"><i class="bi bi-info-circle me-2"></i>SMTP Settings Detected</h6>
        <p class="mb-2">We detected SMTP settings from: <strong>{{ $cpanelSmtp['source'] }}</strong></p>
        <button type="button" class="btn btn-sm btn-outline-primary" onclick="fillCpanelSmtp()">
            <i class="bi bi-download me-1"></i>Use Detected Settings
        </button>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-gear me-2"></i>Email Configuration</h5>
        </div>
        <form action="{{ route('admin.email-settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    @foreach($settings as $setting)
                        @if(!str_starts_with($setting->key, 'smtp_'))
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="{{ $setting->key }}" class="form-label">{{ $setting->name }}</label>
                                    
                                    @if(in_array($setting->key, ['order_confirmation_enabled', 'order_status_update_enabled']))
                                        <select name="settings[{{ $setting->key }}]" id="{{ $setting->key }}" class="form-select">
                                            <option value="1" {{ $setting->value === '1' ? 'selected' : '' }}>Enabled</option>
                                            <option value="0" {{ $setting->value === '0' ? 'selected' : '' }}>Disabled</option>
                                        </select>
                                    @else
                                        <input type="text" 
                                               name="settings[{{ $setting->key }}]" 
                                               id="{{ $setting->key }}" 
                                               value="{{ $setting->value }}" 
                                               class="form-control">
                                    @endif
                                    
                                    @if($setting->description)
                                        <small class="form-text text-muted">{{ $setting->description }}</small>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="card-footer bg-white">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Save Settings</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-server me-2"></i>SMTP Configuration</h5>
        </div>
        <form action="{{ route('admin.email-settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="smtp_enabled" name="settings[smtp_enabled]" value="1" {{ $smtpSettings['enabled'] ? 'checked' : '' }}>
                            <label class="form-check-label" for="smtp_enabled">
                                <strong>Enable SMTP</strong>
                            </label>
                        </div>
                        <small class="form-text text-muted">Enable SMTP for sending emails instead of default mailer</small>
                    </div>
                </div>

                <div id="smtp_settings_container" style="display: {{ $smtpSettings['enabled'] ? 'block' : 'none' }};">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="smtp_host">
                                SMTP Host <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="settings[smtp_host]" 
                                   id="smtp_host" 
                                   value="{{ $smtpSettings['host'] }}" 
                                   class="form-control"
                                   placeholder="mail.yourdomain.com or smtp.gmail.com">
                            <small class="form-text text-muted">SMTP server hostname</small>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="smtp_port">
                                SMTP Port <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   name="settings[smtp_port]" 
                                   id="smtp_port" 
                                   value="{{ $smtpSettings['port'] }}" 
                                   class="form-control"
                                   placeholder="587">
                            <small class="form-text text-muted">587 (TLS), 465 (SSL), or 25</small>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="smtp_encryption">
                                Encryption <span class="text-danger">*</span>
                            </label>
                            <select name="settings[smtp_encryption]" id="smtp_encryption" class="form-select">
                                <option value="tls" {{ $smtpSettings['encryption'] === 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="ssl" {{ $smtpSettings['encryption'] === 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="none" {{ $smtpSettings['encryption'] === 'none' ? 'selected' : '' }}>None</option>
                            </select>
                            <small class="form-text text-muted">Encryption method</small>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label" for="smtp_username">
                                SMTP Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="settings[smtp_username]" 
                                   id="smtp_username" 
                                   value="{{ $smtpSettings['username'] }}" 
                                   class="form-control"
                                   placeholder="your-email@domain.com">
                            <small class="form-text text-muted">Usually your email address</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="smtp_password">
                                SMTP Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   name="settings[smtp_password]" 
                                   id="smtp_password" 
                                   value="{{ $smtpSettings['password'] }}" 
                                   class="form-control"
                                   placeholder="Your SMTP password">
                            <small class="form-text text-muted">SMTP authentication password</small>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label" for="smtp_from_address">
                                From Email Address
                            </label>
                            <input type="email" 
                                   name="settings[smtp_from_address]" 
                                   id="smtp_from_address" 
                                   value="{{ $smtpSettings['from_address'] }}" 
                                   class="form-control"
                                   placeholder="noreply@yourdomain.com">
                            <small class="form-text text-muted">Email address to send from (usually same as username)</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="smtp_from_name">
                                From Name
                            </label>
                            <input type="text" 
                                   name="settings[smtp_from_name]" 
                                   id="smtp_from_name" 
                                   value="{{ $smtpSettings['from_name'] }}" 
                                   class="form-control"
                                   placeholder="Your Store Name">
                            <small class="form-text text-muted">Name displayed in the "From" field</small>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-3">
                        <h6 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>SMTP Configuration Tips</h6>
                        <ul class="mb-0 small">
                            <li><strong>Gmail:</strong> Use smtp.gmail.com, port 587 (TLS) or 465 (SSL). Enable "Less secure app access" or use App Password.</li>
                            <li><strong>cPanel/Shared Hosting:</strong> Usually mail.yourdomain.com, port 587 (TLS) or 465 (SSL).</li>
                            <li><strong>Outlook/Hotmail:</strong> Use smtp-mail.outlook.com, port 587 (TLS).</li>
                            <li><strong>Yahoo:</strong> Use smtp.mail.yahoo.com, port 587 (TLS) or 465 (SSL).</li>
                            <li>After saving, test your email configuration by sending a test email using the button below.</li>
                            <li><strong>Important:</strong> SMTP settings are applied globally to all emails sent from the website (Order confirmations, OTP codes, Password resets, etc.).</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Save SMTP Settings</button>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#testEmailModal">
                    <i class="bi bi-envelope-check me-1"></i>Send Test Email
                </button>
            </div>
        </form>
    </div>

    <!-- Test Email Modal -->
    <div class="modal fade" id="testEmailModal" tabindex="-1" aria-labelledby="testEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.email-settings.test') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="testEmailModalLabel">
                            <i class="bi bi-envelope-check me-2"></i>Send Test Email
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            This will send a test email to verify your SMTP configuration is working correctly.
                        </div>
                        <div class="mb-3">
                            <label for="test_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control" 
                                   id="test_email" 
                                   name="test_email" 
                                   value="{{ auth()->user()->email ?? '' }}" 
                                   placeholder="your-email@example.com" 
                                   required>
                            <small class="form-text text-muted">Enter the email address where you want to receive the test email</small>
                        </div>
                        @if($smtpSettings['enabled'])
                            <div class="alert alert-success">
                                <strong>SMTP Status:</strong> Enabled<br>
                                <strong>Host:</strong> {{ $smtpSettings['host'] ?: 'Not set' }}<br>
                                <strong>Port:</strong> {{ $smtpSettings['port'] }}<br>
                                <strong>Encryption:</strong> {{ strtoupper($smtpSettings['encryption']) }}
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Note:</strong> SMTP is currently disabled. Enable it above and save before sending a test email.
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" {{ !$smtpSettings['enabled'] ? 'disabled' : '' }}>
                            <i class="bi bi-send me-1"></i>Send Test Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-file-text me-2"></i>Email Templates</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <h6 class="alert-heading">Available Email Templates:</h6>
                <ul class="mb-0 small">
                    <li><strong>Order Confirmation:</strong> Sent when a customer places an order</li>
                    <li><strong>Order Status Update:</strong> Sent when order status changes</li>
                    <li><strong>Password Reset:</strong> Sent when user requests password reset</li>
                    <li><strong>Welcome Email:</strong> Sent to new users after registration</li>
                    <li><strong>OTP Code:</strong> Sent for email OTP verification</li>
                </ul>
            </div>
            <p class="text-muted small mb-0">
                Email templates can be customized by modifying the notification classes in 
                <code>app/Notifications/</code> directory.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const smtpEnabled = document.getElementById('smtp_enabled');
    const smtpContainer = document.getElementById('smtp_settings_container');
    
    if (!smtpEnabled || !smtpContainer) return;
    
    function toggleSmtpSettings() {
        if (smtpEnabled.checked) {
            smtpContainer.style.display = 'block';
            // Make required fields actually required
            const requiredFields = ['smtp_host', 'smtp_port', 'smtp_username', 'smtp_password'];
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) field.setAttribute('required', 'required');
            });
        } else {
            smtpContainer.style.display = 'none';
            // Remove required attribute
            const requiredFields = ['smtp_host', 'smtp_port', 'smtp_username', 'smtp_password'];
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) field.removeAttribute('required');
            });
        }
    }
    
    smtpEnabled.addEventListener('change', toggleSmtpSettings);
    toggleSmtpSettings(); // Initial check
});

@if(isset($cpanelSmtp) && $cpanelSmtp)
function fillCpanelSmtp() {
    const cpanelSmtp = @json($cpanelSmtp);
    
    if (cpanelSmtp.host) {
        const hostField = document.getElementById('smtp_host');
        if (hostField) hostField.value = cpanelSmtp.host;
    }
    if (cpanelSmtp.port) {
        const portField = document.getElementById('smtp_port');
        if (portField) portField.value = cpanelSmtp.port;
    }
    if (cpanelSmtp.username) {
        const usernameField = document.getElementById('smtp_username');
        if (usernameField) usernameField.value = cpanelSmtp.username;
    }
    if (cpanelSmtp.password) {
        const passwordField = document.getElementById('smtp_password');
        if (passwordField) passwordField.value = cpanelSmtp.password;
    }
    if (cpanelSmtp.encryption) {
        const encryptionField = document.getElementById('smtp_encryption');
        if (encryptionField) encryptionField.value = cpanelSmtp.encryption;
    }
    if (cpanelSmtp.from_address) {
        const fromAddressField = document.getElementById('smtp_from_address');
        if (fromAddressField) fromAddressField.value = cpanelSmtp.from_address;
    }
    if (cpanelSmtp.from_name) {
        const fromNameField = document.getElementById('smtp_from_name');
        if (fromNameField) fromNameField.value = cpanelSmtp.from_name;
    }
    
    // Enable SMTP
    const smtpEnabled = document.getElementById('smtp_enabled');
    if (smtpEnabled) {
        smtpEnabled.checked = true;
        smtpEnabled.dispatchEvent(new Event('change'));
    }
    
    // Show success message
    Swal.fire({
        icon: 'info',
        title: 'Settings Detected',
        text: 'SMTP settings have been filled from detected configuration. Please review and save.',
        confirmButtonColor: '#667eea'
    });
}
@endif
</script>
@endpush
@endsection
