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


$sql = "SELECT chatUser from chatRoom WHERE num=$num";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);


$userList = json_decode($row[0]);
$numlist = array();
$numlist[0] = $userNum;
$user = array_values(array_diff($userList,$numlist));

$sql2 = "SELECT nickname,image from userData WHERE num='$user[0]'";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($res2);

$R = json_decode($row2[1], true);

$userData = array(
    'userNum'=>$user[0],
    'profileImage'=>$R[0],
    'nickname'=>$row2[0]
  );
echo json_encode($userData,JSON_UNESCAPED_UNICODE);





?>
