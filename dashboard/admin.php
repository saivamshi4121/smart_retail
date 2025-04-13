<?php
include '../db/config.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include '../includes/header.php';
?>
<h1>Admin Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>

<ul>
    <li><a href="../users/add.php">➕ Add User</a></li>
    <li><a href="../users/manage.php">👥 Manage Users</a></li>
    <li><a href="../products/add.php">➕ Add Product</a></li>
    <li><a href="../products/manage.php">📦 Manage Products</a></li>
    <li><a href="../auth/logout.php">🚪 Logout</a></li>
</ul>

<?php include '../includes/footer.php'; ?>
