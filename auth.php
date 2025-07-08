<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function requireLogin(): void
{
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php?err=login_required');
        exit;
    }
}

function requireAdmin(): void
{
    // requireLogin();
    if (($_SESSION['adminId'] ?? '') !== 1) {
        header('Location: no_access.php');
        exit;
    }
}
function requireStatus(): void
{
    if (isset($_SESSION['status'])) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
            switch ($_SESSION['status']) {
                case 'loggedin':
                    if (isset($_SESSION['loggedin'])) {
                        echo '<script>alert("Logged In Successfully")</script>';
                    }
                    break;
                case 'accNotExist':
                    if (isset($_SESSION['accNotExist'])) {
                        echo '<script>alert("Account Not Exist, Create New Account")</script>';

                    }
                    break;
                case 'accExist':
                    if (isset($_SESSION['accExist'])) {
                        echo '<script>alert("Account Already Exist, Login First")</script>';
                    }
                    break;
                case 'paswdExist':
                    if (isset($_SESSION['accExist'])) {
                        echo '<script>alert("Password Incorrect")</script>';

                    }
                    break;

            }
        }

    }

    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['status']) && $_SESSION['status'] === 'login') {
        // The user is logged in
    } else {

    }


}
