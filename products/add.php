<?php
include '../db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $reorder_threshold = $_POST['reorder_threshold'];

    // Insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (name, category, price, quantity, reorder_threshold) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $name, $category, $price, $quantity, $reorder_threshold);
    $stmt->execute();

    echo "<div class='success-message'>Product added successfully!</div>";
}
?>

<!-- Form HTML -->
<div class="form-container">
    <h2>Add New Product</h2>
    <form method="POST">
        <div class="input-group">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        
        <div class="input-group">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" required>
        </div>

        <div class="input-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" id="price" required>
        </div>

        <div class="input-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required>
        </div>

        <div class="input-group">
            <label for="reorder_threshold">Reorder Threshold:</label>
            <input type="number" name="reorder_threshold" id="reorder_threshold" required>
        </div>

        <button type="submit">Add Product</button>
    </form>
</div>

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

/* Container for the form */
.form-container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #1976d2;
}

/* Input Groups */
.input-group {
    margin-bottom: 20px;
}

.input-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
    color: #333;
}

.input-group input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #f9f9f9;
    transition: border 0.3s ease;
}

.input-group input:focus {
    border-color: #1976d2;
    outline: none;
}

/* Button Styling */
button {
    width: 100%;
    padding: 14px;
    font-size: 18px;
    background-color: #1976d2;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #1565c0;
}

/* Success Message */
.success-message {
    margin-top: 20px;
    padding: 15px;
    background-color: #81c784;
    color: white;
    border-radius: 6px;
    text-align: center;
    font-weight: bold;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .form-container {
        padding: 20px;
    }

    button {
        font-size: 16px;
    }
}
</style>
