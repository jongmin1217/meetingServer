<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_GET['num'];
$userNum = $_GET['userNum'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");



$sql = "SELECT num from chatRoom WHERE chatUser like '%$num%' and chatUser like '%$userNum%'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);

echo "$row[0]";
?>
