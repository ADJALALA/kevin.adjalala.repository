<?php

class Animal
{
    public const MAMMAL = 0;
    public const FISH = 1;
    public const BIRD = 2;

    private string $name;
    private int $legs;
    private int $type;

    public function __construct(string $name, int $legs, int $type)
    {
        $this->name = $name;
        $this->legs = $legs;
        $this->type = $type;

        echo "My name is {$this->name} and I am a {$this->getType()}!\n";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLegs(): int
    {
        return $this->legs;
    }

    public function getType(): string
    {
        return match ($this->type) {
            self::MAMMAL => "mammal",
            self::FISH => "fish",
            self::BIRD => "bird",
        };
    }
}
