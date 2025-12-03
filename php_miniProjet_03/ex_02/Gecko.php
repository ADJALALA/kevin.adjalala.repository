<?php
class Gecko{
    public string $name;
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
}
// include_once("Gecko.php");
// $thomas = new Gecko("Thomas");
// $annonymus = new Gecko();
// echo $thomas->name;
// echo $annonymus->name . "\n";
?>