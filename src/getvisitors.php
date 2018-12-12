<?php
require 'fun.php';

header("content-type:text/html;charset=utf-8");

$tag = $_POST['tag'];
$sortBy = $_POST['sortBy'];
$sortOrder = $_POST['sortOrder'];
$date = $_POST['date'];
$start = $_POST['start'];
$end = $_POST['end'];
$UID = $_POST['UID'];
$SID = $_POST['SID'];
$token=$_POST['token'];


$query=array('tag'=>$tag, 'sortBy'=>$sortBy, 'sortOrder'=>$sortOrder, 'date'=>$date, 'start'=>$start, 'end'=>$end, 'UID'=>$UID, 'SID'=>$SID);
$querystr=http_build_query2($query);
$headerArray = array("Content-type:application/json", "Accept:application/json", 'token:' . $token);
$url = 'https://api.bi.tuputech.com/v2/flow/visitors' . '?' . $querystr ."&page=1&limit=30";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
var_dump($ch);
$output = curl_exec($ch);
echo $output;
curl_close($ch);

?>