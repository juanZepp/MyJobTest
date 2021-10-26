<?php

namespace models;

class Career{
    private $carrerId;
    private $description;
    private $active;
    
    function __construct($carrerId = 0, $description = "",  $active = true){
        $this->careerId=$careerId;
        $this->description=$description;
        $this->active=$active;
    }

    public function getCarrerId(){
        return $this->carrerId;
    }

    public function setCarrerId($carrerId){
        $this->carrerId = $carrerId;
        return $this;
    }

    public function getDescription(){
        return $this->description;
    }
 
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function getActive(){
        return $this->active;
    }

    public function setActive($active){
        $this->active = $active;
        return $this;
    }
}
?>