<?php
    require 'fun.php';

    header("content-type:text/html;charset=utf-8");

    $token=$_POST['token'];
    $personId=$_POST['personId'];
    $name=$_POST['name'];
    $UID=$_POST['UID'];
    $SID=$_POST['SID'];

    if ($personId<>""){
        //建立数据数组对象（字典）
        $query = array('UID' => $UID, 'SID' => $SID);
        //数据对象json化
        $querystr = http_build_query2($query);
        //建立头部信息数组对象
        $headerArray = array("Content-type:application/json", "Accept:application/json", 'token:' . $token);
        //发送的目标地址
        $url = 'https://api.bi.tuputech.com/v2/flow/visitor/' . $personId . '?' . $querystr;
    }

    if ($name<>""){
        $servername = "www.dcrm.com";
        $username = "root";
        $password = "root";
        $dbname = "dcrm";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        } 
        $formatstr = "SELECT `personId` FROM `visitors` WHERE `name`='key0'";
        $valuedict=array("key0"=>$name);
        $sql=create_sqlstr($formatstr, $valuedict);

        $result=$conn->query($sql);
        //$personId=$result;
        $row = $result->fetch_assoc();

        $personId=$row['personId'];
        //echo $personId;

        $conn->close();

        //建立数据数组对象（字典）
        $query = array('UID' => $UID, 'SID' => $SID);
        //数据对象json化
        $querystr = http_build_query2($query);
        //建立头部信息数组对象
        $headerArray = array("Content-type:application/json", "Accept:application/json", 'token:' . $token);
        //发送的目标地址
        $url = 'https://api.bi.tuputech.com/v2/flow/visitor/' . $personId . '?' . $querystr;

    }


    //curl初始化
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
    //执行GET动作，并返回结构
    $output = curl_exec($ch);
    //echo $output;
    $obj=json_decode($output);
    //var_dump($obj->visits[1]->start);
    //var_dump(count($obj->visits));
    $len=count($obj->visits);
    $newvisits=array();
    for ($i=0; $i<$len; $i++){
        $tmp=substr($obj->visits[$i]->start, 0, 10);
        if (in_array($tmp, $newvisits)){
            //do nothing
        }else{
            array_push($newvisits, $tmp);
        }      
    }
    $newvisitsstr=json_encode($newvisits);
    //echo $newvisitsstr;
    echo count($newvisits);

    $servername = "www.dcrm.com";
    $username = "root";
    $password = "root";
    $dbname = "dcrm";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    } 
    $formatstr = "UPDATE `visitors` SET `visithistory`='key0' WHERE `personId`='key1'";
    $valuedict=array("key0"=>$newvisitsstr, "key1"=>$personId);
    $sql=create_sqlstr($formatstr, $valuedict);
    $result=$conn->query($sql); 
    $conn->close();

    //关闭curl
    curl_close($ch);
?>