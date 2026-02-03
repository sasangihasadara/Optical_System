<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Report Module</title>
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
        .filter {
            margin-bottom: 20px;
        }
        .export-btn {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .export-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Optical Shop Management System</h1>
        <nav>
            <a href="../admin/dashboard.php"style="color: white; margin: 0 10px; text-decoration: none;">Dashboard</a>                                      
            <a href="../products/products.php" style="color: white; margin: 0 10px; text-decoration: none;">Products</a>
            <a href="../sales/sales.php" style="color: white; margin: 0 10px; text-decoration: none;">Sales</a>
            <a href="reports.php" style="color: white; margin: 0 10px; text-decoration: none;">Reports</a>
        </nav>
    </header>

    <!-- Content -->
    <div class="content">
        <h1>Sales Report</h1>

        <div class="filter">
            <label for="dateFilter">Filter by Date: </label>
            <input type="date" id="dateFilter">
            <button onclick="filterReports()">Apply</button>
        </div>

        <div id="reportTable">
            <!-- Report Table will be loaded here -->
        </div>

        <button class="export-btn" onclick="exportReport()">Export to CSV</button>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Optical Shop Management System. All Rights Reserved.</p>
    </footer>

    <script>
        // Load Reports
        function loadReports(date = '') {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "get_reports.php?date=" + date, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById('reportTable').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }

        // Filter Reports
        function filterReports() {
            const date = document.getElementById('dateFilter').value;
            loadReports(date);
        }

        // Export Report to CSV
        function exportReport() {
            window.location.href = "../reports/export_reports.php";
        }

        // Load Reports on Page Load
        window.onload = function () {
            loadReports();
        };
    </script>

</body>
</html>