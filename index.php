<?php
require_once('auth.php');
// requireStatus();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NITTTR - Secure Access Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #0a0a0a;
            color: #ffffff;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: linear-gradient(45deg, #0a0a0a, #1a1a2e, #16213e);
            animation: bgShift 10s ease-in-out infinite;
        }

        @keyframes bgShift {
            0%, 100% { background: linear-gradient(45deg, #0a0a0a, #1a1a2e, #16213e); }
            50% { background: linear-gradient(45deg, #16213e, #0f3460, #533483); }
        }

        /* Floating Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #00ffff;
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
            box-shadow: 0 0 8px #00ffff;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-30px) rotate(180deg); opacity: 1; }
        }

        /* Header Banner */
        .header-banner {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.1), rgba(255, 0, 255, 0.1));
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 255, 255, 0.3);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 30px rgba(0, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .header-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            animation: headerShine 3s ease-in-out infinite;
        }

        @keyframes headerShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 32px rgba(0, 255, 255, 0.3);
            overflow: hidden;
            border: 1px solid rgba(0, 255, 255, 0.3);
            animation: logoGlow 2s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            from { box-shadow: 0 8px 32px rgba(0, 255, 255, 0.3); }
            to { box-shadow: 0 8px 32px rgba(0, 255, 255, 0.6); }
        }

        .logo img {
            width: 110px;
            height: 110px;
            object-fit: contain;
            filter: brightness(1.2) contrast(1.1);
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
            background: linear-gradient(45deg, #00ffff, #ffffff, #ff00ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            animation: textShimmer 3s ease-in-out infinite;
        }

        @keyframes textShimmer {
            0%, 100% { filter: hue-rotate(0deg); }
            50% { filter: hue-rotate(90deg); }
        }

        .header-text p {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
            color: #cccccc;
        }

        /* Main Container */
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            position: relative;
        }

        /* Form Styling */
        form {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 50px 40px;
            box-shadow: 0 30px 60px rgba(0, 255, 255, 0.1);
            max-width: 500px;
            width: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 255, 255, 0.2);
            animation: formFloat 6s ease-in-out infinite;
        }

        @keyframes formFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        form::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            animation: rotate 10s linear infinite;
            opacity: 0.3;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        form > * {
            position: relative;
            z-index: 1;
        }

        .img-container {
            text-align: center;
            margin-bottom: 30px;
        }

        #logo {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            border: 3px solid rgba(0, 255, 255, 0.3);
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
            animation: logoFloat 4s ease-in-out infinite;
            filter: brightness(1.1) contrast(1.1);
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-5px) rotate(2deg); }
        }

        /* Input Styling */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #00ffff;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 20px;
            border: 2px solid rgba(0, 255, 255, 0.3);
            border-radius: 15px;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            color: #ffffff;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: 'Rajdhani', sans-serif;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            outline: none;
            border-color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Password Container */
        .paswd-container {
            position: relative;
            max-width: 100%;
        }

        #togglePwd {
            position: absolute;
            right: 15px;
            top: 55%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #00ffff;
            font-size: 18px;
            transition: all 0.3s ease;
            z-index: 10;
        }

        #togglePwd:hover {
            color: #ff00ff;
            transform: translateY(-50%) scale(1.2);
        }

        /* Button Styling */
        button[type=submit] {
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            color: #000000;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            animation: buttonPulse 2s ease-in-out infinite;
        }

        @keyframes buttonPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        button[type=submit]:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.5);
        }

        button[type=submit]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        button[type=submit]:hover::before {
            left: 100%;
        }

        #cancel-btn {
            background: linear-gradient(45deg, #ff4757, #ff6b7d);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-left: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(255, 71, 87, 0.3);
        }

        #cancel-btn:hover {
            background: linear-gradient(45deg, #ff3742, #ff5722);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 71, 87, 0.5);
        }

        /* Checkbox and Links */
        .checkbox-container {
            display: flex;
            align-items: center;
            margin: 20px 0;
            gap: 10px;
        }

        #remb-chkbox {
            width: 20px;
            height: 20px;
            accent-color: #00ffff;
            cursor: pointer;
        }

        .checkbox-container label {
            margin: 0;
            font-size: 14px;
            color: #cccccc;
            cursor: pointer;
            text-transform: none;
            letter-spacing: normal;
        }

        .alink {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alink a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .alink a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            transition: width 0.3s ease;
        }

        .alink a:hover::after {
            width: 100%;
        }

        .alink a:hover {
            color: #ff00ff;
            text-shadow: 0 0 10px #ff00ff;
        }

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(0, 255, 255, 0.3);
            color: #cccccc;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #00ffff, transparent);
            animation: footerGlow 2s ease-in-out infinite;
        }

        @keyframes footerGlow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            form {
                padding: 40px 30px;
                margin: 20px;
            }

            .alink {
                flex-direction: column;
                gap: 10px;
            }

            #cancel-btn {
                margin-left: 0;
                margin-top: 10px;
            }
        }

        /* Loading Animation */
        .loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .loading::after {
            content: '';
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 255, 255, 0.3);
            border-top: 4px solid #00ffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <div class="bg-animation"></div>
    <div class="particles" id="particles"></div>

    <!-- Header Banner -->
    <header class="header-banner">
        <div class="header-content">
            <div class="logo-container">
                <div class="logo">
                    <img src="./images/nitttrlogo.png" alt="NITTTR Logo">
                </div>
                <div class="header-text">
                    <h1>National Institute of Technical Teachers Training and Research</h1>
                    <p>[MINISTRY OF EDUCATION, GOVT. OF INDIA] <br> Taramani, Chennai 600113 Tamilnadu</p>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <form action="server.php" method="POST" id="loginForm">
            <div class="loading" id="loadingSpinner"></div>
            
            <div class="img-container">
                <img id="logo" src="./images/nitttrlogo.png" alt="NITTTR Logo">
            </div>

            <input type="hidden" name="action" value="login">
            
            <label for="user-name">Username</label>
            <input type="text" name="user_name_or_paswd" class="form-control" required placeholder="Enter your username" id="user-name">

            <div class="paswd-container">
                <label for="user-paswd">Password</label>
                <input type="password" required class="form-control" id="user-paswd" name="user-paswd" placeholder="Enter your secure password">
                <i id="togglePwd" class="fa-solid fa-eye"></i>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="remb-chkbox">
                <label for="remb-chkbox">Remember me for future sessions</label>
            </div>

            <button type="submit" id="std-submit">Secure Login</button>
            <button type="reset" id="cancel-btn">Clear Form</button>

            <div class="alink">
                <a href="signup.php">Create New Account</a>
                <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> NITTTR. All rights reserved. | Unauthorized access is prohibited.</p>
    </footer>

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Password toggle functionality
        document.getElementById('togglePwd').addEventListener('click', function () {
            const pwdField = document.getElementById('user-paswd');
            const typeNow = pwdField.getAttribute('type') === 'password' ? 'text' : 'password';
            pwdField.setAttribute('type', typeNow);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Form submission with loading animation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('std-submit');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Authenticating...';
            loadingSpinner.style.display = 'block';
            
            // Simulate processing time (remove this in production)
            setTimeout(() => {
                loadingSpinner.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Secure Login';
            }, 2000);
        });

        // Enhanced input focus effects
        document.querySelectorAll('input[type="text"], input[type="password"]').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Mouse movement effect for form
        document.addEventListener('mousemove', (e) => {
            const form = document.querySelector('form');
            const rect = form.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            if (x >= 0 && x <= rect.width && y >= 0 && y <= rect.height) {
                const xPercent = (x / rect.width - 0.5) * 2;
                const yPercent = (y / rect.height - 0.5) * 2;
                
                form.style.transform = `translateY(-10px) rotateX(${yPercent * 2}deg) rotateY(${xPercent * 2}deg)`;
            } else {
                form.style.transform = 'translateY(-10px) rotateX(0deg) rotateY(0deg)';
            }
        });

        // Initialize particles when page loads
        document.addEventListener('DOMContentLoaded', createParticles);

        // Add ripple effect to buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.position = 'absolute';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.borderRadius = '50%';
                ripple.style.pointerEvents = 'none';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s ease-out';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        <?php if (isset($wrgpaswd)) {
            echo 'alert("Password Incorrect! Please check your credentials and try again.");';
        } ?>
    </script>
</body>
</html>
