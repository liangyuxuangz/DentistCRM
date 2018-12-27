<?php
require 'fun.php';

header("content-type:text/html;charset=utf-8");

$type = $_POST['type'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$age = $_POST['age'];

//echo "WHERE " . where_and("tag", $tag, 1) . where_and("age", $age);
$servername = "www.dcrm.com";
$username = "root";
$password = "root";
$dbname = "dcrm";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
$sql = "SELECT * FROM visitors WHERE" . where_and("type", $type, 1) . where_and("name", $name) . where_and("sex", $sex) . where_and("age", $age);
$result=$conn->query($sql);
if ($result->num_rows){
    $result_rows=array();
    $result_row=array();
    while($row = $result->fetch_assoc()) {
        $result_row["type"]=$row["type"];
        $result_row["name"]=$row["name"];
        $result_row["sex"]=$row["sex"];
        $result_row["age"]=$row["age"];
        array_push($result_rows, $result_row);
    }
    echo json_encode($result_rows);
}


$conn->close();

?>