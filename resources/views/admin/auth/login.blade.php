<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Admin Login - eCommerce</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" media="print" onload="this.media='all'" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
		<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.css') }}" />
		<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			font-family: 'Source Sans 3', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
			background-size: 400% 400%;
			animation: gradientShift 15s ease infinite;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			position: relative;
			overflow-x: hidden;
		}
		
		@keyframes gradientShift {
			0% { background-position: 0% 50%; }
			50% { background-position: 100% 50%; }
			100% { background-position: 0% 50%; }
		}
		
		/* Animated background shapes */
		body::before,
		body::after {
			content: '';
			position: absolute;
			border-radius: 50%;
			opacity: 0.1;
			animation: float 20s infinite ease-in-out;
		}
		
		body::before {
			width: 500px;
			height: 500px;
			background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
			top: -250px;
			right: -250px;
			animation-delay: 0s;
		}
		
		body::after {
			width: 400px;
			height: 400px;
			background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
			bottom: -200px;
			left: -200px;
			animation-delay: 5s;
		}
		
		@keyframes float {
			0%, 100% { transform: translate(0, 0) scale(1); }
			50% { transform: translate(30px, -30px) scale(1.1); }
		}
		
		.login-container {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 640px;
			padding: 20px;
		}
		
		.login-card {
			background: rgba(255, 255, 255, 0.95);
			backdrop-filter: blur(20px);
			border-radius: 24px;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2);
			padding: 48px 40px;
			animation: slideUp 0.6s ease-out;
			border: 1px solid rgba(255, 255, 255, 0.3);
		}
		
		@keyframes slideUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		
		.login-header {
			text-align: center;
			margin-bottom: 40px;
		}
		
		.login-logo {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 80px;
			height: 80px;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			border-radius: 20px;
			margin-bottom: 24px;
			box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
			animation: pulse 2s infinite;
		}
		
		@keyframes pulse {
			0%, 100% { transform: scale(1); }
			50% { transform: scale(1.05); }
		}
		
		.login-logo i {
			font-size: 36px;
			color: white;
		}
		
		.login-title {
			font-size: 28px;
			font-weight: 700;
			color: #2c3e50;
			margin-bottom: 8px;
			letter-spacing: -0.5px;
		}
		
		.login-subtitle {
			color: #6c757d;
			font-size: 15px;
			font-weight: 400;
		}
		
		.login-form {
			margin-top: 32px;
		}
		
		.form-group {
			margin-bottom: 24px;
		}
		
		.form-label {
			font-weight: 600;
			color: #495057;
			font-size: 14px;
			margin-bottom: 8px;
			display: block;
		}
		
		.input-wrapper {
			position: relative;
		}
		
		.input-icon {
			position: absolute;
			left: 16px;
			top: 50%;
			transform: translateY(-50%);
			color: #6c757d;
			font-size: 18px;
			z-index: 2;
			transition: color 0.3s ease;
		}
		
		.form-control {
			width: 100%;
			padding: 14px 16px 14px 48px;
			border: 2px solid #e9ecef;
			border-radius: 12px;
			font-size: 15px;
			transition: all 0.3s ease;
			background: #fff;
			color: #495057;
		}
		
		.form-control:focus {
			outline: none;
			border-color: #667eea;
			box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
			background: #fff;
		}
		
		.form-control:focus + .input-icon,
		.form-control:not(:placeholder-shown) + .input-icon {
			color: #667eea;
		}
		
		.form-control::placeholder {
			color: #adb5bd;
		}
		
		.password-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 8px;
		}
		
		.forgot-link {
			font-size: 13px;
			color: #667eea;
			text-decoration: none;
			font-weight: 500;
			transition: color 0.3s ease;
		}
		
		.forgot-link:hover {
			color: #764ba2;
			text-decoration: underline;
		}
		
		.form-options {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 24px;
		}
		
		.form-check {
			display: flex;
			align-items: center;
		}
		
		.form-check-input {
			width: 18px;
			height: 18px;
			margin-right: 8px;
			cursor: pointer;
			accent-color: #667eea;
		}
		
		.form-check-label {
			font-size: 14px;
			color: #6c757d;
			cursor: pointer;
			user-select: none;
		}
		
		.btn-login {
			width: 100%;
			padding: 14px 24px;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			border: none;
			border-radius: 12px;
			color: white;
			font-size: 16px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
		}
		
		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
		}
		
		.btn-login:active {
			transform: translateY(0);
		}
		
		.btn-login i {
			font-size: 18px;
		}
		
		.alert-danger {
			margin-top: 20px;
			padding: 12px 16px;
			background: #fee;
			border: 1px solid #fcc;
			border-radius: 10px;
			color: #c33;
			font-size: 14px;
			animation: shake 0.5s ease;
		}
		
		@keyframes shake {
			0%, 100% { transform: translateX(0); }
			25% { transform: translateX(-10px); }
			75% { transform: translateX(10px); }
		}
		
		/* Responsive */
		@media (max-width: 576px) {
			.login-card {
				padding: 32px 24px;
				border-radius: 20px;
			}
			
			.login-title {
				font-size: 24px;
			}
			
			.login-logo {
				width: 64px;
				height: 64px;
			}
			
			.login-logo i {
				font-size: 28px;
			}
		}
		
		/* Loading state */
		.btn-login:disabled {
			opacity: 0.7;
			cursor: not-allowed;
		}
		
		/* CAPTCHA Styles */
		.captcha-wrapper {
			margin-top: 8px;
		}
		
		.captcha-image-wrapper {
			position: relative;
			display: inline-block;
			border: 2px solid #e9ecef;
			border-radius: 12px;
			overflow: hidden;
			background: #f8f9fa;
			padding: 8px;
		}
		
		.captcha-image {
			display: block;
			height: 50px;
			width: auto;
		}
		
		.captcha-refresh {
			position: absolute;
			top: 4px;
			right: 4px;
			background: rgba(102, 126, 234, 0.9);
			border: none;
			border-radius: 6px;
			width: 32px;
			height: 32px;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			color: white;
			transition: all 0.3s ease;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
		}
		
		.captcha-refresh:hover {
			background: rgba(102, 126, 234, 1);
			transform: rotate(180deg);
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
		}
		
		.captcha-refresh:active {
			transform: rotate(180deg) scale(0.95);
		}
		
		.captcha-refresh i {
			font-size: 16px;
		}
		
		.form-control[type="text"][name="captcha"] {
			text-align: center;
			font-size: 18px;
		}
		</style>
	</head>
	<body>
		<div class="login-container">
			<div class="login-card">
				<div class="login-header">
					<div class="login-logo">
						<i class="bi bi-shield-lock-fill"></i>
					</div>
					<h1 class="login-title">Admin Portal</h1>
					<p class="login-subtitle">Sign in to access your dashboard</p>
				</div>
				
				<form action="{{ route('admin.login.attempt') }}" method="post" class="login-form" id="loginForm">
					@csrf
					
					<div class="form-group">
						<label class="form-label">Email Address</label>
						<div class="input-wrapper">
							<input 
								type="email" 
								name="email" 
								value="{{ old('email') }}" 
								class="form-control" 
								placeholder="Enter your email" 
								required 
								autocomplete="email"
							/>
							<i class="bi bi-envelope input-icon"></i>
						</div>
					</div>
					
					<div class="form-group">
						<div class="password-header">
							<label class="form-label">Password</label>
							<a href="#" class="forgot-link">Forgot password?</a>
						</div>
						<div class="input-wrapper">
							<input 
								type="password" 
								name="password" 
								class="form-control" 
								placeholder="Enter your password" 
								required 
								autocomplete="current-password"
							/>
							<i class="bi bi-lock-fill input-icon"></i>
						</div>
					</div>
					
					<div class="form-group">
						<label class="form-label">Security Code</label>
						<div class="captcha-wrapper">
							<div class="captcha-image-wrapper">
								<img src="{{ route('admin.captcha') }}?t={{ time() }}{{ $errors->has('captcha') ? '&new=1' : '' }}" alt="CAPTCHA" id="captchaImage" class="captcha-image" />
								<button type="button" class="captcha-refresh" id="refreshCaptcha" title="Refresh CAPTCHA">
									<i class="bi bi-arrow-clockwise"></i>
								</button>
							</div>
							<div class="input-wrapper" style="margin-top: 12px;">
								<input 
									type="text" 
									name="captcha" 
									class="form-control" 
									placeholder="Enter the code above" 
									required 
									autocomplete="off"
									maxlength="5"
									style="text-transform: uppercase; letter-spacing: 2px; font-weight: 600;"
								/>
								<i class="bi bi-shield-check input-icon"></i>
							</div>
						</div>
						@error('captcha')
							<div class="text-danger mt-2" style="font-size: 13px;">
								<i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
							</div>
						@enderror
					</div>
					
					<div class="form-options">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="remember" id="rememberMe" />
							<label class="form-check-label" for="rememberMe">Remember me</label>
						</div>
					</div>
					
					<button type="submit" class="btn-login" id="loginBtn">
						<i class="bi bi-box-arrow-in-right"></i>
						<span>Sign In</span>
					</button>
					
					@if ($errors->any())
						<div class="alert alert-danger">
							<i class="bi bi-exclamation-triangle-fill me-2"></i>
							{{ $errors->first() }}
						</div>
					@endif
				</form>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
		<script src="{{ asset('admin-assets/js/adminlte.js') }}"></script>
		<script>
		document.getElementById('loginForm').addEventListener('submit', function(e) {
			const btn = document.getElementById('loginBtn');
			btn.disabled = true;
			btn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i><span>Signing in...</span>';
			
			// Re-enable after 5 seconds in case of error
			setTimeout(() => {
				btn.disabled = false;
				btn.innerHTML = '<i class="bi bi-box-arrow-in-right"></i><span>Sign In</span>';
			}, 5000);
		});
		
		// Add spin animation
		const style = document.createElement('style');
		style.textContent = `
			@keyframes spin {
				from { transform: rotate(0deg); }
				to { transform: rotate(360deg); }
			}
			.spin {
				animation: spin 1s linear infinite;
			}
		`;
		document.head.appendChild(style);
		
		// CAPTCHA refresh functionality
		document.getElementById('refreshCaptcha').addEventListener('click', function() {
			const captchaImage = document.getElementById('captchaImage');
			captchaImage.src = '{{ route("admin.captcha") }}?t=' + new Date().getTime() + '&new=1';
		});
		
		// Auto-uppercase CAPTCHA input
		const captchaInput = document.querySelector('input[name="captcha"]');
		if (captchaInput) {
			captchaInput.addEventListener('input', function(e) {
				e.target.value = e.target.value.toUpperCase().replace(/[^0-9A-Z]/g, '');
			});
		}
		</script>
	</body>
</html>


