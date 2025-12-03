<?php
require_once "Animal.php";

class Shark extends Animal
{
    private bool $frenzy = false;

    public function __construct(string $name)
    {
        parent::__construct($name, 0, parent::FISH);
        echo "A KILLER IS BORN!\n";
    }

    public function smellBlood(bool $bool): void
    {
        $this->frenzy = $bool;
    }

    public function status(): void
    {
        if ($this->frenzy) {
            echo "{$this->getName()} is smelling blood and wants to kill.\n";
        } else {
            echo "{$this->getName()} is swimming peacefully.\n";
        }
    }
}
include_once("Canary.php") ;
$titi = new Canary("Titi");
$willy = new Shark("Willy"); // Yes , Willy is a shark here!
$willy->status();
$willy->smellBlood(true);
$willy->status();
$titi->layEgg();
echo $titi->getEggsCount() . "\n";
?>