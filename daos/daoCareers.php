<?php

namespace daos;

require_once("config/autoload.php");

use PDOExceptions;
use models\Career as career;
use daos\connection as connection;

class daoCareers implements Idao{
    private $connection;
    private static $instance = null;

    private function __construct(){
    }

    public static function GetInstance(){
        if(self::$instance == null){
            self::$instance = new DaoCareers();
        }
        return self::$instance;
    }

    //Devuelve un arreglo de Students que vienen de la API
    private function careersFromApi(){
        // averiguar que hago con los atributos password y privilegios
        $opciones = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"));
        $contexto = stream_context_create($opciones);
        $api_url = "https://utn-students-api.herokuapp.com/api/Career";
        $api_json = file_get_contents($api_url, false, $contexto);
        $api_array = ($api_json) ? json_decode($api_json, true) : array();

        $listCareer = array();

        foreach ($api_array as $value) {
            $career = new Career();

            $career->setCareerId($value["careerId"]);
            $career->setDescription($value["description"]);
            $career->setActive($value["active"]);

            array_push($listCareer, $career);
        }

        return $listCareer;
    }

    public function updateFromApi(){
        $listCareer = $this->careersFromApi();
        foreach($listCareer as $career){
            if(!($this->exist($career->getById()))){
                $this->add($career);
            }
        }
    }

    public function getById($careerId){
        try{
            $sql = "SELECT * from careers where careerId = :careerId;";

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

    public function mapeo($value){
   
        $career = new Career();
        $career->setCareerId($value["careerId"]);
        $career->setDescription($value["description"]);
        $career->setActive($value["active"]);

        return $career;
    }

    public function getAll(){
        try{
            $sql = "SELECT * from careers;";

            $this->connection = connection::GetInstance();

            $result = $this->connection->Execute($sql);

            $array = $this->mapeo($result);
        
            return $array;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function add($career){

        if($career instanceof Career){
            try{
                $sql = "INSERT into careers (careerId, description, active) 
                values ( :careerId, :description, :active);";

                $parameters['careerId'] = $career->getCareerId();
                $parameters['description'] = $career->getDescription();
                $parameters['active'] = $career->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($sql, $parameters);
            }catch (Exception $ex){
                throw $ex;
            }
        }
    }

    //posiblemente no ande
    public function toArray($career, $type = 0){
        $parameters = array();

        if($career instanceof Career){
            if($type == 0){
                $parameters['careerId'] = $career->getById();
            }

            $parameters['careerId'] = $career->getCareerId();
            $parameters['description'] = $career->getDescription();
            $parameters['active'] = $career->getActive();
            
        }
        return $parameters;
    }

}
?>