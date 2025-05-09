<?php
if(isset($_POST["updateStatus"])){

         $connection = mysqli_connect("localhost", "root", "password", "mydb");
        $taskID = $_POST["taskID"];
        $status = $_POST["status"];

        $search = "select * from task where id = '$taskID'";
        $searching = mysqli_query($connection, $search);

        if(mysqli_num_rows($searching) <= 0){

          echo "<script>alert('Task ID don\'t exist! Enter an existing Task ID');</script>";

        }else{

        $update = "update task set taskStatus = '$status' where id = '$taskID'";

        mysqli_query($connection, $update);

        echo "<script>alert('Task status updated successfully');</script>";
        
      }
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
    input[type="text"], input[type="number"], select {
      width: calc(100% - 22px);
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      background-color: #4caf50;;
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
    .button-container {
      text-align: center;
      margin-top: 20px;
    }
    .button-container input[type="submit"] {
      margin: 0 10px;
    }
    .task-container {
      margin-top: 20px;
    }
    .task {
      background-color: #f9f9f9;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .task-title {
      font-weight: bold;
    }
    .task-status {
      color: #3BAF9F;
    }
    h1 img {
      width: 24px; /* Icon width */
      height: 24px; /* Icon height */
      margin-right: 10px; /* Space between icon and text */
    }
  </style>
</head>
<body>

<form action="adminTaskStatus.php" method="post">
  <div class="containerMain">
    <h1><img src="officeIcon.png" alt="Icon">Task Status</h1>

    <div class="form-container">
      <div class="form-group">
        <label for="taskID">Task ID:</label>
        <input type="number" id="taskID" placeholder="Task ID" name="taskID">
      </div>
      <div class="form-group">
        <label for="status">Status:</label>
        <select id="status" name="status">
          <option value="done">Done</option>
          <option value="not done">Not Done</option>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" value="Update Status" name="updateStatus">
      </div>
    </div>

    <div class="task-container">
      <h2>Existing Tasks</h2>
      <?php
      $connection = mysqli_connect("localhost", "root", "password", "mydb");
      $getTasks = "SELECT * FROM task";
      $tasksResult = mysqli_query($connection, $getTasks);

      while($taskRow = mysqli_fetch_assoc($tasksResult)) {
        echo '<div class="task">';
        echo '<span class="task-title">Task ID: ' . $taskRow['id'] . '</span><br>';
        echo 'Title: ' . $taskRow['title'] . '<br>';
        echo 'Description: ' . $taskRow['about'] . '<br>';
        echo 'Status: <span class="task-status">' . $taskRow['taskStatus'] . '</span>';
        echo '</div>';
      }
      ?>
    </div>

    <div class="button-container">
      <input type="submit" value="Create Member" name="create">
      <input type="submit" value="Update Member" name="update">
      <input type="submit" value="Delete" name="delete">
      <input type="submit" value="Assign Task to Member" name="assignTask">
      <input type="submit" value="Notifications" name="notifications">
      <input type="submit" value="Home" name="homePage">
      <input type="submit" name="logout" value="Logout">
    </div>

  </div>
</form>

</body>
</html>
