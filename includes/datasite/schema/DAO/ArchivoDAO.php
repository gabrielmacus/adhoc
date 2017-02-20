<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 04:25 PM
 */

namespace DAO;


class ArchivoDAO extends CoreDAO
{

    protected $config;
    protected  $repositorio;
    public function __construct($db, $table,$config,$repositorio)
    {

        $this->config =$config;
        $this->repositorio =$repositorio;

        parent::__construct($db, $table);



    }

    function upload($object)
    {
        $dia =date("d");
        $mes = date("m");
        $anio =date("Y");

        $files =uploadFiles($object,"/public_html/imagenes/{$anio}/{$mes}/{$dia}",$this->config);

        $uploadedFiles=array();

            foreach($files["success"] as $file)
            {
                $file=json_encode($file);
                $archivo = array(
                    "archivo_repositorio"=>$this->repositorio,
                    "archivo_data"=>$file
                );

                $uploadedFiles[]= $this->upsert($archivo);//parent::upsert($archivo);
            }

            return $uploadedFiles;


    }
    function upsert($object,ArchivoDAO $archivoData=null)
    {
        return parent::upsert($object,$archivoData);
    }

    function delete($object)
    {
        return parent::delete($object);
    }

    function read($object =array(),$sqlExtra="")
    {

        return parent::read($object,$sqlExtra);

    }

}