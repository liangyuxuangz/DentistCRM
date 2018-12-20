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
$token = $_POST['token'];


$query = array('tag' => $tag, 'sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'date' => $date, 'start' => $start, 'end' => $end, 'UID' => $UID, 'SID' => $SID);
$querystr = http_build_query2($query);
$headerArray = array("Content-type:application/json", "Accept:application/json", 'token:' . $token);
$url = 'https://api.bi.tuputech.com/v2/flow/visitors' . '?' . $querystr . "&page=1&limit=30";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
$output = curl_exec($ch);
echo $output;
$servername = "www.dcrm.com";
$username = "root";
$password = "root";
$dbname = "dcrm";
$php_body = json_decode($output);
$domains_large = $php_body->domains->large;
$count = count($php_body->visitors);
// echo $count;
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

for ($i = 0; $i < $count; $i++) {
    $personId = $php_body->visitors[$i]->personId;
    $name = $php_body->visitors[$i]->name;
    $type = $php_body->visitors[$i]->type;
    $sex = $php_body->visitors[$i]->attributes[0]->text;
    $age = $php_body->visitors[$i]->attributes[2]->text;
    $faceposition_jsonstr=json_encode($php_body->visitors[$i]->thumbnail->facePosition);
    $imageurl = $domains_large . $php_body->visitors[$i]->thumbnail->path;
    $start=$php_body->visitors[$i]->start;
    
    // $personId="08ef0220000a-cd98-8e11-4cc2-4a";
    $formatstr = "UPDATE visitors SET imageurl='key0', age='key1', faceposition='key2' WHERE personId='key3'";
    $valuedict=array("key0"=>$imageurl, "key1"=>$age, "key2"=>$faceposition_jsonstr, "key3"=>$personId);
    $sql=create_sqlstr($formatstr, $valuedict);
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows) {
    // 输出数据
        /* while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
        } */
        echo $result->num_rows;
    } 
    else {
        $formatstr = "INSERT INTO visitors (personId, name, type, sex, age, imageurl, facepositon) VALUES ('key0', 'key1', 'key2', 'key3', 'key4', 'key5', 'key6')";
        $valuedict=array("key0"=>$personId, "key1"=>"NULL", "key2"=>$type, "key3"=>$sex, "key4"=>$age, "key5"=>$imageurl, "key6"=>$faceposition_jsonstr);
        $sql=create_sqlstr($formatstr, $valuedict);
        $conn->query($sql);
    }
}


$conn->close();
curl_close($ch);




?>