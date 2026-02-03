<?php
include 'connect.php';

// Handle Create and Update operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_supplier'])) {
        // Create: Add Supplier
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $query = "INSERT INTO suppliers (name, contact, address) VALUES ('$name', '$contact', '$address')";
        mysqli_query($conn, $query);
        header('Location: supplier.php');
   
    }
}
 elseif (isset($_POST['update_supplier'])) {
    // Update Supplier
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $query = "UPDATE suppliers SET name = '$name', contact = '$contact', address = '$address' WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: supplier.php');
    exit;
}

// Handle Delete operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $query = "DELETE FROM suppliers WHERE id = $delete_id";
    mysqli_query($conn, $query);
    header('Location: supplier.php');
    exit;
}

// Read: Fetch all suppliers
$query = "SELECT * FROM suppliers";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Supplier Maintenance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* Header */
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #007bff;
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        /* Container */
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Forms and Tables */
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions form {
            display: inline-block;
        }

        .edit-btn, .delete-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .delete-btn {
            background-color: #f44336;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Supplier Maintenance Module</h1>
    </header>

    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="../admin/dashboard.php">Dashboard</a>
        <a href="supplier.php">Supplier Maintenance</a>
        <a href="../products/products.php">Products</a>
        <a href="../sales/sales.php">Sales</a>
        <a href="../admin/logout.php">Logout</a>
    </div>

    <!-- Main Container -->
    <div class="container">
        <h2>Add Supplier</h2>
        <!-- Create Supplier Form -->
        <form method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
            <label for="contact">Contact</label>
            <input type="text" name="contact" id="contact" required>
            <label for="address">Address</label>
            <textarea name="address" id="address" required></textarea>
            <button type="submit" name="add_supplier">Add Supplier</button>
        </form>

        <!-- Read and Update Section -->
        <h2>Supplier List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td class="actions">
                            <!-- Update Button -->
                            <a href="edit_supplier.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                            <!-- Delete Form -->
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>Supplier Maintenance Module - © 2024 Your Company</p>
    </footer>
</body>
</html>