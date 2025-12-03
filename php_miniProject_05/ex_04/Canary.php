<?php
require_once "Animal.php";

class Canary extends Animal
{
    private int $eggs = 0;

    public function __construct(string $name)
    {
        parent::__construct($name, 2, parent::BIRD);
        echo "Yellow and smart? Here I am!\n";
    }

    public function getEggsCount(): int
    {
        return $this->eggs;
    }

    public function layEgg(): void
    {
        $this->eggs++;
    }
}

?>