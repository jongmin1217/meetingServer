<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$nickname = $_POST['nickname'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$sql = "SELECT num FROM userData WHERE nickname='$nickname'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);
if($row[0]==NULL){
  echo "succes";
}else{
  echo "fail";
}
?>
