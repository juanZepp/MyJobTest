<?php

define('ROOT', dirname(__DIR__) . "/");
define('FRONT_ROOT', '/MyJobTest/');
define('VIEWS_PATH','views/');
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

//Constantes para API TMDB 
define('KEY_TMDB', '4f3bceed-50ba-4461-a910-518598664c08');
define('HOST_URL', '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/");

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