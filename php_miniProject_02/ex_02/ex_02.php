<?php
function my_create_map(...$arrays){
    $map = array();
    foreach($arrays as $array){
        if(!is_array($array)|| count($array) < 2){
            echo "The given arguments are not valid\n";
            return NULL;
        }
        $map[$array[0]] = $array[1];
    }
    return $map;
}
// $array1 = ["pi", 3.14];
// $array2 = ["answer", 42];
// var_dump(my_create_map($array1, $array2));
?>