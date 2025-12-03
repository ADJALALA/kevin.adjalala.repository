<?php 

namespace chocolate;

class Mars{
    private $id = 0;
    private static $idSuivant = 0;
    function __construct(){
        $this->id = self::$idSuivant;
        self::$idSuivant++;
    }
    function getId(){
        return $this->id;
    }
}

namespace planet;

class Mars {
    private $size;
    public function __construct($size = null)
        {
            $this->size = $size;
        }
    public function getSize(){
        return $this->size;
    }
    public function setSize($size){
        return $this->size = $size;
    }
}

?>