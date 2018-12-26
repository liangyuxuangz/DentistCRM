<?php
function change2paramstr($objname, $value, $header="&")
{
    $result="";
    if ($value<>""){
        $result=$header . $objname . "=" . $value;
    }
    return $result;
}

function Month2Normal($month){
    $m=(int)$month;
    $m=$m+1;
    return (string)$m;
}

function http_build_query2($data){
    $obj=array();
    foreach ($data as $x=>$x_value){
        if ($x_value!=""){
            $obj[$x]=$x_value;
        }
    }
    return http_build_query($obj);
}

function newsql($servername, $username, $password, $dbname, $sqlstr)
{
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    if ($conn->query($sqlstr) === true) {
        echo "新记录插入成功";
    } else {
        echo "Error: " . $sqlstr . "<br>" . $conn->error;
    }

    $conn->close();
}

function create_sqlstr($formatstr, $replacedict)
{
    $tmp=$formatstr;
    foreach ($replacedict as $x=>$x_value){
        //echo $x;
        //echo '<br/>';
        //echo $x_value;
        //echo '<br/>';
        $tmp=str_replace($x, $x_value, $tmp);
    }
    return $tmp;
    //echo $tmp;
}

function where_and($item, $value, $ifhead=0){
    $tmp="";
    if ($value!=""){
        if ($ifhead==1){
            $tmp=" " . $item . "='" . $value . "'";
        }
        else{
            $tmp=" AND " . $item . "='" . $value . "'";
        }
    }
    return $tmp;
}
?>