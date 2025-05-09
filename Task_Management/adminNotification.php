<?php
  $connection = mysqli_connect("localhost", "root", "password", "mydb");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = "Delete from email where id = '$id'";
    $deleteNow = mysqli_query($connection, $delete);
}

if(isset($_POST["create"])){
  header("Location: adminCreateMember.php");
  exit;
}
if(isset($_POST["update"])){
  header("Location: adminUpdateMember.php");
  exit;
}
if(isset($_POST["logout"])){
  header("Location: index.php");
  exit;
}
if(isset($_POST["delete"])){
  header("Location: adminDelete.php");
  exit;
}
if(isset($_POST["notifications"])){
  header("Location: adminNotification.php");
  exit;
}
if(isset($_POST["assignTask"])){
  header("Location: adminAssignTask.php");
  exit;
}
if(isset($_POST["homePage"])){
  header("Location: adminHomePage.php");
  exit;
}

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
    .containerMain {
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent */
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      position: relative; /* Ensure it's above the dark overlay */
      z-index: 1; /* Keep above the overlay */
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .emails-container {
      max-width: 700px;
      margin: 0 auto;
    }
    .email {
      background-color: #f9f9f9;
      border-radius: 8px;
      margin-bottom: 20px;
      padding: 15px;
    }
    .email-header {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .email-message {
      margin-left: 20px;
    }
    .button-container {
      text-align: center;
      margin-top: 20px;
    }
    .button-container input[type="submit"] {
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      margin: 0 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .button-container input[type="submit"]:hover {
      background-color: #45a049;
    }
    .btn {
      background-color: #f44336;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 5px 10px;
      margin-top: 5px; 
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }
    .btn:hover{
        background: darkred;
        color: #fff;
    }

    h1 img {
      width: 24px; 
      height: 24px;
      margin-right: 10px; 
    }
  </style>
</head>
<body>

<form action="adminNotification.php" method="post">
  <div class="containerMain">
    <h1 class="header"><img src="officeIcon.png" alt="Icon">Emails</h1>

    <div class="emails-container">
      <?php
        $connection = mysqli_connect("localhost", "root", "password", "mydb");
      $emailQuery = "SELECT email.*, employees.first_name, employees.username FROM email INNER JOIN employees ON email.employee_id = employees.employee_id";
      $getEmail = mysqli_query($connection, $emailQuery);

      while($emailRow = mysqli_fetch_array($getEmail, MYSQLI_ASSOC)) {
        echo '<div class="email">';
        echo '<div class="email-header">' . $emailRow['first_name'] . ' &lt;' . $emailRow['username'] . '&gt;</div>';
        echo '<div class="email-message">' . $emailRow['message'] . '</div>';
        echo "</br> </br>";
        echo "<a href ='adminNotification.php?id=".$emailRow['id']."' class='btn'>Delete</a> ";
        echo '</div>';
      }
      ?>
    </div>

    <div class="button-container">
      <input type="submit" value="Create Member" name="create">
      <input type="submit" value="Update Member" name="update">
      <input type="submit" value="Delete" name="delete">
      <input type="submit" value="Assign Task to Member" name="assignTask">
      <input type="submit" value="Update Task Status" name="taskStatus">
      <input type="submit" value="Home" name="homePage">
      <input type="submit" value="Logout" name="logout">
    </div>

  </div>
</form>

</body>
</html>

<?php

if(isset($_POST["assignTask"])){
  header("Location: adminAssignTask.php");
  exit;
}

if(isset($_POST["create"])){
  header("Location: adminCreateMember.php");
  exit;
}
if(isset($_POST["delete"])){
  header("Location: adminDelete.php");
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
  header("Location: index.php");
  exit;
}

if(isset($_POST["taskStatus"])){
  header("Location: adminTaskStatus.php");
  exit;
}

if(isset($_POST["homePage"])){
  header("Location: adminHomePage.php");
  exit;
}
      
    



?>
