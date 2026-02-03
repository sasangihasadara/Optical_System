<?php
include 'connect.php';

$date = isset($_GET['date']) ? $_GET['date'] : '';

$query = "SELECT p.name AS Product, SUM(s.quantity) AS TotalSold, SUM(s.total_price) AS TotalRevenue
          FROM sales s
          JOIN products p ON s.product_id = p.id";

if ($date) {
    $query .= " WHERE DATE(s.date) = '$date'";
}

$query .= " GROUP BY s.product_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Product</th>
                <th>Total Sold</th>
                <th>Total Revenue</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Product']}</td>
                <td>{$row['TotalSold']}</td>
                <td>{$row['TotalRevenue']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No reports available.</p>";
}
$conn->close();
?>