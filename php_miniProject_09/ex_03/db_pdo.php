<?php 
define('ERROR_LOG_FILE', 'errors_file');
function connect_db($host, $username, $passwd, $port, $db){
    try{
        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//lance les exceptions en cas d'erreur
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //retourne les resultats en tableau associatif
            PDO::ATTR_EMULATE_PREPARES => false, //utilise les vtaies requetes préparées
        ];
        $pdo = new PDO($dsn, $username, $passwd, $options);
        return $pdo;
    }catch(PDOException $e){
        $error_message = "PDO ERROR:" . $e->getMessage() . "storage in" . ERROR_LOG_FILE .  "\n";

        echo $error_message;

        file_put_contents(ERROR_LOG_FILE, date('[Y-m-d H:i:s]'). $error_message, FILE_APPEND) ;
        return false;
    }
}
?>