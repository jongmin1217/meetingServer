!# /usr/bin/php -q
<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");





$seoul = $arrayName = array('0' => "서울",'1' =>"경기",'2' =>"인천" );
$gyeonggi = $arrayName = array('0' => "경기도",'1' =>"서울",'2' =>"인천" );
$incheon = $arrayName = array('0' => "인천",'1' =>"서울",'2' =>"경기도" );
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
  $areaList = array();
  $userNum = $userDataRow[0];
  $hobby = $userDataRow[1];
  $idealType = $userDataRow[2];
  $area = $userDataRow[3];
  $gender = $userDataRow[4];
  $recommendation = $userDataRow[5];
  $previousRecommendation = $userDataRow[6];

  $idealTypeList = json_decode($idealType);
  $hobbyList = json_decode($hobby);
  $recommendationList = json_decode($recommendation);
  $previousRecommendationList = json_decode($previousRecommendation);
  $userResult = array_merge($idealTypeList,$hobbyList);


  if(count($recommendationList)==0 && count($previousRecommendationList)==0){
    $recommendationResultList=array();
  }else{
    if(count($recommendationList)==0){
      $recommendationResultList = $previousRecommendationList;
    }else if(count($previousRecommendationList)==0){
      $recommendationResultList = $recommendationList;
    }else if(count($previousRecommendationList)!=0 && count($recommendationList)!=0){
      $recommendationResultList = array_merge($recommendationList,$previousRecommendationList);
    }

  }

  $likeSendList = array();
  $likeReceiveList = array();

  $likeReceiveSql = "SELECT sendNum from userLike where receiveNum=$userNum";
  $likeReceiveRes = mysqli_query($conn,$likeReceiveSql);
  $likeReceiveNum = mysqli_num_rows($likeReceiveRes);
  for($w=0; $w<$likeReceiveNum; $w++){
    $likeReceiveRow = mysqli_fetch_array($likeReceiveRes);
    $likeReceiveList[$w] = $likeReceiveRow[0];
  }

  $likeSendSql = "SELECT receiveNum from userLike where sendNum=$userNum";
  $likeSendRes = mysqli_query($conn,$likeSendSql);
  $likeSendNum = mysqli_num_rows($likeSendRes);

  for($w=0; $w<$likeSendNum; $w++){
    $likeSendRow = mysqli_fetch_array($likeSendRes);
    $likeSendList[$w] = $likeSendRow[0];
  }

  $likeResult = array();

  if(count($likeSendList)==0 && count($likeReceiveList)==0){
    $likeResult = array();
  }else{
    if(count($likeSendList)==0){
      $likeResult = $likeReceiveList;
    }else if(count($likeReceiveList)==0){
      $likeResult = $likeSendList;
    }else if(count($likeSendList)!=0 && count($likeReceiveList)!=0){
      $likeResult = array_merge($likeSendList,$likeReceiveList);
    }

  }

  $resultListrecommendation=array();
  if(count($likeResult)==0){
    $resultListrecommendation=$recommendationResultList;
  }else{
    $resultListrecommendation = array_merge($recommendationResultList,$likeResult);
  }

  $previousRecommendationText = "";
  if(count($resultListrecommendation)!=0){
    $previousRecommendationText = $previousRecommendationText."and num not in(";
    for($j=0; $j<count($resultListrecommendation); $j++){
      if($j==0){
        $previousRecommendationText = $previousRecommendationText."'$resultListrecommendation[$j]'";
      }else{
        $previousRecommendationText = $previousRecommendationText.",'$resultListrecommendation[$j]'";
      }
    }
    $previousRecommendationText = $previousRecommendationText.")";
  }

  echo "$previousRecommendationText";


  if($gender=='남자'){
    $searchGender='여자';
  }else{
    $searchGender='남자';
  }

  if($area=='서울'){
    $areaList = $seoul;
  }else if($area=='경기도'){
    $areaList = $gyeonggi;
  }else if($area=='인천'){
    $areaList = $incheon;
  }else if($area=='충청도'){
    $areaList = $chungcheong;
  }else if($area=='경상도'){
    $areaList = $gyeongsang;
  }else if($area=='전라도'){
    $areaList = $jeolla;
  }else if($area=='강원도'){
    $areaList = $gangwon;
  }else if($area=='제주'){
    $areaList = $jeju;
  }

  $same6 = array();
  $same5 = array();
  $same4 = array();
  $same3 = array();
  $same2 = array();
  $same1 = array();

  $searchUserSql = "SELECT num,hobby,personality FROM userData where area='$areaList[0]' and gender='$searchGender' $previousRecommendationText";

  $searchUserRes = mysqli_query($conn,$searchUserSql);
  $searchUserNum=mysqli_num_rows($searchUserRes);
  for($j=0; $j<$searchUserNum; $j++){
    $searchUserRow = mysqli_fetch_array($searchUserRes);

    $searchHobbyList = json_decode($searchUserRow[1]);
    $searchPersonalityList = json_decode($searchUserRow[2]);
    $searchResult = array_merge($searchHobbyList,$searchPersonalityList);

    $compare = array_intersect($userResult,$searchResult);
    $compareResult = array_values(array_filter(array_map('trim',$compare)));

    if(count($compareResult)==6){
      $same6[count($same6)] = $searchUserRow[0];
    }else if(count($compareResult)==5){
      $same5[count($same5)] = $searchUserRow[0];
    }else if(count($compareResult)==4){
      $same4[count($same4)] = $searchUserRow[0];
    }else if(count($compareResult)==3){
      $same3[count($same3)] = $searchUserRow[0];
    }else if(count($compareResult)==2){
      $same2[count($same2)] = $searchUserRow[0];
    }else if(count($compareResult)==1){
      $same1[count($same1)] = $searchUserRow[0];
    }

  }

  $sameResult = array_merge($same6,$same5,$same4,$same3,$same2,$same1);

  if(count($sameResult)==0){
    $same6 = array();
    $same5 = array();
    $same4 = array();
    $same3 = array();
    $same2 = array();
    $same1 = array();

    $searchUserSql = "SELECT num,hobby,personality FROM userData where area='$areaList[1]' and gender='$searchGender' $previousRecommendationText";

    $searchUserRes = mysqli_query($conn,$searchUserSql);
    $searchUserNum=mysqli_num_rows($searchUserRes);
    for($j=0; $j<$searchUserNum; $j++){
      $searchUserRow = mysqli_fetch_array($searchUserRes);

      $searchHobbyList = json_decode($searchUserRow[1]);
      $searchPersonalityList = json_decode($searchUserRow[2]);
      $searchResult = array_merge($searchHobbyList,$searchPersonalityList);

      $compare = array_intersect($userResult,$searchResult);
      $compareResult = array_values(array_filter(array_map('trim',$compare)));

      if(count($compareResult)==6){
        $same6[count($same6)] = $searchUserRow[0];
      }else if(count($compareResult)==5){
        $same5[count($same5)] = $searchUserRow[0];
      }else if(count($compareResult)==4){
        $same4[count($same4)] = $searchUserRow[0];
      }else if(count($compareResult)==3){
        $same3[count($same3)] = $searchUserRow[0];
      }else if(count($compareResult)==2){
        $same2[count($same2)] = $searchUserRow[0];
      }else if(count($compareResult)==1){
        $same1[count($same1)] = $searchUserRow[0];
      }

    }

    $sameResult = array_merge($same6,$same5,$same4,$same3,$same2,$same1);

    if(count($sameResult)==0){
      $same6 = array();
      $same5 = array();
      $same4 = array();
      $same3 = array();
      $same2 = array();
      $same1 = array();

      $searchUserSql = "SELECT num,hobby,personality FROM userData where area='$areaList[2]' and gender='$searchGender' $previousRecommendationText";

      $searchUserRes = mysqli_query($conn,$searchUserSql);
      $searchUserNum=mysqli_num_rows($searchUserRes);
      for($j=0; $j<$searchUserNum; $j++){
        $searchUserRow = mysqli_fetch_array($searchUserRes);

        $searchHobbyList = json_decode($searchUserRow[1]);
        $searchPersonalityList = json_decode($searchUserRow[2]);
        $searchResult = array_merge($searchHobbyList,$searchPersonalityList);

        $compare = array_intersect($userResult,$searchResult);
        $compareResult = array_values(array_filter(array_map('trim',$compare)));

        if(count($compareResult)==6){
          $same6[count($same6)] = $searchUserRow[0];
        }else if(count($compareResult)==5){
          $same5[count($same5)] = $searchUserRow[0];
        }else if(count($compareResult)==4){
          $same4[count($same4)] = $searchUserRow[0];
        }else if(count($compareResult)==3){
          $same3[count($same3)] = $searchUserRow[0];
        }else if(count($compareResult)==2){
          $same2[count($same2)] = $searchUserRow[0];
        }else if(count($compareResult)==1){
          $same1[count($same1)] = $searchUserRow[0];
        }

      }

      $sameResult = array_merge($same6,$same5,$same4,$same3,$same2,$same1);
    }
  }

  $insertRecommendation = array();
  $insertRecommendation[0] = $sameResult[0];
  $insertRecommendation[1] = $sameResult[1];
  $insertRecommendationString = json_encode($insertRecommendation,JSON_UNESCAPED_UNICODE);

  if(count($recommendationResultList)==0){
    $updateSql = "UPDATE userData SET recommendation='$insertRecommendationString' WHERE num='$userNum' LIMIT 1";
  }else{
    $recommendationResultListString = json_encode($recommendationResultList);
    $updateSql = "UPDATE userData SET recommendation='$insertRecommendationString',previousRecommendation='$recommendationResultListString' WHERE num='$userNum' LIMIT 1";
  }

  if(mysqli_query($conn,$updateSql)){
    echo "succes";
  }else{
    echo "failed";
  }


}

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
