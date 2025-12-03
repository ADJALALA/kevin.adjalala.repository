<?php
class Gecko{
    private string $name;
    private int $Age;
    private $energy;
    private $drunk;
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
        if($this->drunk && $this->rollDice()){
            echo "I’m too drunk for that. . . hic !\n";
            return;
        }
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
        if($this->drunk && $this->rollDice()){
            echo "I’m too drunk for that. . . hic !\n";
            return;
        }
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
        if($this->drunk && $this->rollDice()){
            echo "I’m too drunk for that. . . hic !\n";
            return;
        }
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
    public function work(){
        if($this->drunk && $this->rollDice()){
            echo "I’m too drunk for that. . . hic !\n";
            return;
        }
        if($this->energy >= 25){
            echo "I’m working T.T !\n";
            $this->setEnergy($this->energy-9);
        }else{
            echo "Heyyy. . . I’m too sleepy, better take a nap!\n";
            $this->setEnergy($this->energy+50);
        }
    }
    public function rollDice(){
        return (rand(1, 6) == 1);
    }
    public function fraternize($param){
        if($param instanceof Gecko){
            $otherName = $param->getName();
        }
        if($this->energy < 30 && $param->getEnergy < 30){
            echo "Not today !\n";
            $param->sayNotToday();
            return;
        }
        if($this->energy < 30){
            echo "Sorry $otherName, I’m too tired for going outtonight. . .  !\n";
            $param->sayToobad($this->name);
            return;
        }
        if ($param->getEnergy() < 30) {
            echo "Sorry {$this->name}, I'm too tired for going out tonight...\n";
            echo "Oh ! That's too bad, another time then !\n";
            return;
        }
        // Les deux peuvent sortir
            echo "I'm going to drink with $otherName !\n";
            $this->setEnergy($this->energy - 30);
            $this->drunk = true; // Devient ivre
            
            $param->goOutWith($this->name);
        }elseif (get_class($param) === "Snake") {
            if ($this->energy >= 10) {
                $this->setEnergy(0);
                echo "LET'S RUN AWAY !!!\n";
            } else {
                echo "...\n";
            }
        }else {
            echo "No way.\n";
        }
        
        
        
    }
    
    // Méthode helper pour dire "Not today"
    private function sayNotToday()
    {
        echo "Not today !\n";
    }
    
    // Méthode helper pour répondre à l'autre Gecko
    private function sayTooBad($otherName)
    {
        echo "Oh ! That's too bad, another time then !\n";
    }
    
    // Méthode helper pour sortir avec un autre Gecko
    private function goOutWith($otherName)
    {
        echo "I'm going to drink with $otherName !\n";
        $this->setEnergy($this->energy - 30);
        $this->drunk = true;
    }
}

?>