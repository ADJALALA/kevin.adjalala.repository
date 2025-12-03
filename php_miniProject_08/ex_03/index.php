<?php 
session_start();
if(isset($_GET['name'])){
    $_SESSION['name'] = $_GET['name'];
}
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
}else{
    $name = "Platypus";
}
echo "Hello" . $name;

?>