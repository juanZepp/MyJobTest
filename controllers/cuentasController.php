<?php
namespace controllers;

use daos\DaoCuentas as daoCuentas;
use models\Cuentas as cuentas;

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

    
}