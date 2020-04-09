<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];
$user = $_POST['user'];
$coment = $_POST['coment'];
$comentTime = $_POST['comentTime'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "INSERT INTO postComent (writerNum,coment,comentTime,postNum) VALUES ('$user','$coment','$comentTime','$num')";
if(mysqli_query($conn,$query)){
  $sql = "SELECT num FROM postComent order by num DESC limit 1";
  $res = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($res);
  echo "$row[0]";
}else{
  echo "failed";
}
?>
