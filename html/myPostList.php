<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$writerNum = $_GET['writerNum'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT num,image from postData WHERE writerNum='$writerNum'order by num DESC";
$res = mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);

$result = array();
for($i=0; $i<$num; $i++){
  $row = mysqli_fetch_array($res);
  array_push($result, array('num'=>$row[0],'image'=>$row[1]));

}
echo json_encode(array("postData"=>$result),JSON_UNESCAPED_UNICODE);


?>