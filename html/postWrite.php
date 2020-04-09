<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$writerNum = $_POST['writerNum'];
$image = $_POST['image'];
$postText = $_POST['postText'];
$postTime = $_POST['postTime'];
$gender = $_POST['gender'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "INSERT INTO postData (writerNum,image,postText,postTime,gender) VALUES ($writerNum,'$image','$postText','$postTime','$gender')";
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "failed";
}
?>
