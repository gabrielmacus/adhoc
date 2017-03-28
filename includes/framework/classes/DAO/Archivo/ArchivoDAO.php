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
    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     *
     */
    public function __construct(DataSource $dataSource, $tableName="archivos")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;

    }


    public function insertArchivo(Archivo $a)
    {

        $r =     $a->getRepositorio();
        $ftp = new \FtpClient\FtpClient();
        $ftp=$ftp->connect($r->getHost(),false,$r->getPort());
        $ftp=$ftp->login($r->getUser(),$r->getPass());

        $fileName = time().".{$a->getExtension()}"; //Nombre de la carpeta contenedora de todas las versiones

        $dir=$r->getDatePath()."{$fileName}"; //Directorio donde estan todas las versiones

        $ftp->mkdir($dir,true);


        $fileNameVersion = time()."_original.{$a->getExtension()}";//Nombre del archivo con su version
        $fullDir = $dir."/{$fileNameVersion}"; //Directorio completo, nombre del archivo includio

        if(!$ftp->put($fullDir,$a->getTmpPath(),FTP_BINARY))
        {
            return array("success"=>false,"error"=>true,"info"=>"Error uploading {$a->getName()}");
        }


        $sql = "INSERT INTO  {$this->tableName} 
 (archivo_id, archivo_size, archivo_mime,archivo_name, archivo_extension,
   archivo_creation, archivo_modification, archivo_versions,archivo_repositorio,archivo_path)
 VALUES (:archivo_id, :archivo_size,:archivo_mime, :archivo_name, 
 :archivo_extension, :archivo_creation, 
 :archivo_modification,:archivo_versions,:archivo_repositorio,:archivo_path)";

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
                ":archivo_creation"=>$a->getCreation(),
                ":archivo_modification"=>$a->getModification(),
                ":archivo_versions"=>$a->getVersions(),
                ":archivo_repositorio"=>$a->getRepositorio()->getId(),
                ":archivo_path"=>$dir
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