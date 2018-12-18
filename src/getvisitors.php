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
echo $count;

for ($i = 0; $i < $count; $i++) {
    $personId = $php_body->visitors[$i]->personId;
    $name = $php_body->visitors[$i]->name;
    $type = $php_body->visitors[$i]->type;
    $sex = $php_body->visitors[$i]->attributes[0]->text;
    $age = $php_body->visitors[$i]->attributes[2]->text;
    $faceposition_jsonstr=json_encode($php_body->visitors[$i]->thumbnail->facePosition);
    $imageurl = $domains_large . $php_body->visitors[$i]->thumbnail->path;
    $start=$php_body->visitors[$i]->start;

    $formatstr1 = "INSERT INTO visitdate (personId, name, date) VALUE ( 'key0', 'key1', 'key2' )";
    $valuedict1=array("key0"=>$personId, "key1"=>$name, "key2"=>$start);
    $sqlstr1=create_sqlstr($formatstr1, $valuedict1);
    echo $sqlstr1;
    newsql($servername, $username, $password, $dbname, $sqlstr1);

    $formatstr2 = "INSERT INTO visitors (personId, name, type, sex, age, imageurl, faceposition) VALUES ('key0', 'key1', 'key2', 'key3', 'key4', 'key5', 'key6')";
    $valuedict2 = array("key0" => $personId, "key1" => $name, "key2" => $type, "key3" => $sex, "key4" => $age, "key5" => $imageurl, "key6"=>$faceposition_jsonstr);
    $sqlstr2 = create_sqlstr($formatstr2, $valuedict2);
    echo $sqlstr2;
    newsql($servername, $username, $password, $dbname, $sqlstr2);

    /* $sqlstr3 = "DELETE \n"
    . "FROM\n"
    . " `visitors` \n"
    . "WHERE id IN \n"
    . " (SELECT \n"
    . " t.id \n"
    . " FROM\n"
    . " (SELECT \n"
    . " * \n"
    . " FROM\n"
    . " `visitors` r \n"
    . " GROUP BY r.personId\n"
    . " HAVING COUNT(*) > 1) AS t)\n"
    . ""; */
    $sqlstr3="DELETE FROM `visitors` WHERE id IN (SELECT MAX(t.id) FROM (SELECT * FROM `visitors` r GROUP BY r.personId HAVING COUNT(*) > 1) AS t)";
    newsql($servername, $username, $password, $dbname, $sqlstr3);
}
curl_close($ch);




?>