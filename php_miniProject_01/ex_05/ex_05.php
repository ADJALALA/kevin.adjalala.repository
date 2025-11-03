<?php
function my_swap(mixed &$str1, mixed &$str2)
{
    $temp = $str1;
    $str1 = $str2;
    $str2 = $temp;
    echo $str1." ".$str2."\n";
}


?>