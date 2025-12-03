<?php 

require_once("AWeapon.php");

class PlasmaRifle extends AWeapon{
    private bool $melee;
    public function PlasmaRifle(){
        parent::__construct("Plasma Rifle", 5, 20);
        $this->melee = false;
    }
    public function attack()
    {
        echo "PIOU\n";
    }
}


?>