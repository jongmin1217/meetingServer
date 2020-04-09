<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT recommendation from userData WHERE num='$num'";
$res = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($res);

$userList = json_decode($row[0]);
$result = array();
for($i=0; $i<2; $i++){


  $userInfoSql = "SELECT num,image,birth,area,nickname from userData WHERE num='$userList[$i]'";
  $userInfoRes = mysqli_query($conn,$userInfoSql);
  $userInfoRow = mysqli_fetch_array($userInfoRes);
  $R = json_decode($userInfoRow[1], true);
  array_push($result, array('num'=>$userInfoRow[0],'image'=>$R[0],'birth'=>$userInfoRow[2],'area'=>$userInfoRow[3],'nickname'=>$userInfoRow[4]));
}
echo json_encode(array("userInfo"=>$result),JSON_UNESCAPED_UNICODE);


?>
