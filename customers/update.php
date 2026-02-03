<?php
include 'connect.php';

// Fetch the customer details if an ID is provided
$customer = null; // Initialize the variable to avoid undefined errors
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
    } else {
        die("Customer not found!");
    }
    $stmt->close();
} else {
    die("Invalid or missing customer ID.");
}

// Handle the form submission for updating the customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $query = "UPDATE customers SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);

        if ($stmt->execute()) {
            header('Location: list.php');
            exit;
        } else {
            die("Error updating customer: " . $stmt->error);
        }
        $stmt->close();
    } else {
        die("Invalid form data.");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        footer {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .content {
            padding: 20px;
            margin-bottom: 60px;
        }
        h2 {
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input, form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Optical Shop Management System</h1>
        <nav>
            <a href="products.php" style="color: white; margin: 0 10px; text-decoration: none;">Products</a>
            <a href="sales.php" style="color: white; margin: 0 10px; text-decoration: none;">Sales</a>
            <a href="reports.php" style="color: white; margin: 0 10px; text-decoration: none;">Reports</a>
            <a href="customers.php" style="color: white; margin: 0 10px; text-decoration: none;">Customers</a>
        </nav>
    </header>

    <!-- Content -->
    <div class="content">
        <h2>Edit Customer</h2>
        <?php if ($customer): ?>
            <form method="POST">
                <!-- Hidden field to pass the customer ID -->
                <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">

                <label>Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>

                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>

                <label>Address</label>
                <textarea name="address" required><?php echo htmlspecialchars($customer['address']); ?></textarea>

                <button type="submit">Update Customer</button>
            </form>
        <?php else: ?>
            <p>Customer data is not available.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Optical Shop Management System. All Rights Reserved.</p>
    </footer>

</body>
</html>
