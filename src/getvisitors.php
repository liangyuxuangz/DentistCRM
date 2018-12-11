<?php
require 'fun.php';
header("content-type:text/html;charset=utf-8");

$tag = $_POST['tag'];
$tagstr=change2paramstr("tag", $tag);

$sortBy = $_POST['sortBy'];
$sortBystr=change2paramstr("sortBy", $sortBy);

$sortOrder = $_POST['sortOrder'];
$sortOrderstr=change2paramstr("sortOrder", $sortOrder);

$date = $_POST['date'];
$datestr=change2paramstr("date", $date);

$start = $_POST['start'];
$startstr=change2paramstr("start", $start);

$end = $_POST['end'];
$endstr=change2paramstr("end", $end);

$UID = $_POST['UID'];
$UIDstr=change2paramstr("UID", $UID, "");

$SID = $_POST['SID'];
$SIDstr=change2paramstr("SID", $SID);

$token=$_POST['token'];
$tokenstr=change2paramstr("token", $token);


$headerArray = array("Content-type:application/json;","Accept:application/json;", 'token:' . $token);
$url = 'https://api.bi.tuputech.com/v2/flow/visitors?' .  $UIDstr . $SIDstr . $tagstr . $sortBystr . $sortOrderstr . $datestr . "&page=1&limit=30";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($url, CURLOPT_HTTPHEADER, $headerArray);
var_dump($ch);
$output = curl_exec($ch);
echo $output;
curl_close($ch);

?>