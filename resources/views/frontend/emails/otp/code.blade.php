@extends('frontend.emails.layout')

@section('content')
    <h2>Verification Code</h2>
    <p>Hello,</p>
    <p>Use the verification code below to complete your authentication. This code is valid for a limited time only.</p>
    
    <div style="text-align: center; margin: 35px 0;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; padding: 30px 40px; border-radius: 12px; display: inline-block; min-width: 250px; box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);">
            <p style="font-size: 13px; margin: 0 0 15px 0; opacity: 0.95; text-transform: uppercase; letter-spacing: 1px;">Your Verification Code</p>
            <p style="font-size: 42px; font-weight: 700; letter-spacing: 8px; margin: 0; font-family: 'Courier New', monospace;">{{ $code }}</p>
        </div>
    </div>

    <div class="info-box">
        <p><strong>⏰ Expires at:</strong> {{ $expiresAt->format('F d, Y h:i A') }}</p>
        <p style="margin-top: 15px; padding-top: 15px; border-top: 1px solid rgba(102, 126, 234, 0.2);"><strong>⏱️ Valid for:</strong> {{ $expiresAt->diffForHumans() }}</p>
    </div>

    <div class="info-box" style="background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%); border-left-color: #dc3545;">
        <p style="margin: 0; color: #721c24;"><strong>🔒 Security Notice:</strong></p>
        <ul style="margin-top: 10px; color: #721c24;">
            <li>Never share this code with anyone</li>
            <li>Our team will <strong>never</strong> ask for your verification code</li>
            <li>This code can only be used once</li>
            <li>If you didn't request this code, please ignore this email or contact support</li>
        </ul>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef; font-size: 14px; color: #666;">
        If you're having trouble with the code or didn't request it, please contact our support team immediately.
    </p>
@endsection
