<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 01:13 PM
 */


require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Archivo/IArchivo.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Archivo/Archivo.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/DataSource.php");


class ArchivoDAO implements IArchivo
{

    protected $dataSource;
    protected $tableName;
    protected $users;

    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct($dataSource, $tableName="archivos")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
    }

    public function insertArchivo(Archivo $a)
    {
        // TODO: Implement insertArchivo() method.
    }

    public function selectArchivos()
    {
        // TODO: Implement selectArchivos() method.
    }

    public function selectArchivoById($id)
    {
        // TODO: Implement selectArchivoById() method.
    }

    public function updateArchivos(Archivo $a)
    {
        // TODO: Implement updateArchivos() method.
    }

    public function deleteArchivoById($id)
    {
        // TODO: Implement deleteArchivoById() method.
    }


}