<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Service Unavailable</title>
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
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 50%, #ffecd2 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .error-container {
            position: relative;
            z-index: 10;
            text-align: center;
            color: #2c3e50;
            padding: 2rem;
            max-width: 600px;
        }
        .error-code {
            font-size: clamp(6rem, 15vw, 12rem);
            font-weight: 900;
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: #2c3e50;
        }
        .error-icon {
            font-size: clamp(4rem, 10vw, 8rem);
            margin-bottom: 2rem;
            opacity: 0.8;
            color: #2c3e50;
            animation: spin 3s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .error-title {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: #2c3e50;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .error-message {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
            color: #34495e;
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
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .btn-error-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-error-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        .btn-error-outline {
            background: rgba(255,255,255,0.8);
            color: #2c3e50;
            border: 2px solid #2c3e50;
        }
        .btn-error-outline:hover {
            background: #2c3e50;
            color: white;
            transform: translateY(-2px);
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: floatShape 20s infinite ease-in-out;
        }
        .shape-1 {
            width: 300px;
            height: 300px;
            background: #2c3e50;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .shape-2 {
            width: 200px;
            height: 200px;
            background: #2c3e50;
            bottom: 20%;
            right: 15%;
            animation-delay: 5s;
        }
        @media (max-width: 768px) {
            .error-container {
                padding: 1rem;
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
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>
    <div class="error-container">
        <div class="error-code">503</div>
        <div class="error-icon">
            <i class="bi bi-gear-fill"></i>
        </div>
        <h1 class="error-title">Service Unavailable</h1>
        <p class="error-message">
            We're currently performing maintenance. We'll be back online shortly. Thank you for your patience!
        </p>
        <div class="error-actions">
            <button onclick="location.reload()" class="btn-error btn-error-primary">
                <i class="bi bi-arrow-clockwise"></i>
                Refresh Page
            </button>
            <a href="{{ url('/') }}" class="btn-error btn-error-outline">
                <i class="bi bi-house-fill"></i>
                Go Home
            </a>
        </div>
    </div>
</body>
</html>

