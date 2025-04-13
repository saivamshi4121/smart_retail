<?php
session_start();

// Check if user is logged in and session variables are set
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: auth/login.php");
    exit;
}

// Display the welcome message before redirecting
echo "<h1>Welcome to SMART RETAIL</h1>";
echo "<p>Redirecting you to your dashboard based on your role...</p>";

// Add a delay of 3 seconds before the redirection happens
header("Refresh: 3; url=");  // Set the refresh time to 3 seconds

// Role-based redirection after the message is displayed
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
?>
