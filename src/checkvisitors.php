<?php
require 'fun.php';

header("content-type:text/html;charset=utf-8");

$tag = $_POST['tag'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$age = $_POST['age'];

echo "WHERE " . where_and(1, "tag", $tag) . where_and("age", $age);



?>