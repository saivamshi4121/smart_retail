<?php
include 'db/config.php';
include 'includes/header.php';
?>

<h2>Available Products in Store</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price (₹)</th>
        <th>In Stock</th>
    </tr>

    <?php
    $result = $conn->query("SELECT name, category, price, quantity FROM products");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
              </tr>";
    }
    ?>
</table>

<?php include 'includes/footer.php'; ?>
