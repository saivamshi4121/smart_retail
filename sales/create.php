<?php
include '../db/config.php';
if ($_SESSION['role'] !== 'cashier') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $conn->begin_transaction();

    $product = $conn->query("SELECT price, quantity FROM products WHERE id = $product_id FOR UPDATE")->fetch_assoc();
    $available = $product['quantity'];

    if ($available >= $quantity) {
        $total = $product['price'] * $quantity;

        // ✅ Correct column names
        $stmt1 = $conn->prepare("INSERT INTO sales (product_id, quantity, total_amount, sold_by) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("iidi", $product_id, $quantity, $total, $_SESSION['user_id']);
        $stmt1->execute();

        $stmt2 = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
        $stmt2->bind_param("ii", $quantity, $product_id);
        $stmt2->execute();

        $conn->commit();
        $msg = "Sale processed!";
    } else {
        $conn->rollback();
        $msg = "Insufficient stock!";
    }
}

include '../includes/header.php';
?>
<h1>Create Sale</h1>
<?php if (isset($msg)) echo "<p class='message'>$msg</p>"; ?>
<form method="POST" class="sale-form">
    <label for="product_id">Product:</label>
    <select name="product_id" id="product_id" class="input-field">
        <?php
        $res = $conn->query("SELECT id, name FROM products");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select><br>
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" class="input-field" required><br>
    <button type="submit" class="submit-btn">Process Sale</button>
</form>
<?php include '../includes/footer.php'; ?>

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

/* Form Styles */
.sale-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 400px;
    margin: 20px auto;
}

.sale-form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    color: #1976d2;
}

.sale-form .input-field {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    color: #333;
}

.sale-form .input-field:focus {
    border-color: #1976d2;
    outline: none;
}

.sale-form .submit-btn {
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

.sale-form .submit-btn:hover {
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
