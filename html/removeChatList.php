<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];
$sendNum = $_POST['sendNum'];
$receiveNum = $_POST['receiveNum'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "DELETE FROM chatRoom WHERE num=$num";
mysqli_query($conn,$query);

$likeSql = "SELECT num FROM userLike WHERE sendNum=$sendNum and receiveNum=$receiveNum";
$likeRes = mysqli_query($conn,$likeSql);
$liksNum = mysqli_num_rows($likeRes);
if($liksNum==0){
  $likeSql2 = "SELECT num FROM userLike WHERE sendNum=$receiveNum and receiveNum=$sendNum";
  $likeRes2 = mysqli_query($conn,$likeSql2);
  $liksNum2 = mysqli_num_rows($likeRes2);
  if($liksNum2!=0){
    $likeRow2 = mysqli_fetch_array($likeRes2);
    $likeRemoveSql2 = "DELETE FROM userLike WHERE num=$likeRow2[0]";
    mysqli_query($conn,$likeRemoveSql2);
  }
}else{
  $likeRow = mysqli_fetch_array($likeRes);
  $likeRemoveSql = "DELETE FROM userLike WHERE num=$likeRow[0]";
  mysqli_query($conn,$likeRemoveSql);

}


$imageDeleteSql = "SELECT msg from chatMsg WHERE chatNum=$num and msgType='image'";
$imageDeleteRes = mysqli_query($conn,$imageDeleteSql);
$imageDeleteNum = mysqli_num_rows($imageDeleteRes);
$deleteImageList = array();
$k=0;
for($i=0; $i<$imageDeleteNum; $i++){
  $imageDeleteRow = mysqli_fetch_array($imageDeleteRes);
  $imageList = json_decode($imageDeleteRow[0],true);
  if(count($imageList)==1){
    $imageResult = explode("/",$imageList[0]);
    unlink("./chatimage/".$imageResult[4]);
    $deleteImageList[$k] = $imageResult[4];
    $k++;
  }else{
    for($j=0; $j<count($imageList); $j++){
      $imageResult = explode("/",$imageList[$j]);
      unlink("./chatimage/".$imageResult[4]);
      $deleteImageList[$k] = $imageResult[4];
      $k++;
    }
  }
}

$msgRemoveSql = "DELETE FROM chatMsg WHERE chatNum=$num";
mysqli_query($conn,$msgRemoveSql);

echo json_encode($deleteImageList,JSON_UNESCAPED_UNICODE);



?>
