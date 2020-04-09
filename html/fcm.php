<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];
$sendNum = $_POST['sendNum'];
$receiveNum = $_POST['receiveNum'];
$type = $_POST['type'];
$nickname = $_POST['nickname'];
$imageUrl = $_POST['imageUrl'];
$message = $_POST['message'];

echo "$num  $sendNum  $receiveNum  $type  $nickname";

$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$sql = "SELECT token from userData WHERE num='$receiveNum'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($res);
$title="";
if($type=='postLike'){
  $title = $nickname."님이 회원님의 게시글을 좋아합니다";
}else if($type=='postComent'){
  $title = $nickname."님이 회원님의 게시글에 댓글을 남겼습니다";
}else if($type=='userLike'){
  $title = $nickname."님이 회원님을 좋아합니다";
}else if($type=='connect'){
  $title = $nickname."님이 회원님의 좋아요를 수락하였습니다";
}else if($type=='disconnect'){
  $title = $nickname."님이 회원님과 연결을 해제하였습니다";
}else if($type=='message'){
  $msg = json_decode($message,true);
  if($msg[0]=='text'){
    $title = $nickname." : $msg[1]";
  }else if($msg[0]=='image'){
    $title = $nickname."님이 사진을 보냈습니다";
  }else if($type=='applyFace'){
    $title = $nickname;
  }else{
    $title = $nickname."님이 동영상을 보냈습니다";
  }

}

$tokens = array();
$tokens[0] = $row[0];
$data = array();
$data['title']=$title;
$data['type']=$type;
$data['num']=$num;
$data['sendNum']=$sendNum;
$data['receiveNum']=$receiveNum;
$data['imageUrl']=$imageUrl;
$data['message'] = $message;

$url = 'https://fcm.googleapis.com/fcm/send';
$apiKey = "AAAA6gLneX4:APA91bH8J02uHkXVfa8PW4p_ixEz5NDFwwk8Wel7wniyPFjhVSSLmbEsmrm0c6fpgrNSGOeSLvlasn5hE0J9dyvTgIlXgk4_UDONkLNMzkPRWJCmWRAoGrbA9fdfqv0VRxOzjCAIPt6Y";
$fields = array('registration_ids'=>$tokens,'data'=>$data);
$headers = array('Authorization:key='.$apiKey,'Content-Type: application/json');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields,JSON_UNESCAPED_UNICODE));

$result = curl_exec($ch);
if($result==FALSE){
  $this->output->set_status_header(500);
}
curl_close($ch);
echo $result;
?>
