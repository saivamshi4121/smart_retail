<?php
include '../db/config.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'cashier') {
    header("Location: ../auth/login.php");
    exit;
}
include '../includes/header.php';
?>

<h1>Cashier Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>

<ul>
    <li><a href="../sales/create.php">Create Sale</a></li>
    <li><a href="../sales/history.php">Sales History</a></li>
</ul>

<!-- Logout Button -->
<form method="POST">
    <button type="submit" name="logout" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 6px; cursor: pointer;">Logout</button>
</form>

<?php
if (isset($_POST['logout'])) {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: ../auth/login.php"); // Redirect to login page
    exit;
}

include '../includes/footer.php';
?>
