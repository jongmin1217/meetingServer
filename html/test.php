<?php
$i='1';
$j='2';

$q = array();
$q[0] = $i;
$q[1] = $j;

$json =  json_encode($q,JSON_UNESCAPED_UNICODE);
echo "$json";
?>
