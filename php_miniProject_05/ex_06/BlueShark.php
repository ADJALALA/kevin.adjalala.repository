<?php 

require_once("Shark.php");

class BlueShark extends Shark{
    private string $name;

    public function __construct(string $name)
    {
        parent::__construct($name, 0, parent::FISH);
    }
    public function eat(Animal $a):void
    {
        if($a === $this){
            //should'nt happen
        }
        echo "{$this->getName()} ate a {$a->getType()} named {$a->getName()}.\n";

        if($a === $frenzy){
            $this->frenzy = false;
            
        }
        echo "[name]: It’s not worth my time";

    }

}
?>