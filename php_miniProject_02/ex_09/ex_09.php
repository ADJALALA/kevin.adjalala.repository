<?php
function check_array_sum($numbers){
    if(empty($numbers)){
        return false;
    }
    $max = max($numbers);
    $key = array_search($max, $numbers);
    $others = $numbers;
    unset($others[$key]);
    $others = array_values($others);

    return canMakeSum($others, $max);
}
function canMakeSum($arr, $target){
    if($target == 0){
        return true;
    }
    if($target<0 || empty($arr)){
        return false;
    }
    for($i = 0; $i < count($arr); $i++){
        $current = $arr[$i];
        $remaining = $arr;
        unset($remaining[$i]);
        $remaining = array_values($remaining);

        if(canMakeSum($remaining, $target-$current)){
            return true;
        }
    }
    return false;
}

$arr = [4, 6, 23, 10, 1, 3];
if (check_array_sum($arr) == true)
echo "4 + 6 + 10 + 3 == 23";
?>