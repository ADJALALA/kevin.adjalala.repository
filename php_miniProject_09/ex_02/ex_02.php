<?php
function my_password_hash($password){
    $salt = bin2hex(random_bytes(16));
    $hash = crypt($password, '$6$' . $salt);
    return [
        "hash" => $salt,
        "salt" => $salt
    ];
}
function my_password_verify($password, $salt, $hash){
    $test_hash = crypt($password, '$6$' . $salt);
    return $test_hash === $hash;
}

// $result = my_password_hash("password");
// $is_valid = my_password_verify("password", $result["salt"], $result["hash"]);
// echo "verificaation " . ($is_valid ? "true" : "false") . "\n";
?>