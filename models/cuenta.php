<?php

namespace models;

use models\Student as student;

class Cuenta{
    private $id;
    private $email;
    private $password;
    private $privilegios;
    private $student;

    function __construct($id = 0, $email = "", $password = "", $privilegios = "", $student = ""){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->privilegios = $privilegios;
        $this->student = $student;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
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

    public function getPrivilegios(){
        return $this->privilegios;
    }

    public function setPrivilegios($privilegios){
        $this->privilegios = $privilegios;
        return $this;
    }

    public function setStudent($student){
        $this->student = $student;
        return $this;
    }
}
?>