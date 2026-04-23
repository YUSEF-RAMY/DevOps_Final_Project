@extends('frontend.emails.layout')

@section('content')
    <h2>Welcome to {{ $siteName ?? 'Our Store' }}!</h2>
    <p>Hello <strong>{{ $user->name ?? $user->email }}</strong>,</p>
    <p>Thank you for joining us! We're thrilled to have you as part of our community. Get ready to discover amazing products and exclusive deals.</p>
    
    <div class="info-box">
        <p style="font-weight: 600; margin-bottom: 15px; color: #667eea;">Your account has been successfully created. You can now:</p>
        <ul>
            <li>Browse our extensive product catalog</li>
            <li>Save items to your wishlist</li>
            <li>Track your orders in real-time</li>
            <li>Earn loyalty points with every purchase</li>
            <li>Receive exclusive offers and updates</li>
            <li>Write product reviews and ratings</li>
        </ul>
    </div>

    <div style="text-align: center; margin: 35px 0;">
        <a href="{{ url('/') }}" class="email-button">Start Shopping</a>
    </div>

    <div class="info-box" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); border-left-color: #ffc107;">
        <p style="margin: 0;"><strong>💡 Pro Tip:</strong> Complete your profile to get personalized recommendations and faster checkout!</p>
    </div>

    <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef;">
        If you have any questions or need assistance, our support team is here to help. Just reply to this email or visit our contact page.
    </p>
    <p style="margin-top: 15px;"><strong>Happy shopping!</strong></p>
@endsection
