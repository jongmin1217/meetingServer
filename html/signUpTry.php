<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$email = $_POST['email'];
$password = $_POST['password'];
$phoneNumber = $_POST['phoneNumber'];
$code = $_POST['code'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "INSERT INTO userData (email,password,phoneNumber,userStatus,signupCode) VALUES ('$email','$password','$phoneNumber',0,'$code')";
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "failed";
}
?>
