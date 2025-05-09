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

    .button-container {
      text-align: center;
      margin-top: 20px;
    }
    .button-container form {
      display: inline-block; 
    }
    .button-container input[type="submit"] {
      width: 180px; 
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 12px 20px;
      cursor: pointer;
      font-size: 16px;
      margin-right: 10px; 
      margin-bottom: 5px;
    }
    .button-container input[type="submit"]:last-child {
      margin-right: 0; 
    }
    .button-container input[type="submit"]:hover {
      background-color: #45a049;
    }
    .containerMain {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background: linear-gradient(45deg, #82B74B, #3BAF9F);
      border-radius: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #fff;
      margin-bottom: 20px;
    }

    h1 img {
      width: 24px; /* Icon width */
      height: 24px; /* Icon height */
      margin-right: 10px; /* Space between icon and title */
    }
    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      color: #444;
    }
    input[type="text"], input[type="number"], input[type="password"] {
      width: calc(100% - 22px);
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      background-color: #3BAF9F;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 12px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
      background-color: #2E856E;
    }
  </style>
</head>
<body>

<form action="adminCreateMember.php" method="post">
  <div class="containerMain">
    <h1><img src="officeIcon.png" alt="Icon">Create Member</h1>

    <div class="form-container">
      <div class="form-group">
        <label for="ID">Employee ID:</label>
        <input type="number" id="ID" placeholder="Employee ID" name="ID" required>
      </div>
      <div class="form-group">
        <label for="username">Employee Username:</label>
        <input type="text" id="username" placeholder="email@gmail.com" name="username" required>
      </div>
      <div class="form-group">
        <label for="passw">Employee Password:</label>
        <input type="password" id="passw" placeholder="Password" name="passw" required>
      </div>
      <div class="form-group">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" placeholder="First Name" name="firstName" required>
      </div>
      <div class="form-group">
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" placeholder="Last Name" name="lastName" required>
      </div>
      <div class="form-group">
        <label for="hourlyPay">Hourly Pay:</label>
        <input type="number" id="hourlyPay" placeholder="Hourly Pay" name="hourlyPay" required>
      </div>
      <div class="form-group">
        <label for="hireDate">Hire Date:</label>
        <input type="date" id="hireDate" placeholder="Hire Date" name="hireDate" required>
      </div>
      <div class="form-group">
        <input type="submit" name="add" value="Add Member">
      </div>
    </div>
  </form>

    <div class="button-container">
      <form action="adminUpdateMember.php" method="post">
        <input type="submit" value="Update Member">
      </form>
      <form action="adminDelete.php" method="post">
        <input type="submit" value="Delete">
      </form>
      <form action="adminAssignTask.php" method="post">
        <input type="submit" value="Assign a Task">
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

  </div>

</body>
</html>

<?php
  $connection = mysqli_connect("localhost", "root", "password", "mydb");
  if(isset($_POST["add"])){
  $username = $_POST["username"];
  $passw = $_POST["passw"];
  $empID = $_POST["ID"];
  $fName = $_POST["firstName"];
  $lName = $_POST["lastName"];
  $hPay = $_POST["hourlyPay"];
  $hDate = $_POST["hireDate"];
  
  $search = "select employee_id from employees where employee_id = '$empID'";

  $searching = mysqli_query($connection, $search);


  if(mysqli_num_rows($searching) > 0){
    echo "<script>alert('Employee ID already exists. Please enter a different employee ID.');</script>";
  } else {
    // Employee ID is unique, proceed with insertion
    $add_query = "INSERT INTO employees VALUES ('$empID', '$username', '$passw', '$fName', '$lName', '$hPay', '$hDate')";
    $add_action = mysqli_query($connection, $add_query);
    echo "<script>alert('Successfully created a member');</script>";
    
    // Check if insertion was successful
  }
}
      
    


?>
