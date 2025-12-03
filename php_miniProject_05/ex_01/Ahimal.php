<?php 
class Animal{
    public const MAMMAL = 0;
    public const FISH = 1;
    public const BIRD = 2;

    private int $type;
    private int $legs;
    private string $name;

    public function __construct($name, $legs, $type){
        $this->name = $name;
        $this->type = $type;
        $this->legs = $legs;

        echo "My name is {$this->name} and I am a {$this->getType()}!\n";
    }
    public function getName(){
        return $this->name;
    }
    public function getLegs(){
        return $this->legs;
    }
    public function getType():string{
        return match ($this->type) {
            self::MAMMAL => "mammal",
            self::FISH => "fish",
            self::BIRD => "bird",
        };
    }
}

$isidore = new Animal("Isidore", 4, Animal::MAMMAL);
echo $isidore->getName() . " has " . $isidore->getLegs() . " legs and is a " .
$isidore->getType() . ".\n";
?>