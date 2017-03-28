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
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/FtpClient/FtpClient.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/FtpClient/FtpException.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/FtpClient/FtpWrapper.php");


class ArchivoDAO implements IArchivo
{

    protected $dataSource;
    protected $tableName;
    protected $files=array();
    protected $ftp;
    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     * @param $ftp
     */
    public function __construct(\FtpClient\FtpClient $ftp,DataSource $dataSource, $tableName="archivos")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
        $this->ftp=$ftp;
    }


    public function insertArchivo(Archivo $a)
    {



        $sql = "INSERT INTO  {$this->tableName} 
 (archivo_id, archivo_size, archivo_name, archivo_extension,
  archivo_mime, archivo_path, archivo_creation, archivo_modification)
 VALUES (:archivo_id, :archivo_size,:archivo_mime, :archivo_name, 
 :archivo_extension, :archivo_path, :archivo_creation, 
 :archivo_modification)";

        if(!$a->getCreation())
        {
            $a->setCreation(time());
        }
        if(!$a->getModification())
        {
            $a->setModification(time());
        }


        $res= $this->dataSource->runUpdate($sql,
            array(
                ":archivo_id"=>$a->getId(),
                ":archivo_size"=>$a->getSize(),
                ":archivo_name"=>$a->getName(),
                ":archivo_extension"=>$a->getExtension(),
                ":archivo_mime"=>$a->getMime(),
                ":archivo_path"=>$a->getPath(),
                ":archivo_creation"=>$a->getCreation(),
                ":archivo_modification"=>$a->getModification()
            ));
        return $res;
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