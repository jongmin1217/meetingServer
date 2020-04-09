<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];
$userNum = $_POST['userNum'];
$type = $_POST['type'];
$likeNum = $_POST['likeNum'];
$chatTime = $_POST['time'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

echo "$num";
if($type=='insert'){
  $sql = "INSERT INTO userLike (sendNum,receiveNum,status) VALUES ($userNum,$num,1)";
}else if($type=='update'){
  $sql = "UPDATE userLike SET status=2 where num=$likeNum";
}
if(mysqli_query($conn,$sql)){
  echo "succes";
  if($type=='update'){
    $userList = array();
    $userList[0] = $num;
    $userList[1] = $userNum;
    $chatUser = json_encode($userList,JSON_UNESCAPED_UNICODE);

    $chatSql = "INSERT INTO chatRoom (chatUser,lastMsg,lastMsgTime,lastMsgNum) VALUES ('$chatUser','상대방과 대화를 시작해보세요','$chatTime',0)";
    if(mysqli_query($conn,$chatSql)){
      $chatNumSql = "SELECT num FROM chatRoom order by num DESC limit 1";
      $chatNumRes = mysqli_query($conn,$chatNumSql);
      $chatNumRow = mysqli_fetch_array($chatNumRes);

      $chatMsgSql = "INSERT INTO chatMsg (chatNum,writerNum,msg,msgTime,msgType) VALUES ($chatNumRow[0],0,'상대방과 대화를 시작해보세요','$chatTime','notice')";

      if(mysqli_query($conn,$chatMsgSql)){
        $chatMsgNumSql = "SELECT num FROM chatMsg order by num DESC limit 1";
        $chatMsgNumRes = mysqli_query($conn,$chatMsgNumSql);
        $chatMsgNumRow = mysqli_fetch_array($chatMsgNumRes);

        $chatUpdateSql = "UPDATE chatRoom SET lastMsgNum = $chatMsgNumRow[0] where num = $chatNumRow[0]";
        if(mysqli_query($conn,$chatUpdateSql)){
          echo "succes";
        }else{
          echo "failed";
        }

      }
    }
  }
}else{
  echo "mysqli_error($sql)";
}

?>
