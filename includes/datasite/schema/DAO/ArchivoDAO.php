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

    public function __construct($db, $table,$config=array())
    {

        $this->config =$config;
        parent::__construct($db, $table);



    }

  function getPager($limit, $actualPage, $paddingPages)
  {
      return parent::getPager($limit, $actualPage, $paddingPages); // TODO: Change the autogenerated stub
  }

    function setConfig($config)
    {
        $this->config =$config;
    }


    function upload($files,$object=false)
    {


        $dir=$this->config["dir"];
        if($this->config["dateformat"])
        {
            $dir.=date($this->config["dateformat"]);
        }

        $files =uploadFiles($files,$dir,$this->config);



        $uploadedFiles=array();


        if($files["success"])
        {
            foreach($files["success"] as $file)
            {

                $file=json_encode($file);

                $archivo = array(
                    "archivo_repositorio"=>$this->config["repositorio"],
                    "archivo_data"=>$file
                );


                if($object)
                { foreach ($object as $k=>$v)
                {
                    $archivo[$k]=$v;
                }


                }


                $uploadedFiles[]= $this->upsert($archivo);//parent::upsert($archivo);
            }
        }



            return $uploadedFiles;


    }
    function upsert($object,ArchivoDAO $archivoData=null)
    {
        return parent::upsert($object,$archivoData);
    }

    function delete($object)
    {

     $object=$this->read($object);

        foreach($object as $k=>$v)
        {
            foreach($v as $clave =>$valor)
            {

                       $folder=$valor["archivo_data"]["folder"];



                        if(deleteDir($folder,$this->config))
                        {




                                 return parent::delete(array($this->idField=>$valor["archivo_id"]));
                        }


            }

        }



        return false;
        


    }

    function process(&$result, $item)
    {


        $result[$item["archivo_repositorio"]][$item["archivo_id"]]["archivo_id"]=$item["archivo_id"];
        $result[$item["archivo_repositorio"]][$item["archivo_id"]]["archivo_data"]=json_decode($item["archivo_data"],true);
        $result[$item["archivo_repositorio"]][$item["archivo_id"]]["archivo_repositorio"]=$item["archivo_repositorio"];
        $result[$item["archivo_repositorio"]][$item["archivo_id"]]["archivo_descripcion"]=$item["archivo_descripcion"];

    }

    function read($object =array(),$sqlExtra="",$offset=0,$limit=false,$joinSql=false)
    {

        return parent::read($object,$sqlExtra,$offset,$limit,$joinSql);

    }

}