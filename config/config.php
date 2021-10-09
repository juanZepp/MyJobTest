<?php

define('ROOT', dirname(__DIR__) . "/");
define('FRONT_ROOT', 'http://localhost/MyJobTest/');
define('VIEWS_PATH','views/');
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");

//Constantes para BD 
define("DB_HOST", "localhost");
define("DB_NAME", "MyJob");
define("DB_USER", "root");
define("DB_PASS", "");

//phpmailer  
define("EMAIL","MyJob@gmail.com"); 
define("EMAIL_PASS","1MyJob1"); 
define("MAILER_PATH",FRONT_ROOT."PHPMailer/");

?>