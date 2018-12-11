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
?>