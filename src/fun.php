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



?>