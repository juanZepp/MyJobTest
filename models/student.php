<?php

namespace models;

class Student{
    private $studentId;
    private $careerId;
    private $firstName;
    private $lastName;
    private $dni;
    private $fileNumber;
    private $gender;
    private $birthday;
    private $phoneNumber;
    private $active;

    //email esta dentro de cuenta. studentid importa crear otro aparte del de cuenta? careerid?active?
    function __construct($studentId = 0,$careerId = 0,$firstName = "",$lastName = "",$dni = "",$fileNumber = "",$gender = "",$birthday = "",$phoneNumber = "",$active = true){
        $this->studentId=$studentId;
        $this->careerId=$careerId;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->dni=$dni;
        $this->fileNumber=$fileNumber;
        $this->gender=$gender;
        $this->birthday=$birthday;
        $this->phoneNumber=$phoneNumber;
        $this->active=$active;
    }
 
    public function getStudentId(){
        return $this->studentId;
    }

    public function setStudentId($studentId){
        $this->studentId = $studentId;
        return $this;
    }

    public function getCareerId(){
        return $this->careerId;
    }

    public function setCareerId($careerId){
        $this->careerId = $careerId;
        return $this;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
        return $this;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setDni($dni){
        $this->dni = $dni;
        return $this;
    }

    public function getFileNumber(){
        return $this->fileNumber;
    }
 
    public function setFileNumber($fileNumber){
        $this->fileNumber = $fileNumber;
        return $this;
    }

    public function getGender(){
        return $this->gender;
    }

    public function setGender($gender){
        $this->gender = $gender;
        return $this;
    }

    public function getBirthday(){
        return $this->birthday;
    }

    public function setBirthday($birthday){
        $this->birthday = $birthday;
        return $this;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
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