<?php
class Gecko{
    private string $name;
    function __construct($name = null)
    {
        if($name !== null){
            $this->name = $name;
            echo "Hello {$name} !\n";
        }else{
            $this->name = "";
            echo "Hello !\n";
        }
    }
    function __destruct()
    {
        if($this->name !== null){
            echo "Bye {$this->name} !\n";
        }else{
            echo "Bye\n";
        }
    }
    function getName(){
        return $this->name;
    }

}
// include_once("Gecko.php");
// $thomas = new Gecko("Thomas");
// $anonymous = new Gecko();
// $serguei = new Gecko("Serguei");
// unset($serguei);
// echo $thomas->getName() . "\n";
// echo $anonymous->getName() . "\n";
?>