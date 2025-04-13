<?php
include '../db/config.php';

// Fetch sales history
$result = $conn->query("SELECT sales.id, products.name AS product_name, sales.quantity, sales.total_amount, sales.sale_time, users.name AS sold_by
                        FROM sales
                        JOIN products ON sales.product_id = products.id
                        JOIN users ON sales.sold_by = users.id");

echo "<h2>Sales History</h2>";
echo "<table border='1'>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>Sold By</th>
            <th>Sale Time</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['product_name']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['total_amount']}</td>
            <td>{$row['sold_by']}</td>
            <td>{$row['sale_time']}</td>
        </tr>";
}

echo "</table>";
?>
