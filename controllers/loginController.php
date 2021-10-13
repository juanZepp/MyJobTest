<?php

namespace controllers;

class LoginController{
    function init(){
        $homeController = new HomeController();
        $homeController->navBar();
        require_once ROOT . "/views/login.php";
    }
}
?>