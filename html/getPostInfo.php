<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$sql = "SELECT writerNum,image,postText,postTime from postData WHERE num='$num'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);

$sql2 = "SELECT nickname,image from userData WHERE num='$row[0]'";
$res2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($res2);

$sql3 = "SELECT * from postLike WHERE postNum='$num'";
$res3 = mysqli_query($conn,$sql3);
$likeNum=mysqli_num_rows($res3);

$R = json_decode($row2[1], true);

$userData = array(
    'writerNum'=>$row[0],
    'profileImage'=>$R[0],
    'nickname'=>$row2[0],
    'image'=>$row[1],
    'postText'=>$row[2],
    'postTime'=>$row[3],
    'postLike'=>$likeNum
  );
echo json_encode($userData,JSON_UNESCAPED_UNICODE);
?>
