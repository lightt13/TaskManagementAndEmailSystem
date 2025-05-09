<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DevTaskHub</title>
  
  <link rel="icon" type="image/png" href="officeIcon.png"> <!-- Favicon -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"> <!-- Font -->

  <style>
/* Background with dark overlay */
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
  display: flex; 
  align-items: center; 
  justify-content: center; 
}

h1 img {
  width: 24px; 
  height: 24px; 
  margin-right: 10px; 
}

textarea, input[type="submit"] {
  margin-bottom: 10px;
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
}

input[type="submit"] {
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #45a049; 
}

form {
  margin-top: 3px;
  font-family: Arial, sans-serif;
}

label {
  display: block;
  margin-bottom: 5px;
}

.button-container {
  display: flex;
  justify-content: space-between; 
}
  </style>
</head>

<body>
  <div class="container">
    <h1><img src="officeIcon.png" alt="Icon"> Send a Message</h1> 

    <form action="employeeSendMessage.php" method="post">

      <input type="hidden" name="employee_id" value="<?php echo isset($_GET['employee_id']) ? $_GET['employee_id'] : ''; ?>">

      <textarea name="message" id="message" rows="8"></textarea> 
      <input type="submit" name="send" value="Send"> 
      <input type="submit" name="logout" value="Logout"> 
    </form>

    <form action="employeePage.php" method="get">
      <input type="hidden" name="employee_id" value="<?php echo isset($_GET['employee_id']) ? $_GET['employee_id'] : ''; ?>">
      <input type="submit" value="Back to Employee Page"> 
    </form>
  </div>
</body>
</html>

<?php
  $connection = mysqli_connect("localhost", "root", "password", "mydb");

if(isset($_POST["send"])){
  $message = $_POST["message"];
  $fid = isset($_POST['employee_id']) ? $_POST['employee_id'] : null;

  if ($message == null) {
    echo "<script>alert('Please enter a message');</script>";
  } else {
    $add = "INSERT INTO email (employee_id, message) VALUES ('$fid', '$message')";
    mysqli_query($connection, $add);
    header("Location: employeePage.php?employee_id=" . urlencode($fid)); 
    exit;
  }
}

if(isset($_POST["logout"])){
  header("Location: index.php"); 
  exit;
}
?>
