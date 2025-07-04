<?php
// Prevent direct access and ensure proper session handling
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - NITTTR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header-banner {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo img {
            width: 110px;
            padding: 2px;
            margin-right: 3px;
            height: 110px;
            object-position: 0.01px 2px;
            object-fit: contain;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .header-text p {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .access-denied-card {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .access-denied-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #ff6b6b, #ee5a24, #ff6b6b);
        }

        .error-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
        }

        .error-title {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .error-message {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .error-details {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid #ff6b6b;
        }

        .error-details h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 600;
        }

        .error-details ul {
            text-align: left;
            color: #5a6c7d;
            font-size: 14px;
        }

        .error-details li {
            margin-bottom: 8px;
            padding-left: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, rgb(30, 48, 128), rgb(20, 90, 170));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #5a6c7d;
            border: 2px solid #dee2e6;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }

        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .access-denied-card {
                margin: 20px;
                padding: 40px 20px;
            }

            .error-title {
                font-size: 28px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
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

    <!-- Main Content -->
    <main class="main-content">
        <div class="access-denied-card">
            <div class="error-icon">
                🚫
            </div>
            <h1 class="error-title">Access Denied</h1>
            <p class="error-message">
                You do not have permission to access this resource. Administrative privileges may be required.
            </p>

            <div class="error-details">
                <h3>Possible reasons:</h3>
                <ul>
                    <li>Your account lacks the necessary permissions</li>
                    <li>Administrator approval is required</li>
                    <li>Your session may have expired</li>
                    <li>This resource is restricted to specific user roles</li>
                </ul>
            </div>

            <div class="action-buttons">
                <a href="javascript:history.back()" class="btn btn-secondary">
                    ← Go Back
                </a>
                <a onclick="adminlogin()" href="login_form.php" class="btn btn-primary">
                    🔑 Login Again
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> NITTTR. All rights reserved. | Unauthorized access is prohibited.</p>
    </footer>

    <script>
        function adminlogin() {
            alert("Login As Admin, Permission Requried");
        }

        // document.getElementById('adminlogin').addEventListener('click', () => {
        //     alert('Button was clicked!');
        // });


        // Optional: Auto-redirect after a certain time
        // setTimeout(function() {
        //     window.location.href = 'login.php';
        // }, 10000); // Redirect after 10 seconds

        // Log access attempt (optional)
        console.log('Access denied at: ' + new Date().toISOString());
    </script>
</body>

</html>
