<?php
require_once 'connect.php'; // Include database connection

// Database connection
$conn = new mysqli('localhost', 'root', '', 'optical_shop');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_customer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $conn->query("INSERT INTO customers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')");
    header("Location: customers.php");
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM customers WHERE id=$id");
    header("Location: customers.php");
}

// Handle Edit
if (isset($_POST['update_customer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $conn->query("UPDATE customers SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id");
    header("Location: customers.php");
}

// Fetch customers
$result = $conn->query("SELECT * FROM customers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header, footer { background: #333; color: #fff; padding: 10px 20px; text-align: center; }
        nav { background:rgb(0, 123, 255); padding: 10px; text-align: center; }
        nav a { color: white; text-decoration: none; margin: 0 15px; }
        .container { padding: 20px;
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
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

        form { margin-bottom: 20px; }
        form input, textarea, button { padding: 8px; margin: 5px; width: 100%; }
        .modal { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.5); }
        .modal.active { display: block; }
        
        /* Button Styles */
        button[type="submit"] {
            background-color:#007bff; /* Blue */
            color: white;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        button.edit {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        a.delete {
            background-color:#f44336;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        a.delete:hover {
            background-color: #0056b3;
        }
        
    </style>
</head>
<body>

<header>
    <h1>Optical Shop Management</h1>
</header>

<nav>
    <a href="../admin/dashboard.php">Dashboard</a>
    <a href="../customers/customers.php">Customers</a>
    <a href="../sales/sales.php">Sales</a>
    <a href="../products/products.php">Products</a>
    <a href="../supplier/supplier.php">Suppliers</a>
   
</nav>

<div class="container">
    <h2>Customer Management</h2>

    <!-- Add Customer Form -->
    <form method="POST">
        <input type="text" name="name" placeholder="Customer Name" required>
        <input type="email" name="email" placeholder="Customer Email" required>
        <input type="text" name="phone" placeholder="Phone Number">
        <textarea name="address" placeholder="Address"></textarea>
        <button type="submit" name="add_customer">Add Customer</button>
    </form>

    <!-- Customer Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['address'] ?></td>
                <td>
                    <button class="edit" onclick="editCustomer(<?= $row['id'] ?>, '<?= $row['name'] ?>', '<?= $row['email'] ?>', '<?= $row['phone'] ?>', '<?= $row['address'] ?>')">Edit</button>
                    <a href="customers.php?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Edit Customer Modal -->
<div id="editModal" class="modal">
    <form method="POST">
        <input type="hidden" name="id" id="editId">
        <input type="text" name="name" id="editName" required>
        <input type="email" name="email" id="editEmail" required>
        <input type="text" name="phone" id="editPhone">
        <textarea name="address" id="editAddress"></textarea>
        <button type="submit" name="update_customer">Update Customer</button>
        <button type="button" onclick="closeModal()">Cancel</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Optical Shop Management</p>
</footer>

<script>
function editCustomer(id, name, email, phone, address) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editAddress').value = address;
    document.getElementById('editModal').classList.add('active');
}

function closeModal() {
    document.getElementById('editModal').classList.remove('active');
}
</script>

</body>
</html>