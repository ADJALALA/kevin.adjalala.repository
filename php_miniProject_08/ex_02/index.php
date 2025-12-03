<?php 
if(isset($_GET['name'])){
    $name = $_GET['name'];
}else{
    $name = "Platypus";
}
echo "Hello" . $name;

?>