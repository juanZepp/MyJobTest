<?php
namespace controllers;

use daos\DaoStudents;
use models\Student as student;
use PDOException;

class studentController{
    private $daoStudent;
    private $statusController;
    private $loginController;

    function __construct(){
        $this->daoStudent = daoStudents::getInstance();
        $this->statusController = new StatusController();
        $this->loginController = new LoginController();
    }

    public function verificar($email = "", $password = ""){
        if($this->daoStudent->exist($email)){
            $student = $this->daoStudent->getByEmail($email);

            if($student->getPassword() == $password){
                $_SESSION["student"] = $student;
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

    // utilizar dni como identificador de las cuentas student de la api
    public function create( $email, $password, $rPassword, $dni){
        $daoStudent = $daoStudents::getInstance();

        $_SESSION['registerValidator']['email'] = ($this->daoStudent->exist($email)) ? 'is-invalid' : 'is-valid';

        $_SESSION['registerValidator']['dni'] = ($daoStudent->exist($dni)) ? 'is-invalid' : 'is-valid';
        
        $_SESSION['registerValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['registerValidator']['email'] == 'is-valid' || $_SESSION['registerValidator']['dni'] == 'is-valid' || $_SESSION['registerValidator']['password'] == 'is-valid'){
            $this->register();
        }
        else{
            unset($_SESSION['registerValidator']);

            $student = new Student(0, $email, $password, 1);

            try{
                $this->daoStudent->add($student);

                $_SESSION['student'] = $student;

                $statusController = new StatusController();
                $statusController->typeSession();

            }
            catch(PDOException $p){

            }
        }
    }

    public function logOff(){
        unset($_SESSION['access_token']);
        
        unset($_SESSION['student']);
        
        unset($_SESSION['loginValidator']);

        session_destroy();

        $loginController = new LoginController();
        $loginController->init();
    }

    public function viewStudent(){
        if(isset($_SESSION['student'])){
            include ROOT . VIEWS_PATH . "nav-bar.php";
            include ROOT . VIEWS_PATH . "view-student.php";
        }else{
            require_once("views/login.php");
        }
    }

    public function edit(){
        include ROOT . VIEWS_PATH . "update-student.php";
    }

    public function update($email, $password, $rPassword){

        $daoStudent = $daoStudents::getInstance();

        $cuentaOriginal = $_SESSION['student'];

        
        $_SESSION['updateValidator']['password'] = ($password != $rPassword) ? 'is-invalid' : 'is-valid';

        if($_SESSION['updateValidator']['password'] == 'is-valid'){
            $this->edit();
        }
        else{
            unset($_SESSION['updateValidator']);

            $cuentaOriginal->setPassword($password);
            $cuentaOriginal->getStudent()->setEmail($email);

            try{
                $this->daoStudent->update($student);

                $_SESSION['student'] = $cuentaOriginal;

                $this->viewStudent();

            }
            catch(PDOException $p){

            }
        }
    }
}
?>