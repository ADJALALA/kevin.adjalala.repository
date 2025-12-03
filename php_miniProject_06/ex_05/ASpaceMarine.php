<?php 

require_once("IUnit.php");
require_once("AWeapon.php");


abstract class ASpaceMarine implements IUnit{
    protected string $name;
    protected int $hp = 0;
    protected int $ap = 0;
    protected ?IUnit $closeTarget = null;
    protected bool $dead = false;
    protected ?AWeapon $aweapon = null;

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
    public function getWeapon(){
        return $this->weapon;
    }
    public function equip($param){
        if(!($param instanceof AWeapon)){
            throw new Exception("Error in ASpaceMarine. Parameter is not an AWeapon.");
        }
        $this->weapon = $param;
        echo "{$this->name} has been equipped with a {$param->getName()}.\n";

    }
    public function attack($param){
        if(!($param instanceof IUnit)){
            throw new Exception("Error in ASpaceMarine. Parameter is not an IUnit.");
        }
        if($this->dead) return false;
        if($this->weapon === null){
            echo "{$this->name}: Hey, this is crazy. I’m not going to fight this empty handed.\n";
            return false;
        }
        if($this->weapon->isMelee && $this->closeTarget !== $param){
            echo "{$this->name}: I’m too far away from {$param->getName()}.\n";
            return false;
        }
        if($this->ap < $this->weapon->getApcost())
            return false;
        echo "{$this->name} attacks {$param->getName()} with a $this->weapon->getName().\n";
        $this->weapon->attack();
        $param->receiveDamage($this->weapon->getDamage());
        $this->ap -= $this->weapon->getApcost();
        return true;

    }
    public function receiveDamage($param){
        $this->hp = $param;
        if($this->hp <= 0){
            $this->dead = true;
            return false;
        }
        return true;

    }
    public function moveCloseTo($param){
        if(!($param instanceof IUnit)){
            throw new Exception("Error in AMonster. Parameter is not an IUnit.");
        }
        if($this->closeTarget !== $param){
            echo "{$this->name}: is moving closer to {$param->getName()}.\n";
            $this->closeTarget = $param;
        }

    }
    public function recoverAP($param){
        $this->ap += 9;
        if($this->ap >50) $this->ap = 50;
        
    }
}
?>