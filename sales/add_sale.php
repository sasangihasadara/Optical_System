<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $customer_name = $_POST['customer_name'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    // Insert sale into the database
    $query = "INSERT INTO sales (product_id, customer_name, quantity, total_price) 
              VALUES ('$product_id', '$customer_name', '$quantity', '$total_price')";
    
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Sale added successfully!'); window.location.href='sales.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>