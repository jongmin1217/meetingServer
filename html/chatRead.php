<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$chatNum = $_POST['chatNum'];
$userNum = $_POST['userNum'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "UPDATE chatMsg SET isRead=true WHERE chatNum=$chatNum and writerNum=$userNum and isRead = FALSE";
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "failed";
}
?>
