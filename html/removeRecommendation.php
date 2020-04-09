<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$seoul = $arrayName = array('0' => "서울",'1' =>"경기",'2' =>"인천" );
$gyeonggi = $arrayName = array('0' => "경기",'1' =>"서울",'2' =>"인천" );
$incheon = $arrayName = array('0' => "인천",'1' =>"서울",'2' =>"경기" );
$chungcheong = $arrayName = array('0' => "충청도",'1' =>"경상도",'2' =>"전라도" );
$gyeongsang = $arrayName = array('0' => "경상도",'1' =>"전라도",'2' =>"충청도" );
$jeolla = $arrayName = array('0' => "전라도",'1' =>"경상도",'2' =>"충청도" );
$gangwon = $arrayName = array('0' => "강원도",'1' =>"경기도",'2' =>"서울" );
$jeju = $arrayName = array('0' => "제주도",'1' =>"서울",'2' =>"경기도" );

$userDataSql = "SELECT num,hobby,idealType,area,gender,recommendation,previousRecommendation FROM userData";
$userDataRes = mysqli_query($conn,$userDataSql);
$userDataNum=mysqli_num_rows($userDataRes);

for($i=0; $i<$userDataNum; $i++){
  $userDataRow = mysqli_fetch_array($userDataRes);
  $userNum = $userDataRow[0];
  $sql = "UPDATE userData SET recommendation=NULL , previousRecommendation=NULL WHERE num='$userNum' LIMIT 1 ";
  if(mysqli_query($conn,$sql)){
    echo "succes";
  }else{
    echo "failed";
  }

}



?>
