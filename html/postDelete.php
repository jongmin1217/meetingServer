<?php
$servername = "localhost";
$name = "syj40886";
$mysqlpassword = "Whdals.1217";
$database = "meet";

$num = $_POST['num'];


// Create connection
$conn = new mysqli($servername, $name, $mysqlpassword, $database);
mysqli_query("set names utf8");


$query = "DELETE FROM postData WHERE num=$num";
$query2 = "DELETE FROM postComent WHERE postNum=$num";
$query3 = "DELETE FROM postLike WHERE postNum=$num";
if(mysqli_query($conn,$query)&&mysqli_query($conn,$query2)&&mysqli_query($conn,$query3)){
  echo "succes";
}else{
  echo "failed";
}
?>
