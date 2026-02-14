<?php 
if ($argc !== 6){
    echo "Bad params! Usage: php connect_db.php host username password port db \N";
    exit(1);
    $host = $argv[1];
    $username = $argv[2];
    $password = $argv[3];
    $port = $argv[4];
    $db = $argv[5];

    $connection = connect_db($host, $username, $password, $port, $db);

    if ($connection !== false){
        echo "onnection to DB successful\n";
    }else{
        echo "Error connection to DB\n";
        exit(1);
    }
}
?>