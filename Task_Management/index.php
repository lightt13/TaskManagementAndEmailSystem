<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevTaskHub</title>
    <link rel="icon" type="image/png" href="officeIcon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"> <!-- Import a custom font -->
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
    max-width: 600px;
    margin: 50px auto; 
    padding: 40px; 
    background-color: rgba(249, 249, 249, 0.9); 
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); 
    position: relative; 
    z-index: 1; 
}

.icon {
    width: 30px; 
    height: 30px; 
    margin-right: 10px; 
}

h1 {
    text-align: center;
    font-weight: 500;
    display: flex;
    justify-content: center;
    align-items: center;
}

h1 img {
    width: 30px; 
    height: 30px;
    margin-right: 10px; 
}

.form-group {
    margin-bottom: 20px; 
}

label {
    display: block;
    font-weight: bold; 
}

input[type="text"], input[type="password"] {
    width: 97%; 
    padding: 10px;
    border: 1px solid #ccc; 
    border-radius: 6px; 
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    cursor: pointer;
    width: 101%; 
    padding: 10px; 
    border-radius: 6px; 
}

input[type="submit"]:hover {
    background-color: #45a049; 
}

.error-message {
    color: red;
    text-align: center;
}

    </style>
</head>
<body>
    <div class="container">
        <h1><img src="officeIcon.png" alt="Icon"> DevTaskHub</h1>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="passw">Password</label>
                <input type="password" id="passw" name="passw" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" name="login">
            </div>
        </form>
        <div class="error-message">
            <?php if (isset($error_message)) { echo $error_message; } ?>
        </div>
    </div>
</body>
</html>



  <?php
ob_start();
$username = isset($_POST['username']) ? $_POST['username'] : '';
$passw = isset($_POST['passw']) ? $_POST['passw'] : '';

  if(isset($_POST["login"])){
    $connection = mysqli_connect("localhost", "root", "password", "mydb");
    
    

    $login = "select username, passw from employees where username = '$username'";
    $id = "select employee_id from employees where username = '$username'";

    $loginAdmin = "select username, passw from systemAdmin where username = '$username'";

    $admin = mysqli_query($connection, $loginAdmin);

    

    $loginConn = mysqli_query($connection, $login);
    $getID = mysqli_query($connection, $id);

    while($adminRow = mysqli_fetch_array($admin, MYSQLI_ASSOC)){

    if($adminRow['username'] == $username && $adminRow['passw'] == $passw){
      header("Location: adminHomePage.php");
      exit;
    }
    else{
      echo "invalid username or password";
    }
    
  }

    while($row = mysqli_fetch_array($loginConn, MYSQLI_ASSOC)){
      
      if ($row['username'] == $username && $row['passw'] == $passw){
        echo"successful";

        $idRow = mysqli_fetch_array($getID, MYSQLI_ASSOC);
        $employee_id = $idRow['employee_id'];
        header("Location: employeePage.php?employee_id=" . urlencode($employee_id));
        exit;
      } 
      else{
        echo "invalid username or password";
      }
    }

  }

  ob_end_flush();

  ?>

