<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the supplier
    $query = "DELETE FROM suppliers WHERE id = $id";
    mysqli_query($conn, $query);

    header('Location: list.php');
    exit;
}
?>