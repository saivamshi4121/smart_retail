<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$result = $conn->query("SELECT id, name, email, role FROM users");

echo "<h2>Manage Users</h2>";
echo "<table class='user-table'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['role']}</td>
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
.user-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.user-table thead {
    background-color: #1976d2;
    color: white;
}

.user-table th,
.user-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.user-table tbody tr:nth-child(even) {
    background-color: #f4f6f9;
}

.user-table tbody tr:hover {
    background-color: #e1f5fe;
}

.user-table th {
    font-weight: bold;
}

/* Action Links */
.edit-btn,
.delete-btn {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
    font-weight: bold;
}

.edit-btn {
    background-color: #4caf50;
    color: white;
}

.edit-btn:hover {
    background-color: #45a049;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

.delete-btn:hover {
    background-color: #e53935;
}

/* Heading Styling */
h2 {
    color: #1976d2;
    text-align: center;
    margin-bottom: 20px;
}
</style>
