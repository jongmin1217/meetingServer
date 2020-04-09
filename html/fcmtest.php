<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT token from userData where token not in('')";
$res = mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);
$token = array();

for($i=0; $i<$num; $i++){
  $row = mysqli_fetch_array($res);
  $token[$i] = $row[0];
}


$data = array();
$data['title']="오늘의 추천이 도착했어요";
$data['type']="recommendation";
$data['imageUrl']="http://13.209.4.115/postimage/likeAnimation.png";

$url = 'https://fcm.googleapis.com/fcm/send';
$apiKey = "AAAA6gLneX4:APA91bH8J02uHkXVfa8PW4p_ixEz5NDFwwk8Wel7wniyPFjhVSSLmbEsmrm0c6fpgrNSGOeSLvlasn5hE0J9dyvTgIlXgk4_UDONkLNMzkPRWJCmWRAoGrbA9fdfqv0VRxOzjCAIPt6Y";
$fields = array('registration_ids'=>$token,'data'=>$data);
$headers = array('Authorization:key='.$apiKey,'Content-Type: application/json');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));

$result = curl_exec($ch);
if($result==FALSE){
  $this->output->set_status_header(500);
}
curl_close($ch);
echo $result;

?>
