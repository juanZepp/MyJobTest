<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "config/autoload.php";
require "config/config.php";

use config\autoload as Autoload;
use config\router as Router;
use config\request as Request;

Autoload::Start();

session_start();

require_once(VIEWS_PATH . "header.php");

Router::Route(new Request());

require_once(VIEWS_PATH . "footer.php");

?>