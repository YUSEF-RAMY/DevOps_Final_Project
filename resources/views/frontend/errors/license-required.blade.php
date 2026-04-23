<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Required</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .error-container {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
            padding: 2rem;
            max-width: 700px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        .error-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            color: #ffd700;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        .error-message {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            opacity: 0.95;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-error {
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .btn-error-primary {
            background: white;
            color: #667eea;
        }
        .btn-error-primary:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: #667eea;
        }
        .btn-error-outline {
            background: transparent;
            color: white;
            border-color: white;
        }
        .btn-error-outline:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
        }
        .info-box {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: left;
        }
        .info-box h6 {
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .info-box ul {
            list-style: none;
            padding-left: 0;
        }
        .info-box li {
            padding: 0.5rem 0;
            display: flex;
            align-items: start;
            gap: 0.75rem;
        }
        .info-box li i {
            color: #ffd700;
            margin-top: 0.25rem;
        }
        @media (max-width: 768px) {
            .error-container {
                padding: 1.5rem;
            }
            .error-title {
                font-size: 2rem;
            }
            .error-message {
                font-size: 1rem;
            }
            .error-actions {
                flex-direction: column;
            }
            .btn-error {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="bi bi-key"></i>
        </div>
        <h1 class="error-title">License Key Required</h1>
        <p class="error-message">
            This application requires a valid license key to operate. 
            Please contact the administrator to activate a license key.
        </p>
        
        <div class="info-box">
            <h6><i class="bi bi-info-circle"></i> What you need to do:</h6>
            <ul>
                <li>
                    <i class="bi bi-check-circle"></i>
                    <span>Contact the application administrator or support team</span>
                </li>
                <li>
                    <i class="bi bi-check-circle"></i>
                    <span>Obtain a valid license key for this domain</span>
                </li>
                <li>
                    <i class="bi bi-check-circle"></i>
                    <span>Activate the license key in the admin panel</span>
                </li>
            </ul>
        </div>

        <div class="error-actions mt-4">
            <a href="{{ route('admin.license.activate') }}" class="btn-error btn-error-primary">
                <i class="bi bi-key-fill"></i>
                Activate License
            </a>
            <button onclick="location.reload()" class="btn-error btn-error-outline">
                <i class="bi bi-arrow-clockwise"></i>
                Refresh Page
            </button>
        </div>
    </div>
</body>
</html>

