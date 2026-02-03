<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier_id = $_POST['supplier_id'];

    // Insert product into the database
    $query = "INSERT INTO products (name, category, price, stock, supplier_id) 
              VALUES ('$name', '$category', '$price', '$stock', '$supplier_id')";
    
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Product added successfully!'); window.location.href='products.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>