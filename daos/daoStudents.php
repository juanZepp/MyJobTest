<?php

namespace daos;

require_once("config/autoload.php");

use PDOExceptions;
use models\Student as student;
use daos\connection as connection;

class daoStudents implements Idao{
    private $connection;
    private static $instance = null;

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
            $sql = "UPDATE students set email = :email, password = :password where studentId = :studentId;";
            $parameters['email'] = $student->getEmail();
            $parameters['password'] = $student->getPassword();

            $this->connection = connection::GetInstance();

            $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function exist($email){
        try{
            $sql = "SELECT exists ( SELECT * from students where email = :email);";

            $this->connection = connection::GetInstance();

            $result = $this->Execute($sql);

            $rta = ($result[0][0] != 1)? false : true;

            return $rta;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    // Usar DaoStudents como recolector de la API
    public function updateFromApi(){
        $listStudent = $this->studentsFromApi();
        foreach($listStudent as $student){
            if(!($this->exist($student->getDni()))){
                $this->add($student);
            }
        }
    }
    
    //Devuelve un arreglo de Students que vienen de la API
    private function studentsFromApi(){
        // averiguar que hago con los atributos password y privilegios
        $opciones = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"));
        $contexto = stream_context_create($opciones);
        $api_url = "https://utn-students-api.herokuapp.com/api/Student";
        $api_json = file_get_contents($api_url, false, $contexto);
        $api_array = ($api_json) ? json_decode($api_json, true) : array();

        $listStudent = array();

        foreach ($api_array as $value) {
            $student = new Student();

            $student->setStudentId($value["studentId"]);
            $student->setCareerId($value["careerId"]);
            $student->setFirstName($value["firstName"]);
            $student->setLastName($value["lastName"]);
            $student->setDni($value["dni"]);
            $student->setFileNumber($value["fileNumber"]);
            $student->setGender($value["gender"]);
            $student->setBirthDate($value["birthDate"]);
            $student->setEmail($value["email"]);
            $student->setPhoneNumber($value["phoneNumber"]);
            $student->setActive($value["active"]);

            array_push($listStudent, $student);
        }

        return $listStudent;
    }

    public function getById($studentId){
        try{
            $sql = "SELECT * from students where studentId = :studentId;";

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
            $sql = "SELECT * from students where dni = :dni;";

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
    
    public function getByEmail($email){
        try{
            $sql = "SELECT * from students where email = :email;";

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
            $sql = "SELECT * from students;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);
        
            return $array;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function add($student){

        if($student instanceof Student){
            try{
                // password y privilegios?
                $sql = "INSERT into students (studentId, careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, password, phoneNumber, active, privilegios) 
                values (:studentId, :careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :password, :phoneNumber, :active, :privilegios);";

                $parameters['studentId'] = $student->getStudentId();
                $parameters['careerId'] = $student->getCareerId();
                $parameters['firstName'] = $student->getFirstName();
                $parameters['lastName'] = $student->getLastName();
                $parameters['dni'] = $student->getDni();
                $parameters['fileNumber'] = $student->getFileNumber();
                $parameters['gender'] = $student->getGender();
                $parameters['birthDate'] = $student->getBirthDate();
                $parameters['email'] = $student->getEmail();
                $parameters['password'] = $student->getPassword();
                $parameters['phoneNumber'] = $student->getPhoneNumber();
                $parameters['active'] = $student->getActive();
                $parameters['privilegios'] = $student->getPrivilegios();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($sql, $parameters);
            }catch (Exception $ex){
                throw $ex;
            }
        }
    }

    //posiblemente no ande
    public function toArray($student, $type = 0){
        $parameters = array();

        if($student instanceof Student){
            if($type == 0){
                $parameters['dni'] = $student->getDni();
            }

            $parameters['studentId'] = $student->getStudentId();
            $parameters['careerId'] = $student->getCareerId();
            $parameters['firstName'] = $student->getFirstName();
            $parameters['lastName'] = $student->getLastName();
            $parameters['fileNumber'] = $student->getFileNumber();
            $parameters['gender'] = $student->getGender();
            $parameters['birthDate'] = $student->getBirthDate();
            $parameters['email'] = $student->getEmail();
            $parameters['password'] = $student->getPassword();
            $parameters['phoneNumber'] = $student->getPhoneNumber();
            $parameters['active'] = $student->getActive();
            $parameters['privilegios'] = $student->getPrivilegios();
            
        }
        return $parameters;
    }
    
    public function mapeo($value){
   
        $student = new Student();
        $student->setStudentId($value["studentId"]);
        $student->setCareerId($value["careerId"]);
        $student->setFirstName($value["firstName"]);
        $student->setLastName($value["lastName"]);
        $student->setDni($value["dni"]);
        $student->setFileNumber($value["fileNumber"]);
        $student->setGender($value["gender"]);
        $student->setBirthDate($value["birthDate"]);
        $student->setEmail($value["email"]);
        $student->setPassword($value["password"]);
        $student->setPhoneNumber($value["phoneNumber"]);
        $student->setActive($value["active"]);
        $student->setPrivilegios($value["privilegios"]);

        return $student;
    }
}
?>