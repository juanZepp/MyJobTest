<?php
namespace controllers;

use daos\DaoCuentas as daoCuentas;
use daos\DaoStudents;
use models\Cuenta as cuenta;
use models\Studens as student;
use PDOException;

class cuentasControllers{
    private $daoCuenta;
    private $statusController;
    private $loginController;

    function __construct(){
        $this->daoCuenta = daoCuentas::getInstance();
        $this->statusController = new StatusController();
        $this->loginController = new LoginController();
    }

    public function verificar($email = "", $password = ""){
        if($this->daoCuenta->exist($email)){
            $cuenta = $this->daoCuenta->getByEmail($email);

            if($cuenta->getPassword() == $password){
                $_SESSION["cuenta"] = $cuenta;
                $this->statusController->typeSession();
            }
            else{
                $_SESSION["loginValidator"]["passValidator"] = "is-invalid";
                $_SESSION["loginValidator"]["emailValidator"] = "is-valid";
                $this->loginController->init();
            }
        }
        else{
            $_SESSION["loginValidator"]["emailValidator"] = "is-invalid";
            $this->loginController->init();
        }
    }

    public function register(){
        include "views/signup.php";
    }

    //studentId, careerId, active ?????
    public function create($firstName, $lastName, $dni, $fileNumber, $gender, $birthday, $email, $phoneNumber, $password, $rPassword){
        $daoStudent = $daoStudents::getInstance();

        $_SESSION['registerValidator']['email'] = ($this->daoCuenta->exist($email)) ? 'is-invalid' : 'is-valid';
        
        $_SESSION['registerValidator']['dni'] = ($daoStudent->exist($email)) ? 'is-invalid' : 'is-valid';
        
        $_SESSION['registerValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['registerValidator']['email'] == 'is-valid' || $_SESSION['registerValidator']['dni'] == 'is-valid' || $_SESSION['registerValidator']['password'] == 'is-valid'){
            $this->register();
        }
        else{
            unset($_SESSION['registerValidator']);

            $cuenta = new Cuenta(0, $email, $password, 1);

            $cuenta->setStudent(new Student($firstName, $lastName, $dni, $fileNumber, $gender, $birthday, $email, $phoneNumber));

            try{
                $this->daoCuenta->add($cuenta);

                $_SESSION['cuenta'] = $cuenta;

                $statusController = new StatusController();
                $statusController->typeSession();

            }
            catch(PDOException $p){

            }
        }
    }

    public function logOff(){
        unset($_SESSION['access_token']);
        
        unset($_SESSION['cuenta']);
        
        unset($_SESSION['loginValidator']);

        session_destroy();

        $loginController = new LoginController();
        $loginController->init();
    }

    public function viewStudent(){
        if(isset($_SESSION['cuenta'])){
            include ROOT . VIEWS_PATH . "nav-bar.php";
            include ROOT . VIEWS_PATH . "view-cuenta.php";
        }else{
            require_once("views/login.php");
        }
    }

    public function update($firstName, $lastName, $fileNumber, $gender, $birthday, $phoneNumber, $password, $rPassword){

        $daoStudent = $daoStudents::getInstance();

        $cuentaOriginal = $_SESSION['cuenta'];

        
        $_SESSION['updateValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['updateValidator']['password'] == 'is-valid'){
            $this->editCuenta();
        }
        else{
            unset($_SESSION['updateValidator']);

            $cuentaOriginal->setPassword($password);
            $cuentaOriginal->getStudent()->setFirstName($firstName);
            $cuentaOriginal->getStudent()->setLasttName($lastName);
            $cuentaOriginal->getStudent()->setFileNumber($fileNumber);
            $cuentaOriginal->getStudent()->setGender($gender);
            $cuentaOriginal->getStudent()->setBirthday($birthday);
            $cuentaOriginal->getStudent()->setPhoneNumber($phoneNumber);

            try{
                $this->daoCuenta->update($cuenta);

                $_SESSION['cuenta'] = $cuentaOriginal;

                $this->viewStudent();

            }
            catch(PDOException $p){

            }
        }
    }
}
?>