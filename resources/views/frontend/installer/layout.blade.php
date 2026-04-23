<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Installer') - Laravel eCommerce</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .installer-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
        }
        
        .installer-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 2.5rem;
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .step-indicator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e5e7eb;
            z-index: 0;
        }
        
        .step {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #9ca3af;
            position: relative;
            z-index: 1;
        }
        
        .step.completed {
            background: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }
        
        .step.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .btn-install {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }
        
        .btn-install:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .requirement-item {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            border-left: 4px solid transparent;
        }
        
        .requirement-item.satisfied {
            background: #f0fdf4;
            border-left-color: var(--success-color);
        }
        
        .requirement-item.not-satisfied {
            background: #fef2f2;
            border-left-color: var(--danger-color);
        }
        
        .progress-steps {
            margin-top: 2rem;
        }
        
        .progress-step {
            padding: 1rem;
            margin-bottom: 0.75rem;
            border-radius: 0.5rem;
            background: #f9fafb;
            border-left: 4px solid #e5e7eb;
        }
        
        .progress-step.completed {
            background: #f0fdf4;
            border-left-color: var(--success-color);
        }
        
        .progress-step.running {
            background: #eff6ff;
            border-left-color: var(--primary-color);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="installer-container">
        <div class="installer-card">
            <div class="text-center mb-4">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-gear-wide-connected me-2"></i>
                    Laravel eCommerce Installer
                </h1>
                <p class="text-muted">Welcome to the installation wizard</p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
        
        <div class="text-center mt-4 text-white">
            <p class="mb-0">
                <small>
                    <i class="bi bi-shield-check me-1"></i>
                    Secure Installation Process
                </small>
            </p>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>

