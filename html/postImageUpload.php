<?php


$file_path = "./postimage/";
$var = $_POST['result'];



$file_path = $file_path . basename( $_FILES['uploaded_file']['name']);

if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
    $result ="succes"/*array("result" => "success", "value" => $var)*/;
} else{
    $result ="failed" /*array("result" => "error")*/;
}
echo $result;

?>
