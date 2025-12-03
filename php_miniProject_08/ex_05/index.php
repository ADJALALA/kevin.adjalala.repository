<?php 

if(isset($_GET['name'])){
    setcookie('name', $_GET['name'], time() +(30*24*3600), '/');
    $name = $_GET['name'];
}
if(isset($_COOKIE['name'])){
    $name = $_COOKIE['name'];
}else{
    $name = "Platypus";
}
echo "Hello" . $name;

?>