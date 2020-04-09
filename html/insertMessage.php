<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$chatNum = $_POST['chatNum'];
$writerNum = $_POST['writerNum'];
$msg = $_POST['msg'];
$msgTime = $_POST['msgTime'];
$msgType = $_POST['msgType'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$query = "INSERT INTO chatMsg (chatNum,writerNum,msg,
  msgTime,msgType) VALUES ($chatNum,$writerNum,
    '$msg','$msgTime','$msgType')";
if(mysqli_query($conn,$query)){
  $chatNumSql = "SELECT num FROM chatMsg order by num DESC limit 1";
  $chatNumRes = mysqli_query($conn,$chatNumSql);
  $chatNumRow = mysqli_fetch_array($chatNumRes);

  if($msgType=='text'){
    $updateSql = "UPDATE chatRoom SET lastMsg='$msg',lastMsgTime='$msgTime',lastMsgNum=$chatNumRow[0] where num=$chatNum";
  }else if($msgType=='image'){
    $updateSql = "UPDATE chatRoom SET lastMsg='사진',lastMsgTime='$msgTime',lastMsgNum=$chatNumRow[0] where num=$chatNum";
  }else if($msgType=='video'){
    $updateSql = "UPDATE chatRoom SET lastMsg='동영상',lastMsgTime='$msgTime',lastMsgNum=$chatNumRow[0] where num=$chatNum";
  }

  if(mysqli_query($conn,$updateSql)){
    echo "succes";
  }else{
    echo "failed2";
  }
}else{
  echo "failed";
}
?>
