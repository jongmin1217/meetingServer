<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT contentNum,sendUser,type,contentImage,config,notiTime from notification WHERE receiveNum='$num'order by num DESC";
$res = mysqli_query($conn,$sql);
$resnum=mysqli_num_rows($res);

$result = array();
for($i=0; $i<$resnum; $i++){
  $row = mysqli_fetch_array($res);
  $userSql = "SELECT nickname,image from userData where num=$row[1]";
  $userRes = mysqli_query($conn,$userSql);
  $userRow = mysqli_fetch_array($userRes);
  $R = json_decode($userRow[1], true);
  array_push($result, array('contentNum'=>$row[0],'sendUser'=>$row[1],
                          'type'=>$row[2],'contentImage'=>$row[3],'config'=>$row[4],
                          'notiTime'=>$row[5],'nickname'=>$userRow[0],'userImage'=>$R[0]));

}
echo json_encode(array("notificationData"=>$result),JSON_UNESCAPED_UNICODE);

$query = "UPDATE notification SET config=1 where receiveNum='$num'";
mysqli_query($conn,$query);


?>
