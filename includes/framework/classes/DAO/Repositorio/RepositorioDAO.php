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
    public function __construct(DataSource $dataSource, $tableName)
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
    }




    public function insertRepositorio(Repositorio $r)
    {
        // TODO: Implement insertRepositorio() method.
    }

    public function selectRepositorios()
    {
        // TODO: Implement selectRepositorios() method.
    }

    public function selectRepositorioById($id)
    {
        // TODO: Implement selectRepositorioById() method.
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
