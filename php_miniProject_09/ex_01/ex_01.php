<?php
function my_very_secure_hash($password){
    return md5($password);
}
echo my_very_secure_hash("password");
?>