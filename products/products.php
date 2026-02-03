<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Products Module</title>
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
            padding: 10px 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        h1 {
            color: #333;
        }
        .content {
            padding: 20px;
            margin-bottom: 60px; /* Leave space for footer */
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .add-btn, .delete-btn {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .add-btn:hover {
            background-color: #45a049;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Optical Shop Management System</h1>
        <nav>
            <a href="../admin/dashboard.php"style="color: white; margin: 0 10px; text-decoration: none;">Dashboard</a>
            <a href="../supplier/supplier.php"style="color: white; margin: 0 10px; text-decoration: none;">Suppliers</a>
            <a href="products.php" style="color: white; margin: 0 10px; text-decoration: none;">Products</a>
            <a href="../sales/sales.php" style="color: white; margin: 0 10px; text-decoration: none;">Sales</a>
            <a href="../reports/reports.php" style="color: white; margin: 0 10px; text-decoration: none;">Reports</a>
        </nav>
    </header>

    <!-- Content -->
    <div class="content">
        <h1>Products Module</h1>

        <!-- Add Product Form -->
        <div>
            <h2>Add Product</h2>
            <form method="POST" action="add_product.php">
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock Quantity:</label>
                    <input type="number" id="stock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="supplier_id">Supplier:</label>
                    <select name="supplier_id" id="supplier_id" required>
                        <option value="">sasa </option>
                        <option value="">Hasara </option>
                        <option value="">Chamod </option>
                        <option value="">Kamal </option>
                        <option value="">Amal </option>
                        <?php
                        // Fetch suppliers from the database
                        $query = "SELECT id, name FROM suppliers";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="add-btn">Add Product</button>
            </form>
        </div>

        <!-- Products Table -->
        <div>
            <h2>Products List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch products from the database
                    $query = "SELECT p.id, p.name, p.category, p.price, p.stock, s.name AS supplier_name 
                              FROM products p
                              LEFT JOIN suppliers s ON p.supplier_id = s.id";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['category']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['stock']}</td>
                                    <td>{$row['supplier_name']}</td>
                                    <td>
                                        <form method='POST' action='delete_product.php' style='display:inline;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit' class='delete-btn'>Delete</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No products found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Optical Shop Management System. All Rights Reserved.</p>
    </footer>

</body>
</html>