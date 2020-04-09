<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$sql = "SELECT likeUserNum from postLike WHERE postNum='$num'order by num DESC";
$res = mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);


$result = array();
for($i=0; $i<$num; $i++){
  $row = mysqli_fetch_array($res);

  $sql2 = "SELECT nickname,image from userData WHERE num='$row[0]'";
  $res2 = mysqli_query($conn,$sql2);
  $row2 = mysqli_fetch_array($res2);
  $R = json_decode($row2[1], true);
  array_push($result, array('num'=>$row[0],'nickname'=>$row2[0],'image'=>$R[0]));

}
echo json_encode(array("user"=>$result),JSON_UNESCAPED_UNICODE);


?>
