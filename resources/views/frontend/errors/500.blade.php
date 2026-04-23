<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 50%, #4facfe 100%);
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
            color: white;
            padding: 2rem;
            max-width: 600px;
        }
        .error-code {
            font-size: clamp(6rem, 15vw, 12rem);
            font-weight: 900;
            line-height: 1;
            margin-bottom: 1rem;
            text-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: shake 0.5s ease-in-out infinite;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px) rotate(-5deg); }
            75% { transform: translateX(10px) rotate(5deg); }
        }
        .error-icon {
            font-size: clamp(4rem, 10vw, 8rem);
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: rotate 3s linear infinite;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .error-title {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .error-message {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            margin-bottom: 2rem;
            opacity: 0.95;
            line-height: 1.6;
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .btn-error-primary {
            background: white;
            color: #f5576c;
        }
        .btn-error-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            color: #4facfe;
        }
        .btn-error-outline {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid white;
        }
        .btn-error-outline:hover {
            background: white;
            color: #f5576c;
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
            background: white;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .shape-2 {
            width: 200px;
            height: 200px;
            background: white;
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
        <div class="error-code">500</div>
        <div class="error-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h1 class="error-title">Internal Server Error</h1>
        <p class="error-message">
            Something went wrong on our end. Our team has been notified and is working to fix the issue. Please try again later.
        </p>
        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn-error btn-error-primary">
                <i class="bi bi-house-fill"></i>
                Go Home
            </a>
            <button onclick="location.reload()" class="btn-error btn-error-outline">
                <i class="bi bi-arrow-clockwise"></i>
                Try Again
            </button>
        </div>
    </div>
</body>
</html>

