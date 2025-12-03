<?php

include_once("Astronaut.php");

class Team
{
    private string $name;
    private $astronauts;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->astronauts = [];
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
}
include_once("Team.php");
include_once("Mars.php");
$mutta = new Astronaut("Mutta");
$hibito = new Astronaut("Hibito");
$serika = new Astronaut("Serika");
$spaceBro = new Team ("SpaceBrothers");
$spaceBro->add($mutta);
$spaceBro->add($hibito);
$spaceBro->add($serika);
$spaceBro->add(3);
echo $spaceBro->countMembers() . "\n";
$titi = new planet\Mars();
$mutta->doActions($titi);
$spaceBro->showMembers();
$spaceBro->remove($hibito);
echo $spaceBro->countMembers() . "\n";
?>