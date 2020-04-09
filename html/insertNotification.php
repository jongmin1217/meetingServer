<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$contentNum = $_POST['contentNum'];
$sendUser = $_POST['sendUser'];
$type = $_POST['type'];
$contentImage = $_POST['contentImage'];
$config = $_POST['config'];
$notiTime = $_POST['notiTime'];
$receiveNum = $_POST['receiveNum'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

echo "$contentNum  $sendUser  $type  $contentImage  $config  $notiTime";

$query = "INSERT INTO notification (contentNum,sendUser,type,
  contentImage,config,notiTime,receiveNum) VALUES ($contentNum,$sendUser,
    '$type','$contentImage',$config,'$notiTime','$receiveNum')";
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "failed";
}
?>
