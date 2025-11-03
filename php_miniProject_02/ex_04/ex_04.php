<?php
function my_password_hash($password){
    $salt = bin2hex(random_bytes(12));
    $hash = md5($salt.$password);

    return [
        "hash" => $hash,
        "salt" => $salt
    ];
}
function my_password_verify($password, $salt, $hash){
    return md5($salt.$password) === $hash;
}
$arr = my_password_hash("toto");
var_dump(my_password_verify("toto", $arr["salt"], $arr["hash"]));
?>