<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$email = $_POST['email'];
$selectArea = $_POST['selectArea'];
$selectBirth = $_POST['selectBirth'];
$selectGender = $_POST['selectGender'];
$selectHeight = $_POST['selectHeight'];
$selectForm = $_POST['selectForm'];
$selectSmoke = $_POST['selectSmoke'];
$selectDrink = $_POST['selectDrink'];
$selectPersonality = $_POST['selectPersonality'];
$selectHobby = $_POST['selectHobby'];
$selectIdealType = $_POST['selectIdealType'];
$selectNickname = $_POST['selectNickname'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "UPDATE userData SET area='$selectArea',birth='$selectBirth',gender='$selectGender',
height=$selectHeight,form='$selectForm',smoking='$selectSmoke',drinking='$selectDrink',
personality='$selectPersonality',hobby='$selectHobby',idealType='$selectIdealType',nickname='$selectNickname' WHERE email='$email' LIMIT 1";
if(mysqli_query($conn,$query)){
  echo "succes";
}else{
  echo "write failed";
}
?>
