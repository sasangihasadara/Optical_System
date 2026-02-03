<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optical Shop Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Menu Bar Styles */
        .menu-bar {
            width: 100%;
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .menu-bar .menu-toggle {
            display: none;
        }

        .menu-bar .menu-items {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-bar a {
            color: white;
            text-decoration: none;
            padding: 0 10px;
        }

        .logout-button {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .menu-bar .menu-items {
                display: none;
                flex-direction: column;
                background-color: #343a40;
                position: absolute;
                top: 50px;
                left: 0;
                width: 100%;
            }

            .menu-bar .menu-toggle {
                display: inline-block;
                cursor: pointer;
            }
        }

        .show-menu {
            display: flex !important;
        }

        /* Main Content Styles */
        .main-content {
            margin-top: 60px;
            padding: 20px;
        }

        /* Footer Styles */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Menu Bar -->
    <div class="menu-bar">
        <div class="d-flex align-items-center justify-content-between">
            <h2>Optical Shop</h2>
            <div class="menu-toggle">☰</div>
        </div>
        <div class="menu-items">
            <div>
                <a href="#home">Home</a>
                <a href="../customers/customers.php">Customers</a>
                <a href="../products/products.php">Products</a>
                <a href="../sales/sales.php">Sales</a>
                <a href="../supplier/supplier.php">Supplier</a>
                <a href="../reports/reports.php">Reports</a>
               
            </div>
            <button class="logout-button" onclick="logout()">Logout</button>
        </div>
    </div>
   <br><br>
    <!-- Main Content -->
    <div class="main-content">
        <h1 id="home">Welcome to Optical Shop Management</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Sales</div>
                    <div class="card-body">
                        <h5 class="card-title">₹50,000</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Pending Orders</div>
                    <div class="card-body">
                        <h5 class="card-title">15 Orders</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Low Stock Items</div>
                    <div class="card-body">
                        <h5 class="card-title">5 Items</h5>
                    </div>
                </div>
            </div>
        </div>

        <h2 id="inventory" class="mt-5">Inventory</h2>
        <p>Details about the inventory go here.</p>

        <h2 id="appointments" class="mt-5">Appointments</h2>
        <p>Details about appointments go here.</p>

        <h2 id="sales" class="mt-5">Sales</h2>
        <p>Details about sales go here.</p>

        <h2 id="customers" class="mt-5">Customers</h2>
        <p>Details about customers go here.</p>

        <h2 id="reports" class="mt-5">Reports</h2>
        <p>Details about reports go here.</p>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Optical Shop Management | All rights reserved.</p>
    </footer>

    <script>
        // Logout Function
        function logout() {
            window.location.href = "login.php"; // Redirect to login.php
        }

        // Menu Toggle for small screens
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            const menuItems = document.querySelector('.menu-items');
            menuItems.classList.toggle('show-menu');
        });
    </script>
</body>
</html>