@extends('frontend.emails.layout')

@section('content')
    <h2>Password Reset Request</h2>
    <p>Hello,</p>
    <p>We received a request to reset your password for your account at <strong>{{ $siteName ?? 'our store' }}</strong>.</p>
    
    <div class="info-box">
        <p style="font-weight: 600; margin-bottom: 10px;">If you requested this password reset, click the button below to create a new password:</p>
        <p style="margin: 0; font-size: 14px; color: #666;">This link will expire in <strong>60 minutes</strong> for security reasons.</p>
    </div>

    <div style="text-align: center; margin: 35px 0;">
        <a href="{{ $url }}" class="email-button">Reset Password</a>
    </div>

    <div class="info-box" style="background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%); border-left-color: #dc3545;">
        <p style="margin: 0; color: #721c24;"><strong>⚠️ Security Notice:</strong></p>
        <ul style="margin-top: 10px; color: #721c24;">
            <li>If you did <strong>not</strong> request a password reset, please ignore this email</li>
            <li>Your password will remain unchanged if you don't click the link</li>
            <li>Never share your password reset link with anyone</li>
            <li>If you're concerned about your account security, contact our support team immediately</li>
        </ul>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef; font-size: 14px; color: #666;">
        For security reasons, this link can only be used once. If you need to reset your password again, please request a new link.
    </p>
@endsection
