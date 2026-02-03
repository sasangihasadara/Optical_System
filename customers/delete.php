<?php
include 'connect.php'; // Ensure this file initializes $conn properly

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the ID is an integer to prevent SQL injection
    $query = "DELETE FROM customers WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // Redirect to the list page on successful deletion
        header('Location: list.php');
        exit;
    } else {
        // Display the actual MySQL error if the query fails
        die("Error deleting customer: " . mysqli_error($conn));
    }
} else {
    // Display error message if ID is missing
    die("Invalid request: Missing customer ID.");
}
?>
