<?php
    require 'fun.php';

    header("content-type:text/html;charset=utf-8");

    $token=$_POST['token'];
    $personId=$_POST['personId'];
    $name=$_POST['name'];
    $UID=$_POST['UID'];
    $SID=$_POST['SID'];

    //echo $token;

    //建立数据数组对象（字典）
    $query = array('UID' => $UID, 'SID' => $SID);
    //数据对象json化
    $querystr = http_build_query2($query);
    //建立头部信息数组对象
    $headerArray = array("Content-type:application/json", "Accept:application/json", 'token:' . $token);
    //发送的目标地址
    $url = 'https://api.bi.tuputech.com/v2/flow/visitor/' . $personId . '?' . $querystr;
    //curl初始化
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
    //执行GET动作，并返回结构
    $output = curl_exec($ch);
    echo $output;
    //echo count($output.visits);
    //do something
    //do something

    //关闭curl
    curl_close($ch);
?>