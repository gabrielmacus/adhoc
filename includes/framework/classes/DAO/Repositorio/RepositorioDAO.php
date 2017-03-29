<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 28/03/2017
 * Time: 2:58
 */
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Repositorio/IRepositorio.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Repositorio/Repositorio.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/DataSource.php");

class RepositorioDAO implements IRepositorio
{
    protected $dataSource;
    protected $tableName;
    protected $repositorios=array();

    /**
     * RepositorioDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct(DataSource $dataSource, $tableName="repositorios")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
    }




    public function insertRepositorio(Repositorio $r)
    {
        $sql = "INSERT INTO  {$this->tableName} 
 (repositorio_id,repositorio_name,repositorio_path,repositorio_host,repositorio_user,repositorio_pass,repositorio_port,repositorio_creation,repositorio_modification)
 VALUES (:repositorio_id,:repositorio_name,:repositorio_path,:repositorio_host,:repositorio_user,:repositorio_pass,:repositorio_port,:repositorio_creation,:repositorio_modification)";

        if(!$r->getCreation())
        {
            $r->setCreation(time());
        }
        if(!$r->getModification())
        {
            $r->setModification(time());
        }

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":repositorio_id"=>$r->getId(),
                ":repositorio_name"=>$r->getName(),
                ":repositorio_path"=>$r->getPath(),
                ":repositorio_host"=>$r->getHost(),
                ":repositorio_user"=>$r->getUser(),
                ":repositorio_pass"=>$r->getPass(),
                ":repositorio_port"=>$r->getPort(),
                ":repositorio_creation"=>$r->getCreation(),
                ":repositorio_modification"=>$r->getModification()
            )
        );
        return $res;
    }

    public function selectRepositorios()
    {

        $sql = "SELECT * FROM {$this->tableName}";


        $res= $this->dataSource->runQuery($sql,array(),function($data){

         $r =new Repositorio($data["repositorio_host"],$data["repositorio_user"],
             $data["repositorio_pass"],$data["repositorio_name"], $data["repositorio_path"],
             $data["repositorio_port"],$data["repositorio_creation"],$data["repositorio_creation"],
             $data["repositorio_modification"],$data["repositoro_id"]);
            array_push($this->repositorios, $r);


        });

    return $this->repositorios;
    }

    public function selectRepositorioById($id)
    {

        $sql = "SELECT * FROM {$this->tableName} WHERE repositorio_id=:repositorio_id";


       $this->dataSource->runQuery($sql,array(":repositorio_id"=>$id),function($data){

            $r =new Repositorio($data["repositorio_host"],$data["repositorio_user"],
                $data["repositorio_pass"],$data["repositorio_name"], $data["repositorio_path"],
                $data["repositorio_port"],$data["repositorio_creation"],
                $data["repositorio_modification"],$data["repositorio_id"]);
            array_push($this->repositorios, $r);


        });


        return $this->repositorios[0];

    }

    public function updateRepositorio(Repositorio $r)
    {
        // TODO: Implement updateRepositorio() method.
    }

    public function deleteRepositorioById($id)
    {
        // TODO: Implement deleteRepositorioById() method.
    }


}
