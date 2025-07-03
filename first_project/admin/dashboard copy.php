now add bargraph for every department showing the total 'used_quantity' of them each, the table name 'inventory out':

<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: /TSP-System/first_project/");
    exit();
}

require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota</title>
    <?php include 'nav.php'; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <div class="dashboardContainer">
        <div class="displayCount bg-transparent">
            <h1>Count of Available Toners</h1>

            <div class="grid-container">

                <!-- ----admin----->

                <?php
                $whereClause = "WHERE department = 'admin'";
                $sql = "SELECT supplier, toner_model, SUM(quantity) AS total_quantity 
                        FROM inventory_in 
                        $whereClause 
                        GROUP BY supplier, toner_model 
                        ORDER BY supplier, toner_model";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                $minQuantity = PHP_INT_MAX;
                $tonerData = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tonerData[] = $row;
                        if ($row['total_quantity'] < $minQuantity) {
                            $minQuantity = $row['total_quantity'];
                        }
                    }
                } else {
                    $minQuantity = 0;
                }

                $stmt->close();

                $bgClass = "bg-green";
                if ($minQuantity < 3) {
                    $bgClass = "bg-red";
                } elseif ($minQuantity < 5) {
                    $bgClass = "bg-yellow";
                }
                ?>

                <a href="admin_list.php" class="item-1 <?php echo $bgClass; ?>">
                    <strong>Admin</strong>
                    <div class="toner-list">
                        <?php
                        if (!empty($tonerData)) {
                            foreach ($tonerData as $row) {
                                echo htmlspecialchars($row['supplier']) . " - " .
                                    htmlspecialchars($row['toner_model']) . ": " .
                                    htmlspecialchars($row['total_quantity']) . "<br>";
                            }
                        } else {
                            echo "No toner found.";
                        }
                        ?>
                    </div>
                </a>


                <!-- --- ----Sales (Financing)--- -->

                <?php
                $whereClause = "WHERE department = 'Sales (Financing)'";
                $sql = "SELECT supplier, toner_model, SUM(quantity) AS total_quantity 
                        FROM inventory_in 
                        $whereClause 
                        GROUP BY supplier, toner_model 
                        ORDER BY supplier, toner_model";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                $minQuantity = PHP_INT_MAX;
                $tonerData = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tonerData[] = $row;
                        if ($row['total_quantity'] < $minQuantity) {
                            $minQuantity = $row['total_quantity'];
                        }
                    }
                } else {
                    $minQuantity = 0;
                }

                $stmt->close();

                $bgClass = "bg-green";
                if ($minQuantity < 2) {
                    $bgClass = "bg-red";
                } elseif ($minQuantity < 5) {
                    $bgClass = "bg-yellow";
                }
                ?>

                <a href="sales_financing.php" class="item-2 <?php echo $bgClass; ?>">
                    <strong>Sales (Financing)</strong>
                    <div class="toner-list">
                        <?php
                        if (!empty($tonerData)) {
                            foreach ($tonerData as $row) {
                                echo htmlspecialchars($row['supplier']) . " - " .
                                    htmlspecialchars($row['toner_model']) . ": " .
                                    htmlspecialchars($row['total_quantity']) . "<br>";
                            }
                        } else {
                            echo "No toner found.";
                        }
                        ?>
                    </div>
                </a>



                <!-- --- ----Sales (Financing)--- -->

                <?php
                $whereClause = "WHERE department = 'Sales (Financing)'";
                $sql = "SELECT supplier, toner_model, SUM(quantity) AS total_quantity 
                        FROM inventory_in 
                        $whereClause 
                        GROUP BY supplier, toner_model 
                        ORDER BY supplier, toner_model";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                $minQuantity = PHP_INT_MAX;
                $tonerData = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tonerData[] = $row;
                        if ($row['total_quantity'] < $minQuantity) {
                            $minQuantity = $row['total_quantity'];
                        }
                    }
                } else {
                    $minQuantity = 0;
                }

                $stmt->close();

                $bgClass = "bg-green";
                if ($minQuantity < 2) {
                    $bgClass = "bg-red";
                } elseif ($minQuantity < 5) {
                    $bgClass = "bg-yellow";
                }
                ?>

                <a href="sales_financing.php" class="item-2 <?php echo $bgClass; ?>">
                    <strong>Sales (Financing)</strong>
                    <div class="toner-list">
                        <?php
                        if (!empty($tonerData)) {
                            foreach ($tonerData as $row) {
                                echo htmlspecialchars($row['supplier']) . " - " .
                                    htmlspecialchars($row['toner_model']) . ": " .
                                    htmlspecialchars($row['total_quantity']) . "<br>";
                            }
                        } else {
                            echo "No toner found.";
                        }
                        ?>
                    </div>
                </a>


            </div>

        </div>

        <!-- linegraph here -->

        <?php

        $yearQuery = "SELECT DISTINCT YEAR(date_added) AS year FROM inventory_out ORDER BY year DESC";
        $yearResult = $conn->query($yearQuery);

        $availableYears = [];
        while ($row = $yearResult->fetch_assoc()) {
            $availableYears[] = $row['year'];
        }

        $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');


        $result = $conn->query($sql);

        $allMonths = [];
        $monthlyData = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthKey = $selectedYear . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $allMonths[] = $monthKey;
            $monthlyData[$monthKey] = 0;
        }

        $sql = "SELECT DATE_FORMAT(date_added, '%Y-%m') AS month, SUM(used_quantity) AS total_quantity
                FROM inventory_out
                WHERE YEAR(date_added) = $selectedYear
                GROUP BY month
                ORDER BY month ASC";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $monthlyData[$row['month']] = $row['total_quantity'];
        }

        $months = [];
        foreach (array_keys($monthlyData) as $monthKey) {
            $months[] = date("M Y", strtotime($monthKey . "-01"));
        }
        $quantities = array_values($monthlyData);

        ?>

        <form method="GET" style="text-align: center; margin-bottom: 20px;">
            <label for="year">Select Year: </label>
            <select name="year" id="year" onchange="this.form.submit()">
                <?php foreach ($availableYears as $year): ?>
                    <option value="<?php echo $year; ?>" <?php if ($year == $selectedYear) echo 'selected'; ?>>
                        <?php echo $year; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <div style="padding: 20px; width: 50%;">
            <canvas id="tonerUsageChart" style="max-width: 1000px; height: 300px;"></canvas>
        </div>

        <script>
            const ctx = document.getElementById('tonerUsageChart').getContext('2d');

            const tonerChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($months); ?>,
                    datasets: [{
                        label: 'Monthly Toner Usage',
                        data: <?php echo json_encode($quantities); ?>,
                        borderColor: 'rgb(128, 0, 0)',
                        backgroundColor: 'rgba(240, 127, 127, 0.38)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Toner Usage Per Month',
                            font: {
                                size: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 50,
                            title: {
                                display: true,
                                text: 'Quantity Used'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
        </script>


        <!-- pie chart -->

        <?php

        $sql = "SELECT toner_model, SUM(quantity) AS total_quantity 
            FROM inventory_request 
            GROUP BY toner_model";

        $result = $conn->query($sql);

        $tonerLabels = [];
        $tonerQuantities = [];

        while ($row = $result->fetch_assoc()) {
            $tonerLabels[] = $row['toner_model'];
            $tonerQuantities[] = $row['total_quantity'];
        }
        ?>

        <div style="padding: 20px; width: 50%;">
            <canvas id="tonerPieChart" style="max-width: 100%; height: 300px;"></canvas>
        </div>

        <script>
            const pieCtx = document.getElementById('tonerPieChart').getContext('2d');

            const tonerPieChart = new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($tonerLabels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($tonerQuantities); ?>,
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                            '#9966FF', '#FF9F40', '#C9CBCF', '#76C7C0'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total Toner Requests by Model',
                            font: {
                                size: 18
                            }
                        },
                        legend: {
                            position: 'right'
                        }
                    }
                }
            });
        </script>

        <!-- now add a bar graph -->






    </div>

    <style>
        body {
            background-color: rgb(221, 221, 221);

        }


        .grid-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin: 20px;

        }


        .item-1,
        .item-2,
        .item-3,
        .item-4,
        .item-5,
        .item-6,
        .item-7,
        .item-8,
        .item-9,
        .item-10 {

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 20px;
            text-align: center;
            border-radius: 10px;
            height: 100%;
            width: 100%;
            font-size: 20px;
            font-family: 'Mulish', sans-serif;

            text-decoration: none;
            color: inherit;
        }



        .item-1:hover,
        .item-2:hover,
        .item-3:hover,
        .item-4:hover,
        .item-5:hover,
        .item-6:hover,
        .item-7:hover,
        .item-8:hover,
        .item-9:hover,
        .item-10:hover {
            transform: scale(1.02);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .item-1 strong,
        .item-2 strong,
        .item-3 strong,
        .item-4 strong,
        .item-5 strong,
        .item-6 strong,
        .item-7 strong,
        .item-8 strong,
        .item-9 strong,
        .item-10 strong {
            color: white;
            font-size: 30px;
            font-weight: bold;
        }

        .toner-list {
            text-align: center;
            font-size: 18px;
            line-height: 1.6;
            font-weight: 500;
            color: white;
        }

        .bg-red {
            background-color: #dc3545 !important;
            color: white;
        }

        .bg-yellow {
            background-color: #ffc107 !important;
            color: black;
        }

        .bg-green {
            background-color: #198754 !important;
            color: white;
        }


        .dashboardContainer {
            display: flex;
            flex-direction: column;
            background-color: white;
            width: 85.5%;
            height: 91%;
            position: fixed;
            right: 10px;
            margin-top: 83px;
            border: 1px black solid;
            border-radius: 15px;
            padding-bottom: 20px;

            overflow-y: auto;
            /* Enable vertical scroll */
            overflow-x: hidden;
        }


        .displayCount h1 {
            color: black;
            font-family: 'Mulish', sans-serif;
            font-size: 25px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 40px;
        }

        @media screen and (max-width: 1555px) and (min-width: 320px) {
            .dashboardContainer {
                width: 98%;
            }
        }

        @media screen and (max-width: 1950px) and (min-width: 1610px) {
            .dashboardContainer {
                min-width: 85.4%;
            }

            .fb-page {
                min-width: 100%;
            }

            .fbPlugins h1 {
                width: 93.7%;
            }
        }

        @media print {
            body {
                text-align: center;
            }

            table {
                text-align: center;
            }
        }
    </style>
</body>

</html>