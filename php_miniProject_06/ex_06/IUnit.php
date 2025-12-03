<?php 

interface IUnit{
    public function equip($param);
    public function attack($param);
    public function receiveDamage($param);
    public function moveCloseTo($param);
    public function recoverAP($param);
    
}

?>