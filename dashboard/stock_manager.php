<?php
include '../db/config.php';

// Check if the user is logged in and has the 'stock_manager' role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'stock_manager') {
    header("Location: ../auth/login.php");
    exit;
}

include '../includes/header.php';
?>

<h1>Stock Manager Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>

<h2>Manage Products</h2>
<ul>
    <li><a href="../products/add.php">Add New Product</a></li>
    <li><a href="../products/edit.php">Edit Product</a></li>
    <li><a href="../products/delete.php">Delete Product</a></li>
</ul>

<h2>Current Stock</h2>
<!-- Display the current stock of products -->
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; text-align: left;">
    <tr>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>
    <?php
    // Fetch all products in stock
    $sql = "SELECT id, name, category, price, quantity FROM products";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
                <td>
                    <a href='../products/edit.php?id={$row['id']}'>Edit</a> | 
                    <a href='../products/delete.php?id={$row['id']}'>Delete</a>
                </td>
              </tr>";
    }
    ?>
</table>

<!-- Logout Button -->
<form method="POST" style="margin-top: 20px;">
    <button type="submit" name="logout" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 6px; cursor: pointer;">Logout</button>
</form>

<?php
// Handle logout
if (isset($_POST['logout'])) {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: ../auth/login.php"); // Redirect to login page
    exit;
}

include '../includes/footer.php';
?>
