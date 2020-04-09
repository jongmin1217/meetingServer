<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

$maleImage = $arrayName = array('0' => 'w1.jpg','1' => 'w2.jpg','2' => 'w3.jpg','3' => 'w4.jpg','4' => 'w5.jpg','5' => 'w6.jpg','6' => 'w7.jpg',
'7' => 'w8.jpg','8' => 'w9.jpg','9' => 'w10.jpg','10' => 'w11.jpg','11' => 'w12.jpg','12' => 'w13.jpg','13' => 'w14.jpg','14' => 'w15.jpg','15' => 'w16.jpg',
'16' => 'w17.jpg','17' => 'w18.jpg','18' => 'w19.jpg','19' => 'w20.jpg','20' => 'w21.jpg','21' => '15.jpg','22' => '16.jpg','23' => '17.jpg','24' => '18.jpg',
'25' => 'w21.jpg','26' => '20.jpg','27' => '21.jpg','28' => '22.jpg','29' => '23.jpg','30' => '24.jpg','31' => '25.jpg','32' => '26.jpg','33' => '27.jpg',
'34' => '28.jpg');

$femaleImage = $arrayName = array('0' => 'q1.jpg','1' => 'q2.jpg','2' => 'q3.jpg','3' => 'q4.jpg','4' => 'q5.jpg','5' => 'q6.jpg','6' => 'q7.jpg',
'7' => 'q8.jpg','8' => 'q9.jpg','9' => 'q10.jpg','10' => 'q11.jpg','11' => 'q12.jpg','12' => 'q13.jpg','13' => 'q14.jpg','14' => 'q15.jpg','15' => 'q16.jpg',
'16' => 'q17.jpg','17' => 'q18.jpg','18' => 'q19.jpg','19' => 'q20.jpg','20' => 'q21.jpg','21' => '1.jpg','22' => '2.jpg','23' => '3.jpg','24' => '4.jpg'
,'25' => '5.jpg','26' => '6.jpg','27' => '7.jpg','28' => '8.jpg','29' => '9.jpg','30' => '10.jpg','31' => '11.jpg','32' => '12.jpg','33' => '13.jpg'
,'34' => '14.jpg' );

$area = array("서울","경기도","인천","충청도","경상도","전라도","강원도","제주");
$month = array("1","2","3","4","5","6","7","8","9","10","11","12");
$gender = array("남자","여자");
$form = array("마름","조금마름","보통","통통함","뚱뚱함","글래머","근육질");
$smoke = array("흡연","비흡연");
$drink = array("가끔마심","자주마심","맨날마심");
$personality = array("지적인","차분한","유머있는","낙천적인","내향적인","외향적인","감성적인","상냥한","귀여운","열정적인","듬직한","개성있는");
$idealType = array("지적인","차분한","유머있는","낙천적인","내향적인","외향적인","감성적인","상냥한","귀여운","열정적인","듬직한","개성있는");
$hobby = array("스포츠","영화감상","음악감상","음주","드라이빙","독서","등산","공부");
$height = array();
$year = array();
$day = array();
$phonenumber = "1";
$status = "3";
$password="1";
$signupCode = "asddddwq";




$imagelist = array();
$hobbylist = array();
$personalitylist = array();
$idealTypelist = array();

for($i=1981; $i<2002; $i++){
  $year[$i-1981] = $i;
}
for($j=1; $j<31; $j++){
  $day[$j-1] = $j;
}

for($k=140; $k<201; $k++){
  $height[$k-140] = $k;
}



$str = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s",
                "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9");

for($qwe=0; $qwe<3000; $qwe++){
  $email="";
  for ($x = 0; $x < 8; $x++) {
      $randomNum = mt_rand(0, 34);
      $addCode = $str[$randomNum];
      $email = $email.$addCode;

  }


  $nickname="";
  for ($e = 0; $e < 8; $e++) {
      $randomNum = mt_rand(0, 34);
      $addCode = $str[$randomNum];
      $nickname = $nickname.$addCode;

  }

  $genderInput = $gender[mt_rand(0,1)];

  for($ii=0; $ii<3; $ii++){
    if($genderInput=='남자'){
      $imagelist[$ii] = "http://13.209.4.115/profileimage/".$maleImage[mt_rand(0, 34)];
    }else{
      $imagelist[$ii] = "http://13.209.4.115/profileimage/".$femaleImage[mt_rand(0, 34)];
    }
    for($jj=0; $jj<$ii; $jj++){
      if($imagelist[$ii]==$imagelist[$jj]){
        $ii--;
      }
    }
  }
  $imageInput = json_encode($imagelist,JSON_UNESCAPED_UNICODE);

  $heightInput = $height[mt_rand(0,60)];
  $formInput = $form[mt_rand(0,6)];

  for($ii1=0; $ii1<3; $ii1++){
    $hobbylist[$ii1] = $hobby[mt_rand(0, 7)];
    for($jj1=0; $jj1<$ii1; $jj1++){
      if($hobbylist[$ii1]==$hobbylist[$jj1]){
        $ii1--;
      }
    }
  }

  $hobbyInput = json_encode($hobbylist,JSON_UNESCAPED_UNICODE);

  for($ii2=0; $ii2<3; $ii2++){
    $idealTypelist[$ii2] = $idealType[mt_rand(0, 11)];
    for($jj2=0; $jj2<$ii2; $jj2++){
      if($idealTypelist[$ii2]==$idealTypelist[$jj2]){
        $ii2--;
      }
    }
  }
  $idealTypeInput = json_encode($idealTypelist,JSON_UNESCAPED_UNICODE);

  for($ii3=0; $ii3<3; $ii3++){
    $personalitylist[$ii3] = $personality[mt_rand(0, 11)];
    for($jj3=0; $jj3<$ii3; $jj3++){
      if($personalitylist[$ii3]==$personalitylist[$jj3]){
        $ii3--;
      }
    }
  }
  $personalityInput = json_encode($personalitylist,JSON_UNESCAPED_UNICODE);

  $smokeInput = $smoke[mt_rand(0,1)];
  $drinkInput = $drink[mt_rand(0,2)];


  $birth = $year[mt_rand(0, 20)]."/".$month[mt_rand(0, 11)]."/".$day[mt_rand(0, 29)];

  $areaInput = $area[mt_rand(0,7)];
  //echo json_encode($hobbylist);

  $sql = "INSERT INTO userData (email,password,nickname,phoneNumber,image,height,form,hobby,idealType,smoking,
    drinking,birth,area,personality,gender,userStatus,signupCode) VALUES ('$email','$password','$nickname','$phonenumber',
      '$imageInput','$heightInput','$formInput','$hobbyInput','$idealTypeInput','$smokeInput','$drinkInput','$birth',
      '$areaInput','$personalityInput','$genderInput','$status','$signupCode')";

      if(mysqli_query($conn,$sql)){
        echo "succes";
      }else{
        echo "failed";
      }
}



?>
