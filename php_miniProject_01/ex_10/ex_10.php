<?php
function my_get_args(){
    $args = array();
    $num_args = func_num_args();
    for ($i = 0; $i<$num_args; $i++){
        $args[] =func_get_args($i);
    }
    return $args
        
}
?>