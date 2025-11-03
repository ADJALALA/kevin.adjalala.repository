<?php
function my_add_elem_map($key, $value, &$map){
    if(!is_array($map)){
        echo "You have to give good parameters\n";
        return $map;
    }
    $map[$key] = $value;
    return $map;
}
function my_modify_elem_map($key, $value, &$map){
    if(!is_array($map) || !isset($map[$key])){
        echo "You have to give good parameters\n";
        return $map;
    }
    $map[$key] = $value;
    return $map;
}

function my_delete_elem_map($key, &$map){
    if(!is_array($map) || !isset($map[$key])){
        echo "You have to give good parameters\n";
        return $map;
    }
    unset($map[$key]);
    return $map;
}
function my_is_elem_map($key, $value, &$map){
    if(!is_array($map) || !isset($map[$key])){
        echo "You have to give good parameters\n";
        return false;
    }
    return isset($map[$key]) && $map[$key];
}
// $arr = array();
// $arr = my_add_elem_map("first", "baris", $arr);
// $arr = my_add_elem_map("second", "toto", $arr);
// $arr = my_add_elem_map("third", "life", $arr);
// $arr = my_modify_elem_map("third", "42", $arr);
// $arr = my_delete_elem_map("
// second", $arr);
// var_dump($arr);
?>