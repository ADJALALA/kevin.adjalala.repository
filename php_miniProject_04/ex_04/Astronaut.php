<?php 
include_once("Mars.php");

use planet\Mars as PlanetMars;
use chocolate\Mars as ChocolateMars;

class Astronaut{

    private static int $idSuivant = 0;
    private int $id;
    private string $name;
    private int $snacks;
    private $destination;

    public function __construct(string $name){
        $this->name = $name;
        $this->snacks = 0;
        $this->destination = null;
        $this->id = self::$idSuivant++;
        echo "{$this->name} ready for launch !\n";
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function getSnacks(): int {
        return $this->snacks;
    }

    public function doActions($param = null){
        if ($param === null) {
            echo "{$this->name}: Nothing to do.\n";
        }
        elseif ($param instanceof PlanetMars) {
            echo "{$this->name}: started a mission !\n";
            $this->destination = $param;
        }
        elseif ($param instanceof ChocolateMars) {
            echo "{$this->name} is eating mars number {$param->getId()}.\n";
            $this->snacks++;
        }
    }

    public function __destruct(){
        if ($this->destination !== null) {
            echo "{$this->name}: Mission aborted !\n";
        } 
        else {
            echo "{$this->name}: I may have done nothing, but I have {$this->snacks} Mars to eat at least !\n";
        }
    }
}

?>
