<?php 

require_once("IUnit.php");

abstract class ASpaceMarine implements IUnit{
    protected string $name;
    protected int $hp = 0;
    protected int $ap = 0;
    protected ?IUnit $closeTarget = null;
    protected bool $dead = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
    public function getHp(){
        return $this->hp;
    }
    public function getAp(){
        return $this->ap;
    }
    public function equip($param){

    }
    public function attack($param){

    }
    public function receiveDamage($param){

    }
    public function moveCloseTo($param){

    }
    public function recoverAP($param){
        
    }
}
?>