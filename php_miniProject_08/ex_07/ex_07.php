<?php 
function modify_cookie($name, $value){
    setcookie($name, $value, time() +(30*24*3600), '/');
}
?>