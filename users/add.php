<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();
    echo "User added successfully!";
}
?>

<form method="POST" class="user-form">
    <h2>Add New User</h2>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>

    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="admin">Admin</option>
        <option value="cashier">Cashier</option>
        <option value="stock_manager">Stock Manager</option>
        <option value="report_viewer">Report Viewer</option>
    </select><br>

    <button type="submit" class="submit-btn">Add User</button>
</form>

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

/* Form Styling */
.user-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 400px;
    margin: 20px auto;
}

.user-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1976d2;
}

.user-form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #1976d2;
}

.user-form .input-field {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    color: #333;
}

.user-form .input-field:focus {
    border-color: #1976d2;
    outline: none;
}

.user-form .submit-btn {
    width: 100%;
    padding: 12px;
    background-color: #1976d2;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.user-form .submit-btn:hover {
    background-color: #1565c0;
}

/* Message Styling */
.message {
    text-align: center;
    font-size: 16px;
    color: #1976d2;
    font-weight: bold;
    margin: 10px 0;
}
</style>
