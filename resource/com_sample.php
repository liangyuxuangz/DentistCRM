<?php
header("content-type:text/html;charset=utf-8");

$key = $_POST['key1'];
$screct=$_POST['key2'];


$data = array(
);
$data = json_encode($data);
$headerArray = array("Content-type:application/json;charset='utf-8'", "Accept:application/json");
$curl = curl_init();
$url = 'https://api.bi.tuputech.com/v1/auth/token/' . $key;
// echo $url;
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
echo $output;
curl_close($curl);

?>