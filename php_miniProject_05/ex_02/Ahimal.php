<?php

class Animal
{
    public const MAMMAL = 0;
    public const FISH = 1;
    public const BIRD = 2;

    private static int $animalsAlive = 0;
    private static int $mammals = 0;
    private static int $fishes = 0;
    private static int $birds = 0;

    private string $name;
    private int $legs;
    private int $type;

    public function __construct($name, $legs, $type)
    {
        $this->name = $name;
        $this->legs = $legs;
        $this->type = $type;

        self::$animalsAlive++;

        match ($type) {
            self::MAMMAL => self::$mammals++,
            self::FISH => self::$fishes++,
            self::BIRD => self::$birds++,
        };

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

    private static function printCount(int $n, string $type): void
    {
        $verb = $n === 1 ? "is" : "are";
        $plural = $n === 1 ? "" : "s";

        echo "There {$verb} currently {$n} {$type}{$plural} alive in our world.\n";
    }

    public static function getNumberOfAnimalsAlive(): int
    {
        self::printCount(self::$animalsAlive, "animal");
        return self::$animalsAlive;
    }

    public static function getNumberOfMammals(): int
    {
        self::printCount(self::$mammals, "mammal");
        return self::$mammals;
    }

    public static function getNumberOfFishes(): int
    {
        $verb = self::$fishes === 1 ? "is" : "are";
        echo "There {$verb} currently " . self::$fishes . " fish alive in our world.\n";
        return self::$fishes;
    }

    public static function getNumberOfBirds(): int
    {
        self::printCount(self::$birds, "bird");
        return self::$birds;
    }
}

?>