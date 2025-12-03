<?php 

require_once("AWeapon.php");

class PowerFist extends AWeapon{
    private bool $melee;
    public function PowerFist(){
        parent::__construct("PowerFist", 8, 50);
        $this->melee = true;
    }
    public function attack()
    {
        echo "SBAM\n";
    }
}


?>