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

    function setConfig($config)
    {
        $this->config =$config;
    }
    function upload($object)
    {


        $dir=$this->config["dir"];
        if($this->config["dateformat"])
        {
            $dir.=date($this->config["dateformat"]);
        }
        $files =uploadFiles($object,$dir,$this->config);

        $uploadedFiles=array();

            foreach($files["success"] as $file)
            {
                
                
                $file=json_encode($file);
                
                $archivo = array(
                    "archivo_repositorio"=>$this->config["repositorio"],
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

        if(deleteDir($object["dir"],$this->config))
        {
            unset($object["dir"]);
            return parent::delete($object);
        }
        return false;
        


    }

    function read($object =array(),$sqlExtra="")
    {

        $result=array();

        $sql="SELECT * FROM archivos ";

        if(count($object)>0)
        {
            $sql.=" WHERE ";

            foreach ($object as $k=>$v)
            {
                $sql.=" {$k}={$v} AND";
            }
            $sql = rtrim($sql,"AND");
        }

        if($res=  $this->db->query($sql))
        {

            $res= $res->fetch_all(1);

            foreach ($res as $item)
            {


                $result[$item["archivo_repositorio"]][$item["archivo_id"]]["archivo_id"]=$item["archivo_id"];
                $result[$item["archivo_repositorio"]][$item["archivo_id"]]["archivo_data"]=$item["archivo_data"];
                $result[$item["archivo_repositorio"]][$item["archivo_id"]]["archivo_repositorio"]=[$item["archivo_repositorio"]];


            }

        }
        else
        {
            $result=false;
        }


        return $result;

    }

}