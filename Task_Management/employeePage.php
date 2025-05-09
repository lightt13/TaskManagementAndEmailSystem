<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevTaskHub</title>
    <link rel="icon" type="image/png" href="officeIcon.png"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"> 
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh; 
            background-image: url('employee.png'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }

        body::before {
            content: ''; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%; 
            height: 100%; 
            background: rgba(0, 0, 0, 0.6); 
            z-index: -1; 
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; 
            z-index: 1; 
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            display: flex; 
            justify-content: center;
            align-items: center;
        }

        h1 img {
            width: 30px; 
            height: 30px;
            margin-right: 10px; 
        }

        .employee-info {
            margin-bottom: 20px;
        }

        .employee-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .employee-info table th,
        .employee-info table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .employee-info table th {
            background-color: #f2f2f2;
        }

        .employee-info table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .employee-info table tr:hover {
            background-color: #f2f2f2;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-container input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-container input[type="submit"]:hover {
            background-color: #45a049; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><img src="officeIcon.png" alt="Icon"> Your Information and Tasks</h1> <!-- Icon added next to title -->
        <div class="employee-info">
            <?php
            $fid = isset($_GET['employee_id']) ? $_GET['employee_id'] : null;

            $connection = mysqli_connect("localhost", "root", "password", "mydb");

            $getAll = "SELECT * FROM employees WHERE employee_id = $fid";
            $table = mysqli_query($connection, $getAll);

            while ($row = mysqli_fetch_array($table, MYSQLI_ASSOC)) {
                echo "<table>";
                echo "<tr><th>EMPLOYEE ID</th><th>FIRST NAME</th><th>LAST NAME</th><th>HOURLY PAY</th><th>HIRE DATE</th></tr>";
                echo "<tr><td>{$row['employee_id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['hourly_pay']}</td><td>{$row['hire_date']}</td></tr>";
                echo "</table>";
                echo "<hr>";

                if ($row['employee_id'] == $fid) {
                    $getTask = "SELECT * FROM task WHERE employee_id = $fid";
                    $getTaskNow = mysqli_query($connection, $getTask);

                    echo "<table>";
                    echo "<tr><th>TASK ID</th><th>TITLE</th><th>DESCRIPTION</th><th>TASK STATUS</th></tr>";

                    while ($getRow = mysqli_fetch_array($getTaskNow, MYSQLI_ASSOC)) {
                        echo "<tr><td>{$getRow['id']}</td><td>{$getRow['title']}</td><td>{$getRow['about']}</td><td>{$getRow['taskStatus']}</td></tr>";
                    }

                    echo "</table>";
                }
            }
            ?>
        </div>

        <div class="btn-container">
            <form action="employeeSendMessage.php" method="get">
                <input type="hidden" name="employee_id" value="<?php echo $fid; ?>">
                <input type="submit" name="emailAdmin" value="Email Admin">
            </form>

            <form action="index.php" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>
</body>
</html>
