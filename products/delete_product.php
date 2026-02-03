<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Delete product from the database
    $query = "DELETE FROM products WHERE id = '$id'";
    
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Product deleted successfully!'); window.location.href='products.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>