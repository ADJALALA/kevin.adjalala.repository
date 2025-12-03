<?php
class Gecko{
    private string $name;
    private int $Age;
    public function __construct($name = null, $Age = null)
    {
        if($name !== null){
            $this->name = $name;
            echo "Hello {$name} !\n";
        }else{
            $this->name = "";
            echo "Hello !\n";
        }
    }
    public function __destruct()
    {
        if($this->name !== null){
            echo "Bye {$this->name} !\n";
        }else{
            echo "Bye\n";
        }
    }
    public function getName(){
        return $this->name;
    }
    public function getAge($Age){
        return $this->Age; 
    }
    public function setAge($Age){
        return $this->Age = $Age;
    }

    public function status(){
        switch(true){
            case($this->Age == 0):
                echo "Unborn Gecko\n";
                break;
            case($this->Age == 1 || $this->Age == 2):
                echo "Baby Geck\n”";
                break;
            case($this->Age >= 3 && $this->Age <= 10):
                echo "Adult Gecko\n”";
                break;
            case($this->Age >= 11 && $this->Age <= 13):
                echo "Old Gecko\n”";
                break;
            default:
                echo "mpossible Gecko";
                break;


        }

    }
}
?>