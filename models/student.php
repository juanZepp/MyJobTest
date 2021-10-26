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
    private $birthDate;
    private $email;
    private $password;
    private $phoneNumber;
    private $active;
    private $privilegios;

    function __construct($studentId = 0, $careerId = 0,  $firstName = "", $lastName = "", $dni = "", $fileNumber = "", $gender = "", $birthDate = "", $email = "", $password = "", $phoneNumber = "", $active = true, $privilegios = ""){
        $this->studentId=$studentId;
        $this->careerId=$careerId;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->dni=$dni;
        $this->fileNumber=$fileNumber;
        $this->gender=$gender;
        $this->birthDate=$birthDate;
        $this->email=$email;
        $this->password=$password;
        $this->phoneNumber=$phoneNumber;
        $this->active=$active;
        $this->privilegios=$privilegios;
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

    public function getBirthDate(){
        return $this->birthDate;
    }

    public function setBirthDate($birthDate){
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
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
    
    public function getPrivilegios(){
        return $this->privilegios;
    }

    public function setPrivilegios($privilegios){
        $this->privilegios = $privilegios;
        return $this;
    }
}
?>