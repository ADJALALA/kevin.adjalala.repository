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
    public function eat(Animal $a):void
    {
        if($a === $this){
            //should'nt happen
        }
        echo "{$this->getName()} ate a {$a->getType()} named {$a->getName()}.\n";

        if($a === $frenzy){
            $this->frenzy = false;
            
        }
        echo "[name]: It’s not worth my time"

    }
}

?>