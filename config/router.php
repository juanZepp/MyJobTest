<?php 

namespace config;

use config\request as Request;

class router{
    public static function Route(Request $request){
        $controllerName = $request->getcontroller();
        $methodName = $request->getmethod();
        $methodParameters = $request->getparameters();
        $controllerClassName = "controllers\\". $controllerName;    
        $controller = new $controllerClassName;
        if(!isset($methodParameters))            
            call_user_func(array($controller, $methodName));
        else
            call_user_func_array(array($controller, $methodName), $methodParameters);
    }
}
?>