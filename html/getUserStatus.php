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

$sql = "SELECT num,status from userLike WHERE sendNum=$num and receiveNum=$userNum";
$res = mysqli_query($conn,$sql);
$sqlnum=mysqli_num_rows($res);

if($sqlnum==0){
  $sql2 = "SELECT num,status from userLike WHERE sendNum=$userNum and receiveNum=$num";
  $res2 = mysqli_query($conn,$sql2);
  $sqlnum2=mysqli_num_rows($res2);
  if($sqlnum2==0){
    echo "no";
  }else{
    $row2 = mysqli_fetch_array($res2);
    $userStatus = array(
        'num'=>$row2[0],
        'status'=>$row2[1],
        'type'=>'receive'
      );
    echo json_encode($userStatus,JSON_UNESCAPED_UNICODE);
  }
}else{
  $row = mysqli_fetch_array($res);
  $userStatus = array(
      'num'=>$row[0],
      'status'=>$row[1],
      'type'=>'send'
    );
  echo json_encode($userStatus,JSON_UNESCAPED_UNICODE);
}

?>
