<?php

require 'fun.php';

header("content-type:text/html;charset=utf-8");

$personId=$_POST['personId'];
$usercode=$_POST['usercode'];
$name=$_POST['name'];
$type=$_POST['type'];
$sex=$_POST['sex'];
$age=$_POST['age'];

$servername = "www.dcrm.com";
$username = "root";
$password = "root";
$dbname = "dcrm";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$formatstr = "UPDATE `visitors` SET `usercode`='key0',`name`='key1',`type`='key2',`sex`='key3',`age`='key4' WHERE `personId`='key5'";
$valuedict=array("key0"=>$usercode, "key1"=>$name, "key2"=>$type, "key3"=>$sex, "key4"=>$age, "key5"=>$personId);
$sql=create_sqlstr($formatstr, $valuedict);
//echo $sql;

$result=$conn->query($sql);

$conn->close();

?>