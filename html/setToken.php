<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$token = $_POST['token'];
$num = $_POST['num'];

$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "UPDATE userData SET token='$token' WHERE num='$num' LIMIT 1";
if(mysqli_query($conn,$query)){
  echo "$token";
}else{
  echo "write failed";
}

?>
