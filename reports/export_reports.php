<?php
include 'db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="sales_report.csv"');

$output = fopen("php://output", "w");
fputcsv($output, array('Product', 'Total Sold', 'Total Revenue'));

$query = "SELECT p.name AS Product, SUM(s.quantity) AS TotalSold, SUM(s.total_price) AS TotalRevenue
          FROM sales s
          JOIN products p ON s.product_id = p.id
          GROUP BY s.product_id";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
?>