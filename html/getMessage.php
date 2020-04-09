<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_GET['num'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$sql = "SELECT writerNum,msg,msgTime,msgType,isRead from chatMsg WHERE chatNum =$num order by num";
$res = mysqli_query($conn,$sql);
$num=mysqli_num_rows($res);

$result = array();
for($i=0; $i<$num; $i++){
  $row = mysqli_fetch_array($res);

  array_push($result, array('writerNum'=>$row[0],
                            'msg'=>$row[1],
                            'msgTime'=>$row[2],
                            'msgType'=>$row[3],
                            'isRead'=>$row[4]));

}
echo json_encode(array("message"=>$result),JSON_UNESCAPED_UNICODE);


?>
