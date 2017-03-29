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

    private $updateSql;
    private $insertSql;
    private $deleteSql;
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

        $this->updateSql="UPDATE {$this->tableName} SET
archivo_id=:archivo_id, archivo_size=:archivo_size,archivo_mime=:archivo_mime, archivo_name=:archivo_name, 
 archivo_extension=:archivo_extension, archivo_creation=:archivo_creation, 
 archivo_modification=:archivo_modification,archivo_repositorio=:archivo_repositorio,archivo_path=:archivo_path
 ,archivo_version=:archivo_version,archivo_real_name=:archivo_real_name,archivo_version_name=:archivo_version_name,
 ,archivo_alto=:archivo_alto,archivo_ancho=:archivo_ancho,archivo_type=:archivo_type
   WHERE archivo_id=:archivo_id OR archivo_version=:archivo_id ";

        $this->insertSql="INSERT INTO  {$this->tableName} 
 (archivo_id, archivo_size, archivo_mime,archivo_name, archivo_extension,
   archivo_creation, archivo_modification,archivo_repositorio,archivo_path,archivo_version,
   archivo_real_name,archivo_version_name,archivo_alto,archivo_ancho,archivo_type)
 VALUES (:archivo_id, :archivo_size,:archivo_mime, :archivo_name, 
 :archivo_extension, :archivo_creation, 
 :archivo_modification,:archivo_repositorio,:archivo_path,:archivo_version,:archivo_real_name,:archivo_version_name,:archivo_ancho,:archivo_alto,:archivo_type)";

        $this->deleteSql="DELETE FROM {$this->tableName} WHERE archivo_id= :archivo_id OR archivo_version= :archivo_id";

    }


    public function insertArchivo(IArchivo $a,$versionName="original",$versionId=0)
    {


        $this->validate($a);

        $r =     $a->getRepositorio();
        $ftp  =$r->getFtp();

        $fileName = time().".{$a->getExtension()}"; //Nombre de la carpeta contenedora de todas las versiones

        $dir=$r->getDatePath()."{$fileName}"; //Directorio donde estan todas las versiones

        if(!$ftp->isDir($dir))//Chequeo si no existe el directorio, en tal caso lo creo
        {
            $ftp->mkdir($dir,true);   
        }


        $fileNameVersion = time()."_{$versionName}.{$a->getExtension()}";//Nombre del archivo con su version
        $fullDir = $dir."/{$fileNameVersion}"; //Directorio completo, nombre del archivo includio


        if(!$ftp->put($fullDir,$a->getTmpPath(),FTP_BINARY))
        {
            throw new Exception("ArchivoDAO:0");
        }

            $a->setVersion($versionId);


        $a->setRealName($fullDir);
        $a->setVersionName($versionName);


        $sql = $this->insertSql;

        if(!$a->getCreation())
        {
            $a->setCreation(time());
        }
        if(!$a->getModification())
        {
            $a->setModification(time());
        }
        
        $a->setPath($dir);

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($a));
        return $res;
    }

    public function selectArchivos()
    {

        $sql = "SELECT * FROM {$this->tableName} LEFT JOIN repositorios ON repositorio_id=archivo_repositorio";


        $this->dataSource->runQuery($sql,array(),function($data){

            $r =new Repositorio($data["repositorio_host"],$data["repositorio_user"],
                $data["repositorio_pass"],$data["repositorio_name"], $data["repositorio_path"],
                $data["repositorio_port"],$data["repositorio_creation"],
                $data["repositorio_modification"],$data["repositorio_id"]);


            $a = new Archivo($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
                $data["archivo_version"],$data["archivo_real_name"],null,$r,
                $data["archivo_path"],$data["archivo_creation"],
                $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"],$data["archivo_type"]);
            array_push($this->files, $a);


        });

        return $this->files;


    }

    public function selectArchivoByVersions($id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_id=:archivo_id OR archivo_version=:archivo_id";


        $this->dataSource->runQuery($sql,array(":archivo_id"=>$id),
            function($data){
            $this->query($data);
            });

        return $this->files;

    }

    /**
     * @param $data
     * Funcion para indicarle como leer el objeto de la db
     */
    private function query($data){


        $repositorioDAO = new RepositorioDAO($this->dataSource);

        $repositorio=$repositorioDAO->selectRepositorioById($data["archivo_repositorio"]);

        $a = new Archivo($data["archivo_size"],$data["archivo_name"],$data["archivo_mime"],
            $data["archivo_version"],$data["archivo_real_name"],null,$repositorio,
            $data["archivo_path"],$data["archivo_creation"],
            $data["archivo_modification"],$data["archivo_id"],$data["archivo_version_name"]);
        array_push($this->files, $a);

    }


    protected function getParamsArray(Archivo $a)
    {

        $ancho =null;
        $alto=null;

        if(method_exists($a,"getAncho"))//si el objeto Archivo es una Imagen
        {
            $ancho = $a->getAncho();
            $alto =$a->getAlto();
        }
        return array(
            ":archivo_id"=>$a->getId(),
            ":archivo_size"=>$a->getSize(),
            ":archivo_name"=>$a->getName(),
            ":archivo_extension"=>$a->getExtension(),
            ":archivo_mime"=>$a->getMime(),
            ":archivo_creation"=>$a->getCreation(),
            ":archivo_modification"=>$a->getModification(),
            ":archivo_repositorio"=>$a->getRepositorio()->getId(),
            ":archivo_path"=>$a->getPath(),
            ":archivo_version"=>$a->getVersion(),
            ":archivo_real_name"=>$a->getRealName(),
            ":archivo_version_name"=>$a->getVersionName(),
            ":archivo_ancho"=>$ancho,
            ":archivo_alto"=>$alto,
            ":archivo_type"=>$a->getType()
        );
    }


    /**
     * @param $id
     * @return Archivo
     */
    public function selectArchivoById($id)
    {

        $sql = "SELECT * FROM {$this->tableName} WHERE archivo_id=:archivo_id";

        $this->dataSource->runQuery($sql,array(":archivo_id"=>$id),function($data){
            $this->query($data);
        });

        return $this->files[0];


    }

    public function updateArchivo(IArchivo $a)
    {

        $this->validate($a);

        $sql=$this->updateSql;


        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($a));
        return $res;

    }


    public function deleteArchivoById($id)
    {
       $archivos=$this->selectArchivoByVersions($id);

       $ftp=$archivos[0]->getRepositorio()->getFtp();

        foreach ($archivos as $archivo)
        {
            if(!$ftp->remove($archivo->getRealName()))//Elimino cada archivo
            {
                throw new Exception("ArchivoDAO:1");//Codigo de error al eliminar un archivo
            }
        }

        if(!$ftp->rmdir($archivos[0]->getPath()))//Elimino la carpeta
        {
            throw new Exception("ArchivoDAO:2");//Codigo de error al eliminar una carpeta
        }

        $ftp->close();

        $sql = $this->deleteSql;

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":archivo_id"=>$id
            ));
        return $res;
    }

    public function validate(IArchivo $a)
    {
        // TODO: Implement validate() method.
    }


}