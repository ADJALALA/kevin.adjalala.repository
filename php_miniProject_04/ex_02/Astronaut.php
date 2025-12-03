<?php 
class Astronaut{
    private $id = 0;
    private static $idSuivant = 0;
    private string $name;
    private int $snacks;
    private $destination;

    function __construct($name){
        $this->name = $name;
        $this->snacks = 0;
        $this->destination = null;
        $this->id = self::$idSuivant;
        self::$idSuivant++;
        echo "{$this->name} ready for launch !\n";
    }
    function getId(){
        return $this->id;
    }
    function getDestination(){
        return $this->destination;
    }
}
// include_once("Astronaut.php");
// $mutta = new Astronaut("Mutta");
// $hibito = new Astronaut("Hibito");
// echo $mutta->getId() . "\n";
// echo $hibito->getId() . "\n";
?>