<?php
$connection = mysqli_connect("localhost", "root", "password", "mydb");
$get = "select * from users";
$getting = mysqli_query($connection, $get);


echo "<table border='1' cellpadding='0'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Email</th>";
echo "</tr>";



   while($row = mysqli_fetch_assoc($getting)){
    echo "<tr>";

    echo"<td> 
        <form action='testing.php' method='GET'>
        <input type='hidden' name='getting' value='". $row["id"] ."'>
        <input type= 'submit' value='". $row["id"] . "'>
        </form>
        </td>";
    echo"<td>". $row["fullname"] . "</td>";
    echo"<td>". $row["email"] . "</td>";
    echo "</tr>";
   }


echo "</table>";


if(isset($_GET['getting'])){

  $id = $_GET['getting'];
  $getEmp = "select * from employees where employee_id = $id";

  $gettingEmp = mysqli_query($connection, $getEmp);

  while($rowEmp = mysqli_fetch_assoc($gettingEmp)){

    echo $rowEmp['username'];
    echo "</br>";
    echo $rowEmp['hire_date'];
  }
    
}
  ?>