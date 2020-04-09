<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT * from userData WHERE num='$num'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);
//echo "$email";

$userData = array(
    'num'=>$row[0],
    'email'=>$row[1],
    'nickname'=>$row[3],
    'image'=>$row[5],
    'height'=>$row[6],
    'form'=>$row[7],
    'hobby'=>$row[8],
    'ideaType'=>$row[9],
    'smoking'=>$row[10],
    'drinking'=>$row[11],
    'birth'=>$row[12],
    'area'=>$row[13],
    'personality'=>$row[14],
    'gender'=>$row[15]
  );
echo json_encode($userData,JSON_UNESCAPED_UNICODE);
?>
