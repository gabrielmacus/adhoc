<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 01:56 PM
 */

namespace DAO;


class CoreDAO
{

    protected  $db;
    protected $table;



    function __construct($db,$table)
    {
        $this->db=$db;
        $this->table=$table;
    }

    function read($object=array(),$sqlExtra="")
    {

        
        $sql="SELECT * FROM {$this->table}";

        if(count($object)>0)
        {
            $sql.=" WHERE ";

            foreach ($object as $k=>$v)
            {
                $sql.=" {$k}={$v} AND";
            }
            $sql = rtrim($sql,"AND");
        }
        $sql.=" {$sqlExtra}";
        

        if($res=  $this->db->query($sql))
        {

            $result= $res->fetch_all(1);
        }
        else
        {
            $result=false;
        }


        return $result;
    }
    
    function upsert($object ,ArchivoDAO $archivoData=null)
    {

        $files = $_FILES;

        $keys= implode(",",array_keys($object));

        $sql ="INSERT INTO {$this->table}  ({$keys}) values ";

        $query="";

        $updateQuery="";

        foreach ($object as $k=>$v)
        {
            if($v=='')
            {
                $v="NULL";

            }
            else
            {
                $v="'{$v}'";
            }
            $query.="{$v},";
            $updateQuery.="{$k}={$v},";
        }


        $updateQuery = rtrim($updateQuery,",");

        $query= rtrim($query,",");

        $sql.="({$query}) ON DUPLICATE KEY UPDATE $updateQuery";


        $res=$this->db->query($sql);

        if($res)
        {
            $res =$this->db->insert_id;
        }
        else{
            $res=false;
        }


        if(count($files)>0)
        {

            if($archivoData)
            {
                $uploadedFiles=  $archivoData->upload($files);
               $filesSql="INSERT INTO repositorio (archivo,tabla,objeto) VALUES ";
                $values="";
                foreach($uploadedFiles as $file)
                {
                    $values.="({$file},'{$this->table}',{$res}),";


                }
                $values = rtrim($values,",");

                $filesSql.=$values;
                if(!$this->db->query($filesSql))
                {
                    $res=false;
                }

            }



        }

            return $res;

    }

    function delete($object)
    {
        $sql ="DELETE FROM {$this->table} WHERE ";

        foreach ($object as $k=>$v)
        {

            $sql.=" {$k}='{$v}' AND";
        }
        $sql= rtrim($sql,"AND");

        $res=$this->db->query($sql);

        return $res;


    }
}