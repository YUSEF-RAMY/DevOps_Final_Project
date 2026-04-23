@extends('frontend.emails.layout')

@section('content')
    <h2>Welcome to Our Newsletter!</h2>
    <p>Hello <strong>{{ $subscriber->name ?? 'there' }}</strong>,</p>
    <p>Thank you for subscribing to our newsletter! We're thrilled to have you on board and excited to share amazing deals, new products, and exclusive content with you.</p>
    
    <div class="info-box">
        <p style="font-weight: 600; margin-bottom: 15px; color: #667eea;">As a subscriber, you'll receive:</p>
        <ul>
            <li>🎁 Exclusive deals and discounts (up to 50% off!)</li>
            <li>🆕 New product announcements and launches</li>
            <li>⭐ Special promotions and limited-time offers</li>
            <li>💡 Tips, guides, and updates about our products</li>
            <li>🎉 Early access to sales and events</li>
        </ul>
    </div>

    <div style="text-align: center; margin: 35px 0;">
        <a href="{{ url('/') }}" class="email-button">Visit Our Store</a>
    </div>

    <div class="info-box" style="background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%); border-left-color: #17a2b8;">
        <p style="margin: 0;"><strong>📧 Email Preferences:</strong> You can update your preferences or unsubscribe at any time by clicking the link at the bottom of any newsletter email.</p>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef;">
        We promise to only send you valuable content and never spam your inbox. Thank you for being part of our community!
    </p>
    <p style="margin-top: 15px;"><strong>Happy shopping!</strong></p>
@endsection
