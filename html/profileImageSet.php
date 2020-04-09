<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$email = $_POST['email'];
$image = $_POST['image'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "UPDATE userData SET image='$image' WHERE email='$email' LIMIT 1";
if(mysqli_query($conn,$query)){
  $sql = "UPDATE userData SET userStatus=3 WHERE email='$email' LIMIT 1";
  if(mysqli_query($conn,$sql)){
    echo "succes";
  }else {
    echo "failed userstatus";
  }
}else{
  echo "failed";
}
?>
