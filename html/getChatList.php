<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$mynum = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT num,chatUser,lastMsg,lastMsgTime from chatRoom WHERE chatUser like '%$mynum%' order by lastMsgNum DESC";
$res = mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);

$result = array();
for($i=0; $i<$num; $i++){
  $row = mysqli_fetch_array($res);

  $userList = json_decode($row[1]);
  $numlist = array();
  $numlist[0] = $mynum;
  $user = array_values(array_diff($userList,$numlist));

  $sql2 = "SELECT nickname,image from userData WHERE num='$user[0]'";
  $res2 = mysqli_query($conn,$sql2);
  $row2 = mysqli_fetch_array($res2);

  $R = json_decode($row2[1], true);
  array_push($result, array('num'=>$row[0],
                            'userNum'=>$user[0],
                            'nickname'=>$row2[0],
                            'profileImage'=>$R[0],
                            'lastMsg'=>$row[2],
                            'lastMsgTime'=>$row[3]));

}
echo json_encode(array("chatList"=>$result),JSON_UNESCAPED_UNICODE);


?>
