<?php

require 'fun.php';

header("content-type:text/html;charset=utf-8");

$personId=$_POST['personId'];

$servername = "www.dcrm.com";
$username = "root";
$password = "root";
$dbname = "dcrm";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$formatstr = "DELETE FROM `visitors` WHERE `personId`='key0'";
$valuedict=array("key0"=>$personId);
$sql=create_sqlstr($formatstr, $valuedict);
echo $sql;

$result=$conn->query($sql);

$conn->close();

?>