<?php
header('Content-Type: text/html; charset=UTF-8');

include('http://13.209.4.115/simple_html_dom.php');


$url = 'https://tv.zum.com/ranking';

$html = @file_get_html($url);
echo "asd";
//
// unset($arr_result);
// $arr_result = $html->find('div.tv_wrap>a');
// if(count($arr_result) > 0){
//   foreach($arr_result as $e){
//     echo $e->children(0)->plaintext.':';
//     echo $e->children(1)->children(1)->plaintext.'<br/>';
//     //위의 값 중 미스트롯 값을 가져옴
//   }
// } else {
//   echo "<br/>";
// }
// unset($arr_result);
// $arr_result = $html->find('div.list_wrap>div.list');
// //4위 ~ 50위 랭킹순위 및 프로그램명 가져오기
// if(count($arr_result) > 0){
//   foreach($arr_result as $e){
//     echo $e->children(1)->plaintext.':';
//     echo $e->children(2)->children(1)->children(0)->plaintext.'<br/>';
//   }
// } else {
//   echo "<br/>";
// }
// exit;




?>
