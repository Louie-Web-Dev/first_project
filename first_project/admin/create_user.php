<?php
session_start();
if (!isset($_SESSION["usertype"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: /TSP-system/first_project/login.php");
    exit();
}

require_once "database.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST["full_name"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $usertype = $_POST["usertype"];

    // Check if username already exists
    $check_sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($result)) {
        $error = "Username already exists.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO users (full_name, username, password, usertype) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt, "ssss", $fullName, $username, $hashedPassword, $usertype);

        if (mysqli_stmt_execute($stmt)) {
            $success = "User created successfully!";
        } else {
            $error = "Something went wrong. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 col-md-6">
        <h2>Create New User</h2>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="create_user.php" method="post">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="usertype" class="form-label">User Type</label>
                <select name="usertype" class="form-select" required>
                    <option value="" hidden>Select role</option>
                    <option value="admin">Admin</option>
                    <option value="other users">Other Users</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>

        <a href="dashboard.php" class="btn btn-link mt-3">← Back to Dashboard</a>
    </div>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
        }

        .custom-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
        }

        .cont-2 {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 450px;
        }

        .cont-2 h1 {
            font-size: 24px;
            margin: 20px 0 30px;
            color: #333;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-btn input {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 8px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .form-btn input:hover {
            background-color: #0056b3;
        }

        .icon,
        .icon2 {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>




</body>

</html>