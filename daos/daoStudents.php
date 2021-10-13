<?php

namespace daos;

use PDOExceptions;
use models\Student as student;
use models\cuenta;
use daos\connection as connection;

class daoStudents implements Idao{
    private $connection;
    private static $instance = null;
    const idCuenta = "idCuenta";

    private function __construct(){
    }

    public static function GetInstance(){
        if(self::$instance == null){
            self::$instance = new DaoStudents();
        }
        return self::$instance;
    }

    public function update($student){
        try{
            // studentid, careerId?
            $sql = "UPDATE student set firstName = :firstName, lastName = :lastName, dni = :dni, fileNumber = :fileNumber, gender = :gender, birthday = :birthday, phoneNumber = :phoneNumber, active = :active where studentId = :studentId;";
            $parameters['firstName'] = $student->getFirstName();
            $parameters['lastName'] = $student->getLastName();
            $parameters['dni'] = $student->getDni();
            $parameters['fileNumber'] = $student->getFileNumber();
            $parameters['gender'] = $student->getGender();
            $parameters['birthday'] = $student->getBirthday();
            $parameters['phoneNumber'] = $student->getPhoneNumber();
            $parameters['active'] = $student->getActive();

            $this->connection = connection::GetInstance();

            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function exist($dni){
        try{
            $sql = "SELECT exists ( SELECT * from cuentas where dni = :dni);";

            $this->connection = connection::GetInstance();

            $result = $this->Execute($sql);

            $rta = ($result[0][0] != 1)? false : true;

            return $rta;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByIdCuenta($idCuenta){
        try{
            //student no tiene idCuenta, pero se la creo por const arriba. Sirve???
            $sql = "SELECT * from student where idCuenta = :idCuenta;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getByDni($dni){
        try{
            $sql = "SELECT * from student where dni = :dni;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getAll(){
        try{
            $sql = "SELECT * from student;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);
        
            return $array;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function add($cuenta){
        if(($cuenta instanceof Cuenta) && ($cuenta->getStudent() instanceof Student)){
            try{
                $sql = "INSERT into student (firstName, lastName, dni, fileNumber, gender, birthday, phoneNumber, active) values (:firstName, :lastName, :dni, :fileNumber, :gender, :birthday, :phoneNumber, :active);";
                $parameters = $this->toArray($cuenta->getStudent());
                /* sino probar con:
                $parameters['firstName'] = $student->getFirstName();
                $parameters['lastName'] = $student->getLastName();
                $parameters['dni'] = $student->getDni();
                $parameters['fileNumber'] = $student->getFileNumber();
                $parameters['gender'] = $student->getGender();
                $parameters['birthday'] = $student->getBirthday();
                $parameters['phoneNumber'] = $student->getPhoneNumber();
                $parameters['active'] = $student->getActive();*/

                $parameters['idCuenta'] = $cuenta->getId();
                //sino probar con: $parameters[DaoStudents::COLUMN_IDCUENTA] = $cuenta->getId();
            
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch (Exception $ex){
                throw $ex;
            }
        }
    }

    public function toArray($object, $type = 0){
        $parameters = array();

        if($object instanceof Student){
            if($type == 0){
                $parameters['dni'] = $object->getDni();
            }

            $parameters['firstName'] = $object->getFirstName();
            $parameters['lastName'] = $object->getLastName();
            $parameters['fileNumber'] = $object->getFileNumber();
            $parameters['gender'] = $object->getGender();
            $parameters['birthday'] = $object->getBirthday();
            $parameters['phoneNumber'] = $object->getPhoneNumber();
            $parameters['active'] = $object->getActive();
            
        }
        return $parameters;
    }
    
    public function mapeo($value){
   
        $student = new Student();
        $student->setFirstName($value["firstName"]);
        $student->setLastName($value["lastName"]);
        $student->setDni($value["dni"]);
        $student->setFileNumber($value["fileNumber"]);
        $student->setGender($value["gender"]);
        $student->setBirthday($value["birthday"]);
        $student->setPhoneNumber($value["phoneNumber"]);
        $student->setActive($value["active"]);

        return $student;
    }
}
?>