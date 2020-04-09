<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];
$user = $_POST['user'];
$like = $_POST['like'];

// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");

if($like=='true'){
  $query = "DELETE FROM postLike WHERE postNum=$num and likeUserNum=$user";
}else{
  $query = "INSERT INTO postLike (postNum,likeUserNum) VALUES ($num,$user)";

}
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "failed";
}

?>
