<?php

class Team
{
    private string $name;
    private array $astronauts = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAstronauts(): array
    {
        return $this->astronauts;
    }

    public function add($a)
    {
        if (!($a instanceof Astronaut)) {
            echo "{$this->name}: Sorry, you are not part of the team.\n";
            return;
        }

        $this->astronauts[] = $a;
    }

    public function remove($astronaut)
    {
        foreach ($this->astronauts as $i => $a) {
            if ($a === $astronaut) {
                unset($this->astronauts[$i]);
            }
        }
    }

    public function countMembers(): int
    {
        return count($this->astronauts);
    }

    public function showMembers()
    {
        if (empty($this->astronauts)) return;

        echo "{$this->name}: ";

        $list = [];
        foreach ($this->astronauts as $a) {
            $status = ($a->getDestination() !== null) ? "on mission" : "on standby";
            $list[] = "{$a->getId()} {$a->name} $status"; // name is private : on modifie
        }

        // Correction → afficher le nom, pas l'id
        $out = [];
        foreach ($this->astronauts as $a) {
            $status = ($a->getDestination() !== null) ? "on mission" : "on standby";
            $out[] = "{$a->getName()} $status";
        }

        echo implode(", ", $out) . ".\n";
    }
    public function doActions($param = null)
{
    if ($param === null) {
        echo "{$this->name}: Nothing to do.\n";
        return;
    }

    // Si c’est un chocolat, tout le monde en mange 1
    if ($param instanceof \chocolate\Mars) {
        foreach ($this->astronauts as $a) {
            $a->doActions($param);
        }
        return;
    }

    // sinon appel normal
    foreach ($this->astronauts as $a) {
        $a->doActions($param);
    }
}

}

?>