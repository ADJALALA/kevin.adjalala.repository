<?php
class Gecko{
    private string $name;
    private int $Age;
    private $energy;
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
    public function getEnergy(){
        return $this->energy;
    }
    public function setEnergy($energy){
        if($energy < 0){
            $this->energy = 0;
        }else if($energy > 100){
            $this->energy = 100;
        }else{
            $this->energy = $energy;
        }
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
    public function hello($params){
        if(is_string($params)){
            if($this->name !== null){
                echo "Hello $params, I'm {$this->name} !\n";
            }else{
                echo "Hello $params !\n";
            }
        }else if(is_int($params)){
            for($i=0; $i<$params; $i++ ){
                if($this->name !== null){
                    echo "Hello, I'm {$this->name} !\n";
                }else{
                    echo "Hello !\n";
                }
            }
        }

    }
    public function eat($food){
        $food = strtolower($food);
        if($food === "Meat"){
            echo "Yummy !\n";
            $this->setEnergy($this->energy+10);
        }else if($food = "Vegetable"){
            echo "Erk !\n";
            $this->setEnergy($this->energy-10);
        }else{
            echo "I can’t eat this.!\n";
        }
    }
}

?>