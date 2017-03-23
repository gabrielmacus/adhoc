<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 01:13 PM
 */


require_once ($_SERVER["DOCUMENT_ROOT"]."/ad-hoc/includes/framework/classes/DAO/Usuario/IUsuario.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/ad-hoc/includes/framework/classes/DAO/Usuario/Usuario.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/ad-hoc/includes/framework/classes/DAO/DataSource.php");
class PersonaDAO implements IPersona
{

    protected $dataSource;

    protected $personas= array();

    function __construct(DataSource $dataSource)
    {
        $this->dataSource=$dataSource;

    }

    public function insertPersona(Persona $p)
    {
        $sql = "INSERT INTO personas (persona_name,persona_surname,persona_age) VALUES (:persona_name,:persona_surname,:persona_age)";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":persona_name"=>$p->getName(),
                ":persona_surname"=>$p->getSurname(),
                ":persona_age"=>$p->getAge()
            ));
        return $res;
    }

    public function selectPersonas()
    {

        $sql = "SELECT * FROM personas";


        $res= $this->dataSource->runQuery($sql,array(),function($data){

            $p=new Persona($data["persona_name"],$data["persona_surname"],$data["persona_age"],$data["persona_id"]);
            array_push($this->personas, $p);


        });

        if($res)
        {
            return $this->personas;
        }
        return $res;
    }

    public function selectPersonaById($id)
    {
        $sql = "SELECT * FROM personas WHERE persona_id=:persona_id";


        $res= $this->dataSource->runQuery($sql,array(":persona_id"=>$id),function($data){

            $p=new Persona($data["persona_name"],$data["persona_surname"],$data["persona_age"],$data["persona_id"]);
            array_push($this->personas, $p);


        });

        if($res)
        {
            return $this->personas;
        }
        return $res;

    }

    public function updatePersona(Persona $p)
    {
        $sql = "UPDATE personas SET persona_name = :persona_name,persona_surname=:persona_surname,persona_age=:persona_age) WHERE persona_id= :persona_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":persona_name"=>$p->getName(),
                ":persona_surname"=>$p->getSurname(),
                ":persona_age"=>$p->getAge(),
                ":persona_id"=>$p->getId()
            ));
        return $res;
    }

    public function deletePersonaById($id)
    {
        $sql = "DELETE FROM personas WHERE persona_id= :persona_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":persona_id"=>$id
            ));
        return $res;
    }


}