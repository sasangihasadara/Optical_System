<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sales Module</title>
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
            width: 80%;
            padding: 20px;
            margin-bottom: 60px; /* Leave space for footer */
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
        .add-btn {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .add-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Optical Shop Management System</h1>
            <a href="../admin/dashboard.php"style="color: white; margin: 0 10px; text-decoration: none;">Dashboard</a>
            <a href="../products/products.php" style="color: white; margin: 0 10px; text-decoration: none;">Products</a>
            <a href="../sales/sales.php" style="color: white; margin: 0 10px; text-decoration: none;">Sales</a>
            <a href="../reports/reports.php" style="color: white; margin: 0 10px; text-decoration: none;">Reports</a>
        </nav>
    </header>

    <!-- Content -->
    <div class="content">
        <h1>Sales Module</h1>

        <!-- Add Sales Form -->
        <div>
            <h2>Add Sale</h2>
            <form method="POST" action="add_sale.php">
                <div class="form-group">
                    <label for="product_id">Product:</label>
                    <select name="product_id" id="product_id" required>
                        <option value="">glass</option>
                        <option value="">opti</option>
                        <option value="">sanga</option> 
                        <option value="">watch</option>
                        <?php
                        // Fetch products from the database
                        $query = "SELECT id, name FROM products";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customer_name">Customer Name:</label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" required>
                </div>
                <div class="form-group">
                    <label for="total_price">Total Price:</label>
                    <input type="number" id="total_price" name="total_price" step="0.01" required>
                </div>
                <button type="submit" class="add-btn">Add Sale</button>
            </form>
        </div>

        <!-- Sales Table -->
        <div>
            <h2>Sales List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch sales from the database
                    $query = "SELECT s.id, p.name AS product_name, s.customer_name, s.date, s.quantity, s.total_price
                              FROM sales s
                              JOIN products p ON s.product_id = p.id";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['product_name']}</td>
                                    <td>{$row['customer_name']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['total_price']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No sales found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
                </br>  </br>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Optical Shop Management System. All Rights Reserved.</p>
    </footer>

</body>
</html>