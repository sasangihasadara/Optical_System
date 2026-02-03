
<?php
include 'connect.php';

// Check if an ID is provided in the query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the supplier details
    $query = "SELECT * FROM suppliers WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $supplier = mysqli_fetch_assoc($result);
    } else {
        echo "Supplier not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}

// Handle form submission to update supplier details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_supplier'])) {
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $contact = mysqli_real_escape_string($conn, trim($_POST['contact']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));

    // Update query
    $query = "UPDATE suppliers SET name = '$name', contact = '$contact', address = '$address' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: supplier.php');
        exit;
    } else {
        echo "Error updating supplier: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* Header and Footer */
        .header, .footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .header a, .footer a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        .header a:hover, .footer a:hover {
            text-decoration: underline;
        }

        /* Container Styling */
        .container {
            width: 50%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <a href="../admin/dashboard.php">Dashboard</a>
        <a href="supplier.php">Supplier Maintenance</a>
        <a href="../products/list.php">Products</a>
        <a href="../sales/list.php">Sales</a>
        <a href="../logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2>Edit Supplier</h2>
        <form method="POST">
            <!-- Hidden field to store supplier ID -->
            <input type="hidden" name="id" value="<?php echo isset($supplier['id']) ? $supplier['id'] : ''; ?>">

            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo isset($supplier['name']) ? $supplier['name'] : ''; ?>" required>

            <label for="contact">Contact</label>
            <input type="text" name="contact" id="contact" value="<?php echo isset($supplier['contact']) ? $supplier['contact'] : ''; ?>" required>

            <label for="address">Address</label>
            <textarea name="address" id="address" required><?php echo isset($supplier['address']) ? $supplier['address'] : ''; ?></textarea>

            <button type="submit" name="update_supplier">Update Supplier</button>
        </form>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Supplier Maintenance Module - © 2024 Your Company</p>
    </div>
</body>
</html>
