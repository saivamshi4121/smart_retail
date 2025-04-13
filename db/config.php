<?php
// Check if session is already started, if not, start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session only if it's not already active
}

// Database connection credentials
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'smart_retail';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    // Handle error gracefully, log it in production instead of echoing
    die("DB connection failed: " . $conn->connect_error);
}
?>
