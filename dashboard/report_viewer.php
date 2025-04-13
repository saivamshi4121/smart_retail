<?php
include '../db/config.php';

// Check if user is logged in and has the 'report_viewer' role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'report_viewer') {
    header("Location: ../auth/login.php");
    exit;
}

include '../includes/header.php';

// Get the current page number from the query string (pagination)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;  // Set how many records you want to display per page
$offset = ($page - 1) * $limit;

// Prepare query to fetch the sales report with pagination
$sql = "SELECT s.sale_time, p.name AS product_name, s.quantity, s.total_amount 
        FROM sales s 
        JOIN products p ON s.product_id = p.id
        ORDER BY s.sale_time DESC
        LIMIT ?, ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Count the total number of records to create pagination
$countResult = $conn->query("SELECT COUNT(*) AS total FROM sales");
$countRow = $countResult->fetch_assoc();
$totalRecords = $countRow['total'];
$totalPages = ceil($totalRecords / $limit);

?>

<h1>Report Viewer Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>

<!-- Sales Report Table -->
<h2>Sales Report</h2>
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; text-align: left;">
    <tr>
        <th>Date</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        // Format the sale date
        $saleDate = date('Y-m-d H:i:s', strtotime($row['sale_time']));
        echo "<tr>
                <td>{$saleDate}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['total_amount']}</td>
              </tr>";
    }
    ?>
</table>

<!-- Pagination links -->
<div class="pagination" style="margin-top: 20px;">
    <?php if ($page > 1): ?>
        <a href="report_viewer.php?page=<?php echo $page - 1; ?>">Previous</a>
    <?php endif; ?>
    <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
    <?php if ($page < $totalPages): ?>
        <a href="report_viewer.php?page=<?php echo $page + 1; ?>">Next</a>
    <?php endif; ?>
</div>

<!-- Logout Button -->
<form method="POST" style="margin-top: 20px;">
    <button type="submit" name="logout" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 6px; cursor: pointer;">Logout</button>
</form>

<?php
if (isset($_POST['logout'])) {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: ../auth/login.php"); // Redirect to login page
    exit;
}

include '../includes/footer.php';
?>
