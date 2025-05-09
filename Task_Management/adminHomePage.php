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
      max-width: 1200px;
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
      margin-bottom: 30px;
      display: flex; 
      align-items: center; 
      justify-content: center; 
    }

    h1 img {
      width: 24px; 
      height: 24px; 
      margin-right: 10px; 
    }

    .task-container {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .task-column {
      flex: 1;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .task-column h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .task-list {
      list-style: none;
      padding: 0;
    }

    .task-list li {
      margin-bottom: 10px;
      padding: 10px;
      background-color: #f0f0f0;
      border-radius: 8px;
    }

    .task-list li:last-child {
      margin-bottom: 0;
    }

    .task-list li span {
      font-weight: bold;
    }

    .button-container {
      text-align: center;
    }

    .button-container button {
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      margin: 0 5px;
      cursor: pointer;
    }

    .button-container button:hover {
      background-color: #45a049;
    }

    h1 img {
      width: 24px; 
      height: 24px; 
      margin-right: 10px; 
    }

  </style>
</head>
<body>

<?php
// Database connection
$connection = mysqli_connect("localhost", "root", "password", "mydb");
// Function to fetch tasks from the database
function fetchTasks($connection, $status) {
  $query = "SELECT task.title, employees.first_name, employees.last_name
            FROM task
            INNER JOIN employees ON task.employee_id = employees.employee_id
            WHERE task.taskStatus = '$status'";
  $result = mysqli_query($connection, $query);

  $tasks = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $tasks[] = $row;
  }
  return $tasks;
}

// Fetch ongoing tasks
$ongoingTasks = fetchTasks($connection, "not done");

// Fetch finished tasks
$finishedTasks = fetchTasks($connection, "Done");
?>

<div class="container">
  <h1><img src="officeIcon.png" alt="Icon">Welcome Admin!</h1>

  <div class="task-container">
    <div class="task-column">
      <h2>Ongoing Tasks</h2>
      <ul class="task-list">
        <?php foreach ($ongoingTasks as $task): ?>
          <li><span><?= $task['title'] ?></span> - Assigned to: <?= $task['first_name'] ?> <?= $task['last_name'] ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="task-column">
      <h2>Finished Tasks</h2>
      <ul class="task-list">
        <?php foreach ($finishedTasks as $task): ?>
          <li><span><?= $task['title'] ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="button-container">
    <button onclick="location.href='adminCreateMember.php'">Create Member</button>
    <button onclick="location.href='adminUpdateMember.php'">Update Member</button>
    <button onclick="location.href='adminDelete.php'">Delete</button>
    <button onclick="location.href='adminAssignTask.php'">Assign Task</button>
    <button onclick="location.href='adminTaskStatus.php'">Update Task Status</button>
    <button onclick="location.href='adminNotification.php'">Notifications</button>
    <button onclick="location.href='index.php'">Logout</button>
  </div>
</div>

</body>
</html>
