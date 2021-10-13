<?php

namespace daos;

require_once("config.autoload.php");

use daos\Connection as connection;
use models\Cuenta as cuenta;
use daos\DaoStudents as daoStudents;
use PDOException;

class daoCuentas implements Idao{
    private $connection;
    private static $instance = null;
    //funciona el enabled? si no funciona => const COLUMN_ENABLED = "enabled";

    public function __construct(){

    }

    public function add($cuenta){
        if($cuenta instanceof Cuenta){
            try{
                $sql = "INSERT into cuentas (email, password, privilegios, enabled) values (:email, :password, :privilegios,:enabled);";
                $parameters['email'] =  $cuenta->getEmail();
                $parameters['password'] =  $cuenta->getPassword();
                $parameters['privilegios'] =  $cuenta->getPrivilegios();
                $parameters['enabled']=1;

                $this->connection = connection::GetInstance();

                $this->connection->ExecuteNonQuery($sql,$parameters);

                //el id se genera en la base de datos, por eso tengo que pedir nuevamente el objeto.
                $object = $this->getByEmail($cuenta->getEmail());

                $cuenta->setId($object->getId());
            
                $daoStudent = daoStudents::GetInstance();

                $daoStudent->add($cuenta);

            }
            catch(PDOException $ex){
                throw $ex;
            }
        }
    }

    public function getById($id){
        try{
            // :id o $id?
            $sql = " SELECT * from cuentas where id = :id";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($sql);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            /* $daoStudent = daoStudents::GetInstance();
            $object->setStudent($daoStudent->getByIdCuenta($object->getId())); */

            return $object;
        }
        catch (Exception $ex){
            throw $ex;
        }
    }
    
    public function getByEmail($email){
        try{
            // :email o $email?
            $sql = " SELECT * from cuentas where email = :email";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($sql);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            /* $daoStudent = daoStudents::GetInstance();
            $object->setStudent($daoStudent->getByIdCuenta($object->getId())); */

            return $object;
        }
        catch (Exception $ex){
            throw $ex;
        }
    }

    public function mapeo($value){

        $daoStudent = daoStudents::getInstance();
   
        $cuenta = new Cuenta();
        $cuenta->setId($value["id"]);
        $cuenta->setEmail($value["email"]);
        $cuenta->setPassword($value["password"]);
        $cuenta->setPrivilegios($value["privilegios"]);
        $cuenta->setStudent($daoStudent->getByIdCuenta($cuenta->getId()));

        return $cuenta;
    }

    public function exist($email){
        try{
            $sql = "SELECT exists ( SELECT * from cuentas where email = :email);";

            $this->connection = connection::GetInstance();

            $result = $this->Execute($sql);

            $rta = ($result[0][0] != 1)? false : true;

            return $rta;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }


    
}
?>