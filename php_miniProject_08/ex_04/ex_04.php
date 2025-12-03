<?php 
function remove_session(){
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION = array();

    if(isset($_COOKIE[session_name()])){
        setrawcookie(session_name(), '', -3600, '/');
    }
    session_destroy();
}
?>