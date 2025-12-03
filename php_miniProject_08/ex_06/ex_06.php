<?php 
function remove_cookie($cookie){
    if(isset($_COOKIE[$cookie])) {
        setlocale($cookie, '', time() -3600, '/');
        unset($_COOKIE[$cookie]);
    }
}
?>