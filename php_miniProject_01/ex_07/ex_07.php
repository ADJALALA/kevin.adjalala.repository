<?php
function get_angry_dog($nbr){
    $result = "";
    for ($i = 0; $i<$nbr; $i++){
        $result .= "woof";
    }
    return $result ."\n";

}

echo (get_angry_dog(3));
?>