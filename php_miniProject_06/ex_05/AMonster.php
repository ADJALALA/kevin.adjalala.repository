<?php 

require_once("IUnit.php");

abstract class AMonster implements IUnit{
    protected string $name;
    protected int $hp = 0;
    protected int $ap = 0;
    protected int $apcost = 0;
    protected int $damage = 0;
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
    public function getDamage(){
        return $this->damage;
    }
    public function equip($param){
        echo "Monsters are proud and fight with their own bodies\n";
    }
    public function attack($param){
        if(!($param instanceof IUnit)){
            throw new Exception("Error in AMonster. Parameter is not an IUnit.");
        }
        if($this->dead) return false;
        if($this->closeTarget !== $param){
            echo "{$this->name}: I’m too far away from {$param->getName()}.\n";
            return false;
        }
        if($this->ap < $this->apcost)
            return false;
        echo "{$this->name} attacks {$param->getName()}.\n";

        $this->ap -= $this->apcost;
        $param->receiveDamage($this->damage);
        return true;
    }
    public function receiveDamage($param)
    {
        $this->hp = $param;
        if($this->hp <= 0){
            $this->dead = true;
            return false;
        }
        return true;
    }
    public function moveCloseTo($param)
    {
        if(!($param instanceof IUnit)){
            throw new Exception("Error in AMonster. Parameter is not an IUnit.");
        }
        if($this->closeTarget !== $param){
            echo "{$this->name}: is moving closer to {$param->getName()}.\n";
            $this->closeTarget = $param;
        }
    }
    public function recoverAP($param)
    {
        $this->ap += 7;
        if($this->ap >50) $this->ap = 50;
    }
}
?>