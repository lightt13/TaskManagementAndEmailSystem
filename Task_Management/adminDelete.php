<?php
  ob_start();
  $connection = mysqli_connect("localhost", "root", "password", "mydb");
  if(isset($_POST["delete"])){
    $ID = $_POST["ID"];
    $status = $_POST["status"];

    
    // Check if the task ID already exists

    if($status == "Employee"){

      $search = "select employee_id from employees where employee_id = '$ID'";

    $searching = mysqli_query($connection, $search);

    if(mysqli_num_rows($searching) <= 0){
      echo "<script>alert('Employee ID do not exist. Enter an existing Employee ID from the list');</script>";
    }
    else{
      $deleteAssociatedEmail = "delete from email where employee_id = '$ID'";
      $deleteAssociatedTask = "delete from task where employee_id = '$ID'";
      $deleteEmployee = "delete from employees where employee_id = '$ID'";
        mysqli_query($connection, $deleteAssociatedEmail);
        mysqli_query($connection, $deleteAssociatedTask);
        mysqli_query($connection, $deleteEmployee);
        echo "<script>alert('Successfully deleted an employee');</script>";

    }

    }

    else if($status == "Task"){

      $check_duplicate_query = "SELECT COUNT(*) as count FROM task WHERE id = '$ID'";
      $duplicate_result = mysqli_query($connection, $check_duplicate_query);
      $duplicate_row = mysqli_fetch_assoc($duplicate_result);
      $duplicate_count = $duplicate_row['count'];

      if($duplicate_count <= 0) {
        // Task ID already exists, show pop-up message
        echo "<script>alert('Task ID do not exist. Enter an existing Task ID');</script>";
      }
      else {
        // Task ID does not exist, proceed with insertion
        $deleteTask = "delete from task where id = '$ID'";
        mysqli_query($connection, $deleteTask);
        echo "<script>alert('Successfully deleted a task');</script>";
      }

      

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
    if(isset($_POST["update"])){
      header("Location: adminUpdateMember.php");
      exit;
    }
    if(isset($_POST["taskStatus"])){
      header("Location: adminTaskStatus.php");
      exit;
    }
    if(isset($_POST["logout"])){
      header("Location: login.php");
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
  /* Container styles */
  .containerMain {
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background-color: #e0f2e9; /* Light green background */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Form container styles */
  .container1, .container2 {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff; /* White background */
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Additional styling for smaller container */
  .container2 {
    max-width: 400px;
  }

  /* Center align headings */
  h1, h3 {
    text-align: center;
  }

  /* Input and select styles */
  input[type="text"],
  input[type="number"],
  select {
    width: calc(100% - 12px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
  }

  /* Button styles */
  input[type="submit"] {
    width: calc(100% - 12px);
    background-color: #4caf50; /* Dark green button */
    color: white;
    border: none;
    border-radius: 5px;
    padding: 12px 5px;
    cursor: pointer;
    font-size: 16px;
  }

  input[type="submit"]:hover {
    background-color: #45a049; /* Darker green on hover */
  }

  /* Label styles */
  label {
    display: block;
    margin-bottom: 5px;
  }

  /* Employee info styles */
  .employee-info {
    margin-bottom: 20px;
    overflow-x: auto; /* Enable horizontal scrolling if needed */
  }

  .employee-info table {
    width: 100%;
    border-collapse: collapse; /* Collapse table borders */
  }

  .employee-info th,
  .employee-info td {
    padding: 8px;
    border-bottom: 1px solid #ddd; /* Bottom border for table cells */
    text-align: left;
  }

  .employee-info th {
    background-color: #f2f2f2; /* Light gray background for table headers */
  }

  /* Task table styles */
  .task-table {
    width: 100%;
    border-collapse: collapse;
  }

  .task-table th,
  .task-table td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }

  .task-table th {
    background-color: #f2f2f2; /* Light gray background for table headers */
  }

  /* Button container styles */
  .btn-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center align the buttons */
    margin-top: 20px;
  }

  /* Margin between buttons */
  .btn-container form {
    margin: 5px; /* Add margin between buttons */
  }

  /* Fixed width for buttons */
  .btn-container input[type="submit"] {
    width: 140px; /* Set a fixed width for the buttons */
  }
</style>
</head>
<body>
<form action="adminDelete.php" method="post">
  <div class="containerMain">
    <div class="container1">
      <h1>DELETE AN EMPLOYEE OR TASK</h1>
      <label>List of Employees</label>
      <div class="employee-info">
        <!-- PHP code to display employee info -->
        <!-- Replace this PHP block with your actual employee info display code -->
        <!-- Sample code provided for demonstration -->
        <?php
        // Your PHP code to fetch and display employee info goes here
        // Sample code:
        $connection = mysqli_connect("localhost", "root", "password", "mydb");
        $getAll = "SELECT * FROM employees";
        $table = mysqli_query($connection, $getAll);

        echo "<table class='employee-table'>";
        echo "<tr><th>EMPLOYEE ID</th><th>FIRST NAME</th><th>LAST NAME</th><th>HOURLY PAY</th><th>HIRE DATE</th><th>TASKS</th></tr>";
        while ($row = mysqli_fetch_array($table, MYSQLI_ASSOC)) {
          echo "<tr>";
          echo "<td>{$row['employee_id']}</td>";
          echo "<td>{$row['first_name']}</td>";
          echo "<td>{$row['last_name']}</td>";
          echo "<td>{$row['hourly_pay']}</td>";
          echo "<td>{$row['hire_date']}</td>";
          echo "<td>";
          // Your PHP code to fetch and display tasks for each employee goes here
          // Sample task display code:
          echo "<table class='task-table'>";
          echo "<tr><th>TASK ID</th><th>TITLE</th><th>DESCRIPTION</th><th>STATUS</th></tr>";
          // Fetch and display tasks for this employee
          $getTasks = "SELECT * FROM task WHERE employee_id = '{$row['employee_id']}'";
          $tasksResult = mysqli_query($connection, $getTasks);
          while ($taskRow = mysqli_fetch_assoc($tasksResult)) {
            echo "<tr>";
            echo "<td>{$taskRow['id']}</td>";
            echo "<td>{$taskRow['title']}</td>";
            echo "<td>{$taskRow['about']}</td>";
            echo "<td>{$taskRow['taskStatus']}</td>";
            echo "</tr>";
          }
          echo "</table>";
          echo "</td>";
          echo "</tr>";
        }
        echo "</table>";
        ?>
      </div>
      <label>Select Employee or Task</label>
      <select id="status" name="status">
          <option value="Employee">Employee</option>
          <option value="Task">Task</option>
        </select>
      </br>
      <label>Enter ID:</label>
      <input type="number" name="ID" required>
      </br>
      <input type="submit" value="DELETE" name="delete">
      </br>
      </br>
    </div>
  </div>
</form>
    <div class="btn-container">
    <form action="adminCreateMember.php" method="post">
      <input type="submit" value="Create Member">
    </form>
    <form action="adminUpdateMember.php" method="post">
      <input type="submit" value="Update Member">
    </form>
    <form action="adminTaskStatus.php" method="post">
      <input type="submit" value="Update Task Status">
    </form>
    <form action="adminNotification.php" method="post">
      <input type="submit" value="Notifications">
    </form>
    <form action="adminAssignTask.php" method="post">
        <input type="submit" value="Assign Task">
    </form>
    <form action="adminHomePage.php" method="post">
      <input type="submit" value="Home Page">
    </form>
    <form action="index.php" method="post">
      <input type="submit" value="Logout">
    </form>
  </div>
</body>
</html>
