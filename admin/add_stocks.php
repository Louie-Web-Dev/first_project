<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: /TSP-system/first_project/login.php");
    exit();
}
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
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

</head>

<body>
    <div class="Container">
        <div class="displayadd bg-transparent">
            <h1>ADD STOCKS</h1>
        </div>
        <div class="add-container">
            <div class="form-section">
                <form action="add.php" method="post">
                    <label for="supplier">Supplier:</label>
                    <select name="supplier" id="supplier" required>
                        <option value="" disabled selected hidden>Select Supplier</option>
                        <option value="INKRITE">INKRITE</option>
                        <option value="ERBM">ERBM</option>
                        <option value="CANON">CANON</option>
                    </select>

                    <label for="department">Department:</label>
                    <select name="department" id="department" required>
                        <option value="" disabled selected hidden>Select Department</option>
                        <option value="Admin">Admin</option>
                        <option value="Finance and Accounting">Finance and Accounting</option>
                        <option value="Parts Counter">Parts Counter</option>
                        <option value="Parts Warehouse">Parts Warehouse</option>
                        <option value="Sales (Financing)">Sales (Financing)</option>
                        <option value="Sales (MP)">Sales (MP)</option>
                        <option value="Sales Admin">Sales Admin</option>
                        <option value="Sales Training">Sales Training</option>
                        <option value="Service">Service</option>
                        <option value="Tool Room">Tool Room</option>
                        <option value="Tsure">Tsure</option>

                    </select>

                    <label for="toner_model">Toner Model:</label>
                    <select name="toner_model" id="toner_model" required>
                        <option value="" disabled selected hidden>Select Toner Model</option>
                        <option value="CF2266X">CF2266X</option>
                        <option value="CC388X">CC388X</option>
                        <option value="NPG90">NPG90</option>
                        <option value="CEXVM">CEXVM</option>
                        <option value="CEXVC">CEXVC</option>
                        <option value="CEXVBK">CEXVBK</option>
                        <option value="CEXVBC">CEXVBC</option>
                    </select>

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" min="1" required>

                    <label for="date_added">Date:</label>
                    <input type="date" name="date_added" id="date_added" required>

                    <button type="submit">Add</button>
                </form>
            </div>

            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Department</th>
                            <th>Toner Model</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "database.php";
                        $sql = "SELECT * FROM inventory_transaction ORDER BY id DESC LIMIT 10";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0):
                            while ($row = mysqli_fetch_assoc($result)):
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                                    <td><?php echo htmlspecialchars($row['department']); ?></td>
                                    <td><?php echo htmlspecialchars($row['toner_model']); ?></td>
                                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                                    <td>
                                        <a href="delete_stock.php?id=<?php echo $row['id']; ?>&supplier=<?php echo urlencode($row['supplier']); ?>&department=<?php echo urlencode($row['department']); ?>&toner_model=<?php echo urlencode($row['toner_model']); ?>&quantity=<?php echo $row['quantity']; ?>"
                                            onclick="return confirm('Are you sure you want to delete this record?');"
                                            style="color: red; text-decoration: underline;">
                                            Delete
                                        </a>
                                    </td>

                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="5">No records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <style>
        body {
            background-color: rgb(221, 221, 221);
        }

        .Container {
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
        }

        .add-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            gap: 20px;
        }

        .displayadd h1 {
            color: #990000;
            font-family: 'Mulish', sans-serif;
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }

        .form-section {
            width: 40%;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
        }

        .form-section label {
            margin-top: 10px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .form-section input,
        .form-section select {
            padding: 8px;
            border: 1px solid #999;
            border-radius: 5px;

        }

        .form-section button {
            margin-top: 15px;
            padding: 10px;
            background-color: #990000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .form-section button:hover {
            background-color: #660000;
        }

        .table-section {
            width: 60%;
            overflow-x: auto;
        }

        .table-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-section th,
        .table-section td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .table-section th {
            background-color: #990000;
            color: white;
        }
    </style>


</body>

</html>