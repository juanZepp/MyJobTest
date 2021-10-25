<?php 

namespace controllers;

// usar daoStudent o daoJobOffer????
use daos\DaoStudents;

class HomeController {
    function navBar(){
        $studentDAO = DaoStudents::GetInstance();
        $studentDAO->updateFromApi();  
        $listStudents = $studentDAO->getAll();
         include_once ROOT . VIEWS_PATH . 'nav-bar.php'; 
    }
}
?>