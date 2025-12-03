<?php 
class Mars{
    private $id = 0;
    private static $idSuivant = 0;
    function __construct(){
        $this->id = self::$idSuivant;
        self::$idSuivant++;
    }
    function getId(){
        return $this->id;
    }
}
include_once("Mars.php");
$rocks = new Mars();
$lite = new Mars();
$snack = new Mars();
echo $rocks->getId() . "\n";
echo $lite->getId() . "\n";
echo $snack->getId() . "\n";
?>