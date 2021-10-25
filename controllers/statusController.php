<?php

namespace controllers;

use daos\DaoStudents;
use models\Student;
use controllers\StudentController as studentController;
use daos\DaoJobOffers as daoJobOffer;


class statusController{
    function typeSession(){
        $homeController = new HomeController();
        $homeController->navBar();

        if(isset($_SESSION['student'])){
            if($_SESSION['student']->getPrivilegios()=="admin"){
            // logeado como admin
                $studentController = new StudentController();
                $studentController->listStudents();
            }
            else if($_SESSION['student']->getPrivilegios()=="student"){
            // logeado como usuario, lo que va a ver cuando logee
            // $daoJobOffer = new jobOfferController();
            // $daoJobOffer->listOffers();
            }
        }
        else{
            // no hay logeo
        }
    }
}
?>