<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Email' }}</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td {font-family: Arial, sans-serif !important;}
        .email-container { width: 600px !important; }
    </style>
    <![endif]-->
    <style>
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f7fa;
            line-height: 1.6;
            color: #333333;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        
        /* Email Wrapper */
        .email-wrapper {
            width: 100%;
            background-color: #f5f7fa;
            padding: 40px 20px;
        }
        
        /* Email Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        /* Email Header */
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        .email-header-content {
            position: relative;
            z-index: 1;
        }
        .email-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .email-header p {
            font-size: 14px;
            opacity: 0.95;
            margin: 0;
        }
        
        /* Email Body */
        .email-body {
            padding: 40px 30px;
        }
        
        /* Email Content */
        .email-content {
            color: #333333;
            font-size: 16px;
            line-height: 1.7;
        }
        .email-content h2 {
            color: #667eea;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 700;
            line-height: 1.3;
        }
        .email-content h3 {
            color: #667eea;
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .email-content p {
            margin-bottom: 15px;
            color: #555555;
        }
        .email-content strong {
            color: #333333;
            font-weight: 600;
        }
        
        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
        }
        .info-box p {
            margin-bottom: 10px;
        }
        .info-box p:last-child {
            margin-bottom: 0;
        }
        .info-box strong {
            color: #667eea;
        }
        .info-box ul {
            margin-left: 20px;
            margin-top: 10px;
            color: #555555;
        }
        .info-box li {
            margin-bottom: 8px;
        }
        
        /* Email Button */
        .email-button {
            display: inline-block;
            padding: 14px 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }
        .email-button:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }
        .email-button-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 4px 12px rgba(240, 147, 251, 0.3);
        }
        .email-button-secondary:hover {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
            box-shadow: 0 6px 16px rgba(240, 147, 251, 0.4);
        }
        
        /* Table Styles */
        .email-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
        }
        .email-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: top;
        }
        .email-table td:first-child {
            font-weight: 600;
            color: #667eea;
            width: 40%;
        }
        .email-table tr:last-child td {
            border-bottom: none;
        }
        .email-table tr.total-row {
            background-color: #f8f9ff;
            font-weight: 600;
        }
        .email-table tr.total-row td {
            font-size: 18px;
            padding: 15px;
            color: #667eea;
        }
        
        /* Product Table */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            background-color: #ffffff;
        }
        .product-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
        }
        .product-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .product-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }
        .product-table tbody tr:hover {
            background-color: #f8f9ff;
        }
        .product-table tbody tr:last-child td {
            border-bottom: none;
        }
        .product-name {
            font-weight: 600;
            color: #333333;
        }
        .product-sku {
            font-size: 12px;
            color: #999999;
            margin-top: 4px;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-success {
            background-color: #d4edda;
            color: #155724;
        }
        .status-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .status-primary {
            background-color: #cce5ff;
            color: #004085;
        }
        
        /* Email Footer */
        .email-footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            font-size: 13px;
            color: #666666;
            border-top: 1px solid #e9ecef;
        }
        .email-footer p {
            margin-bottom: 10px;
            color: #666666;
        }
        .email-footer a {
            color: #667eea;
            text-decoration: none;
            margin: 0 8px;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
        .email-footer .footer-links {
            margin: 15px 0;
        }
        .email-footer .footer-note {
            margin-top: 15px;
            font-size: 11px;
            color: #999999;
            font-style: italic;
        }
        
        /* Social Links */
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            border-radius: 50%;
            margin: 0 5px;
            text-decoration: none;
            font-size: 16px;
        }
        .social-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }
        
        /* Responsive Styles */
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 20px 10px !important;
            }
            .email-container {
                width: 100% !important;
                border-radius: 0 !important;
            }
            .email-header {
                padding: 30px 20px !important;
            }
            .email-header h1 {
                font-size: 24px !important;
            }
            .email-body {
                padding: 30px 20px !important;
            }
            .email-content h2 {
                font-size: 20px !important;
            }
            .email-content h3 {
                font-size: 16px !important;
            }
            .email-button {
                display: block;
                width: 100%;
                padding: 14px 20px;
            }
            .email-table,
            .product-table {
                font-size: 14px;
            }
            .email-table td,
            .product-table td {
                padding: 10px 8px;
            }
            .product-table th {
                padding: 12px 8px;
                font-size: 12px;
            }
        }
        
        /* Dark Mode Support (for email clients that support it) */
        @media (prefers-color-scheme: dark) {
            .email-container {
                background-color: #1a1a1a;
            }
            .email-content {
                color: #e0e0e0;
            }
            .email-content h2,
            .email-content h3 {
                color: #9d8aff;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="email-header">
                <div class="email-header-content">
                    <h1>{{ $siteName ?? 'eCommerce Store' }}</h1>
                    @if(isset($headerSubtitle))
                    <p>{{ $headerSubtitle }}</p>
                    @endif
                </div>
            </div>
            
            <!-- Body -->
            <div class="email-body">
                <div class="email-content">
                    @yield('content')
                </div>
            </div>
            
            <!-- Footer -->
            <div class="email-footer">
                <p>
                    <strong>© {{ date('Y') }} {{ $siteName ?? 'eCommerce Store' }}.</strong> All rights reserved.
                </p>
                <div class="footer-links">
                    @if(isset($siteUrl))
                    <a href="{{ $siteUrl }}">Visit Website</a> |
                    @endif
                    <a href="{{ url('/page/contact-us') }}">Contact Support</a>
                    @if(isset($siteSettings) && $siteSettings->privacy_policy_url)
                    | <a href="{{ $siteSettings->privacy_policy_url }}">Privacy Policy</a>
                    @endif
                    @if(isset($siteSettings) && $siteSettings->terms_url)
                    | <a href="{{ $siteSettings->terms_url }}">Terms of Service</a>
                    @endif
                </div>
                @if(isset($siteSettings) && ($siteSettings->facebook_url || $siteSettings->twitter_url || $siteSettings->instagram_url))
                <div class="social-links">
                    @if($siteSettings->facebook_url)
                    <a href="{{ $siteSettings->facebook_url }}" style="text-decoration: none;">f</a>
                    @endif
                    @if($siteSettings->twitter_url)
                    <a href="{{ $siteSettings->twitter_url }}" style="text-decoration: none;">t</a>
                    @endif
                    @if($siteSettings->instagram_url)
                    <a href="{{ $siteSettings->instagram_url }}" style="text-decoration: none;">i</a>
                    @endif
                </div>
                @endif
                <p class="footer-note">
                    This is an automated email. Please do not reply to this message.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
