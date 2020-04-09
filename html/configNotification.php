<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "UPDATE notification SET config=1 where receiveNum='$num'";
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "write failed";
}
?>
