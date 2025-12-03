<?php 

require_once "Animal.php";

class Cat extends Animal{
    private $color;

    public function __construct(string $name, ?string $color = "grey"){
        parent::__construct($name, 4, parent::MAMMAL);
        $this->color = $color;

        echo "{$name}: MEEEOOWWWW\n";
    }
    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }
    public function meow(): void
    {
        echo "{$this->getName()} the {$this->color} kitty is meowing.\n";
    }
    
}
$isidore = new Cat("Isidore", "orange");
echo $isidore->getName() . " has " . $isidore->getLegs() . " legs and is a " .
$isidore->getType() . ".\n";
$isidore->meow();

?>