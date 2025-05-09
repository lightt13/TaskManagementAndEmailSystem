<?php
  ob_start();
     $connection = mysqli_connect("localhost", "root", "password", "mydb");
  if(isset($_POST["update"])){
    $empID = $_POST["ID"];
    $fName = $_POST["firstName"];
    $lName = $_POST["lastName"];
    $hPay = $_POST["hourlyPay"];
    $hDate = $_POST["hireDate"];
    

    $search = "select * from employees where employee_id = '$empID'";
       $searching = mysqli_query($connection, $search);

       if(mysqli_num_rows($searching) <= 0){
        echo "<script>alert('Employee ID not found. Please enter an employee ID from the table.');</script>";
      } else {
        // Employee ID exist, proceed with insertion
        $update = "update employees set first_name = '$fName', last_name = '$lName', hourly_pay = '$hPay', hire_date= '$hDate' where employee_id = '$empID'";
    
          $updateAction = mysqli_query($connection, $update);
        echo "<script>alert('Successfully updated member information');</script>";
        
        // Check if insertion was successful
      }
          
    
          
        
    }

    if(isset($_POST["assignTask"])){
      header("Location: adminAssignTask.php");
      exit;
    }
    
    if(isset($_POST["create"])){
      header("Location: adminCreateMember.php");
      exit;
    }
    if(isset($_POST["taskStatus"])){
      header("Location: adminTaskStatus.php");
      exit;
    }
    if(isset($_POST["logout"])){
      header("Location: index.php");
      exit;
    }
    if(isset($_POST["notifications"])){
      header("Location: adminNotification.php");
      exit;
    }
    if(isset($_POST["homePage"])){
      header("Location: adminHomePage.php");
      exit;
    }
        
      
  ob_end_flush();

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevTaskHub</title>
    <link rel="icon" type="image/png" href="officeIcon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">

    <link rel="stylesheet" href="styles.css">
    <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      position: relative;
      background-image: url('employee.png'); 
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
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
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent */
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative; /* Ensure it's above the dark overlay */
      z-index: 1; /* Keep above the overlay */
    }

        h1 {
            text-align: center;
            color: #333;
        }

       h1 img {
      width: 24px; /* Icon width */
      height: 24px; /* Icon height */
      margin-right: 10px; /* Space between icon and text */
    }

        .form-container {
            margin-top: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 12px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 10px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn-container {
            display:flex;
            margin-top: 20px;
        }

        

        .btn-container input[type="submit"]:last-child {
            margin-left: 5px;
        }

        .btn-container input[type="submit"]:hover {
            background-color: #35733e;
        }

        .employee-info {
            margin-top: 30px;
            color: #333;
        }

        .employee-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .btn-container {
    display: flex; /* Use flexbox to arrange buttons horizontally */
    justify-content: space-between; /* Add space between buttons */
    margin-top: 20px;
}

.btn-container form {
    flex: 1; /* Allow buttons to grow and take up equal space */
    margin-right: 10px; /* Add margin to the right of each button */
}

.btn-container form:last-child {
    margin-right: 0; /* Remove margin from the last button */
}

        .employee-info table th,
        .employee-info table td {
            border: 1px solid #ddd;
            padding: 8px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1><img src="officeIcon.png" alt="Icon">Admin Panel - Update Employee</h1>
        <div class="form-container">
            <form action="adminUpdateMember.php" method="post">
                <label for="ID">Employee ID:</label>
                <input type="number" id="ID" name="ID" required>

                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>

                <label for="hourlyPay">Hourly Pay:</label>
                <input type="number" id="hourlyPay" name="hourlyPay" required>

                <label for="hireDate">Hire Date:</label>
                <input type="date" id="hireDate" name="hireDate" placeholder="YYYY-MM-DD" required>

                <input type="submit" value="Update Employee" name="update">
            </form>
        </div>

        <div class="btn-container">
            <form action="adminCreateMember.php" method="post">
                <input type="submit" value="Create Member">
            </form>
            <form action="adminAssignTask.php" method="post">
                <input type="submit" value="Assign Task">
            </form>
            <form action="adminDelete.php" method="post">
                <input type="submit" value="Delete">
            </form>
            <form action="adminTaskStatus.php" method="post">
                <input type="submit" value="Update Task Status">
            </form>
            <form action="adminNotification.php" method="post">
                <input type="submit" value="Notifications">
            </form>
            <form action="adminHomePage.php" method="post">
                <input type="submit" value="Home">
            </form>
            <form action="index.php" method="post">
                <input type="submit" value="Logout">
            </form>
        </div>

        <div class="employee-info">
            <h2>Employees Information</h2>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Hourly Pay</th>
                        <th>Hire Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
// Assuming you already have established a database connection
$connection = mysqli_connect("localhost", "root", "password", "mydb");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Fetch employee data
$query = "SELECT * FROM employees";
$result = mysqli_query($connection, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and display employee information
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['employee_id'] . "</td>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['hourly_pay'] . "</td>";
        echo "<td>" . $row['hire_date'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No employees found</td></tr>";
}

// Close database connection
mysqli_close($connection);
?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
