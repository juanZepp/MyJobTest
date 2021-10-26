<?php

namespace models;

class jobPosition{
    private $jobPositionId;
    private $carrerId;
    private $description;
    
    function __construct($jobPositionId = 0, $carrerId = 0, $description = ""){
        $this->jobPositionId=$jobPositionId;
        $this->careerId=$careerId;
        $this->description=$description;
    }

    public function getJobPositionId(){
        return $this->jobPositionId;
    }

    public function setJobPositionId($jobPositionId){
        $this->jobPositionId = $jobPositionId;
        return $this;
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
}
?>