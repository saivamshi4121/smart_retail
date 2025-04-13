<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$result = $conn->query("SELECT id, name, category, price, quantity FROM products");

echo "<h2>Manage Products</h2>";
echo "<table class='product-table'>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['category']}</td>
            <td>{$row['price']}</td>
            <td>{$row['quantity']}</td>
            <td>
                <a href='edit.php?id={$row['id']}' class='edit-btn'>Edit</a> | 
                <a href='delete.php?id={$row['id']}' class='delete-btn'>Delete</a>
            </td>
          </tr>";
}

echo "</tbody></table>";
?>

<style>
/* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f9;
    padding: 20px;
    color: #333;
}

/* Table Styling */
.product-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.product-table th, .product-table td {
    padding: 12px;
    text-align: left;
}

.product-table th {
    background-color: #1976d2;
    color: white;
    font-weight: bold;
}

.product-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.product-table tbody tr:hover {
    background-color: #f1f1f1;
}

.product-table td a {
    text-decoration: none;
    font-weight: bold;
    padding: 6px 10px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.product-table td a.edit-btn {
    background-color: #1976d2;
    color: #fff;
}

.product-table td a.edit-btn:hover {
    background-color: #1565c0;
}

.product-table td a.delete-btn {
    background-color: #e53935;
    color: #fff;
}

.product-table td a.delete-btn:hover {
    background-color: #c62828;
}

/* Heading Style */
h2 {
    text-align: center;
    color: #1976d2;
    margin-bottom: 20px;
}
</style>
