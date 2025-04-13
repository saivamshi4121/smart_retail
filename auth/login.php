<?php
session_start();
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Prepare query to check if the email exists
    $stmt = $conn->prepare("SELECT id, name, role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user with that email exists
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $role, $hashed);
        $stmt->fetch();

        // Verify the password
        if (password_verify($pass, $hashed)) {
            // Password is correct, create session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;

            // Redirect to role-based dashboard
            header("Location: ../dashboard/{$role}.php");
            exit;
        } else {
            // Password mismatch
            $error = "Invalid credentials. Please check your password.";
        }
    } else {
        // No user with that email
        $error = "Invalid credentials. Please check your password.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<h1>Login</h1>

<?php
// Display error message if credentials are invalid
if (isset($error)) echo "<p style='color:red;'>$error</p>";
?>

<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br>
    
    <button type="submit">Login</button>
</form>

<?php include '../includes/footer.php'; ?>
