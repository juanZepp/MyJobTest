<?php

namespace controllers;

use daos\DaoCuentas;
use models\Cuenta;
use controllers\StudentController as studentController;


class statusController{
    function typeSession(){
        $homeController = new HomeController();
        $homeController->navBar();

        if(isset($_SESSION['cuenta'])){
            if($_SESSION['cuenta']->getPrivilegios()==0){
            // logeado como admin
                $studentController = new StudentController();
                $studentController->listStudents();
            }
            else if($_SESSION['cuenta']->getPrivilegios()==1){
            // logeado como usuario
            // $offerDao = new offerController();
            // $offerDao->listOffers();
            }
        }
        else{
            // no hay logeo
        }
    }
}
?>