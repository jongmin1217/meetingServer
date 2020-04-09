<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$email = $_POST['email'];
$password = $_POST['password'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT password,userStatus from userData WHERE email='$email'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);
if($row[0]!=NULL){
  if($row[0]==$password){
    if($row[1]==0){
      echo "no certification";
    }else if($row[1]==1){
      echo "please profile info";
    }else if($row[1]==2){
      echo "please image";
    }else{
      echo "succes";
    }
  }else{
    echo "no password";
  }
}else{
  echo "no email";
}

?>
