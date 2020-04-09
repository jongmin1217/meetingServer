<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "DELETE FROM postComent WHERE num=$num";
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "failed";
}
?>
