<?php
function my_print_args($var){
    if (is_array($var)){
        foreach ($var as $item){
            if (is_array($item)){
                my_print_args($item);
            }else{
                echo $item ."\n";
            }
        }
    }else{
        echo $var."\n";
    }
      
}
// $example = array (
// array("test", "Hello world", "php rocks", 42)
// );
// my_print_args($example);

?>