<?php
namespace daos;

require_once("config.autoload.php");

use daos\Connection as connection;
use models\Cuenta as cuenta;
use PDOException;

class daoCuentas implements Idao{
    private $connection;
    private static $instance = null;
    const COLUMN_ENABLED = "enabled";

    public function __construct(){

    }

    public function Add($cuenta){
        // llenar con los atributos que tenga cuenta
        $sql = "INSERT into cuentas (enabled) values (:enabled);";
        $parameters['enabled']=1;
        try{
            $this->connection = connection::GetInstance();
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        }catch(PDOException $ex){
            throw $ex;
        }
    }

}
?>