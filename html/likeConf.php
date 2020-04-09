<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$user = $_GET['user'];
$num = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT * from postLike WHERE likeUserNum='$user' and postNum='$num'";
$res = mysqli_query($conn,$sql);
$row = mysqli_num_rows($res);
//echo "$email";
if($row==0){
  echo "false";
}else{
  echo "true";
}
?>
