<?php
// Check if the user is logged in (if they already have a session)
session_start();

// If the user is logged in, redirect them to their role-specific dashboard
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboard/admin.php");
        exit;
    } elseif ($_SESSION['role'] === 'stock_manager') {
        header("Location: dashboard/stock_manager.php");
        exit;
    } elseif ($_SESSION['role'] === 'cashier') {
        header("Location: dashboard/cashier.php");
        exit;
    } elseif ($_SESSION['role'] === 'report_viewer') {
        header("Location: dashboard/report_viewer.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Retail</title>
    <style>
        /* Resetting default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ff4081, #673ab7);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Welcome message container */
        .welcome-message {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        /* Heading styling */
        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        /* Login button styling */
        .button {
            margin-top: 20px;
            padding: 15px 35px;
            background: linear-gradient(45deg, #ff5722, #f44336);
            color: white;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Button hover and active effects */
        .button:hover {
            background: linear-gradient(45deg, #f44336, #e53935);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .button:active {
            transform: translateY(2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Animation for the welcome message */
        .welcome-message {
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="welcome-message">
        <h1>Welcome to Smart Retail</h1>
        <p>Your one-stop solution for inventory and sales management.</p>
        <a href="auth/login.php" class="button">Login</a>
    </div>

</body>
</html>
