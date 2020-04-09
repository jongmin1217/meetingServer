<?php
$servername = "localhost";
$name = "syj40886";
$password = "Whdals.1217";
$database = "meet";

$email = $_POST['email'];
$certificationCode = $_POST['certificationCode'];

// Create connection
$conn = new mysqli($servername, $name, $password, $database);
mysqli_query("set names utf8");

$sql = "SELECT signupCode from userData WHERE email='$email'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);

if($row[0]===$certificationCode){
  $query = "UPDATE userData SET userStatus=1 WHERE email='$email' LIMIT 1";
  if(mysqli_query($conn,$query)){
    echo "succes";
  }else{
    echo "failed";
  }
}else{
  echo "$row[0]";
}
?>
