<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pirate CRUD System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 50%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Pirate background texture */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(255,255,255,.01) 10px,
                    rgba(255,255,255,.01) 20px
                );
            pointer-events: none;
        }

        /* Floating skull decoration */
        .skull-decoration {
            position: absolute;
            opacity: 0.05;
            font-size: 200px;
            color: #fff;
            animation: float 6s ease-in-out infinite;
        }

        .skull-1 { top: 10%; left: 10%; animation-delay: 0s; }
        .skull-2 { bottom: 10%; right: 10%; animation-delay: 2s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 
                0 20px 60px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255,255,255,0.1),
                inset 0 0 0 1px rgba(0,0,0,0.05);
            backdrop-filter: blur(10px);
            border: 2px solid #e0e0e0;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .pirate-logo {
            font-size: 64px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            animation: swing 3s ease-in-out infinite;
        }

        @keyframes swing {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            75% { transform: rotate(5deg); }
        }

        .logo-section h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .logo-section p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .welcome-text {
            background: linear-gradient(135deg, #0f3460, #16213e);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(15, 52, 96, 0.3);
        }

        .welcome-text h2 {
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .welcome-text p {
            font-size: 13px;
            margin: 0;
            opacity: 0.9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #0f3460;
            box-shadow: 0 0 0 4px rgba(15, 52, 96, 0.1);
            background: white;
            outline: none;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #0f3460, #16213e);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(15, 52, 96, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #16213e, #0f3460);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 52, 96, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #0f3460;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #16213e;
            text-decoration: underline;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .footer-text p {
            color: #666;
            font-size: 12px;
            margin: 5px 0;
        }

        .footer-icons {
            margin-top: 15px;
        }

        .footer-icons i {
            color: #0f3460;
            margin: 0 8px;
            font-size: 18px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .footer-icons i:hover {
            transform: scale(1.2);
        }

        /* Alert styles */
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Loading animation */
        .btn-login.loading {
            position: relative;
            color: transparent;
        }

        .btn-login.loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="skull-decoration skull-1">☠</div>
    <div class="skull-decoration skull-2">☠</div>

    <div class="login-container">
        <div class="login-card">
            <div class="logo-section">
                <div class="pirate-logo">🏴‍☠️</div>
                <h1>PIRATE_CRUD</h1>
            </div>

            <div class="welcome-text">
                <h2>⚓ Welcome Aboard! ⚓</h2>
                <p>Ahoy!</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); endif; ?>

            <form method="POST" action="index.php?page=login&action=proses" id="loginForm">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user me-2"></i>Captain's Name
                    </label>
                    <div class="input-icon">
                        <input type="text" class="form-control" name="username" 
                               placeholder="Enter your username" required autofocus>
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-key me-2"></i>Password
                    </label>
                    <div class="input-icon">
                        <input type="password" class="form-control" name="password" 
                               placeholder="Enter your password" required id="passwordInput">
                        <i class="fas fa-lock" id="togglePassword" style="cursor: pointer;"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <i class="fas fa-ship me-2"></i> Board the Ship
                </button>

            </form>

            <div class="footer-text">
                <p>Username: <code>admin</code> | Password: <code>admin</code></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-lock');
            this.classList.toggle('fa-lock-open');
        });

        // Loading animation on submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
    </script>
</body>
</html>