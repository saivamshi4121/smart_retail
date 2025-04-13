<?php
include '../db/config.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=sales_export.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Product', 'Quantity', 'Total', 'Sold By', 'Time']);

$query = "SELECT products.name, sales.quantity, sales.total_amount, users.name AS sold_by, sales.sale_time
          FROM sales
          JOIN products ON sales.product_id = products.id
          JOIN users ON sales.sold_by = users.id
          ORDER BY sales.sale_time DESC";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
exit;
