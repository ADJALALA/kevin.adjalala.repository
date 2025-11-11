<?php
require_once 'config.php';
require_once 'classes.php';

$pdo = getDbConnection();
$userObj = new User($pdo);
$userObj->logout();

header('Location: index.php');
exit;
?>