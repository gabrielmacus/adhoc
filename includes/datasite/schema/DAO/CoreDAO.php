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
    protected $idField;


    function __construct($db,$table)
    {
        $this->db=$db;
        $this->table=$table;
        $res=$db->query("SHOW KEYS FROM {$this->table} WHERE Key_name = 'PRIMARY'");

 
        $this->idField=$res->fetch_all(true)[0]["Column_name"];

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

   protected function update($object)
    {
        $sql = "UPDATE {$this->table} SET ";

        foreach ($object as $k=>$v)
        {
            $sql.="{$k}='{$v}',";
        }
        $sql = rtrim($sql,",");
        $sql.=" WHERE {$this->idField}={$object[$this->idField]}";

        if($this->db->query($sql))
        {
            return $object[$this->idField];
        }
            return false;
    }

    function insert($object)
    {
        $keys= implode(",",array_keys($object));

        $sql ="INSERT INTO {$this->table}  ({$keys}) values ";

        $query="";



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
        }


        $query= rtrim($query,",");
        $sql.="({$query})";

       if( $this->db->query($sql))
        {

            return $this->db->insert_id;
        }

        return false;

    }

    function upsert($object ,ArchivoDAO $archivoData=null)
    {

        $files = $_FILES;

        if($object[$this->idField])
        {
           $res= $this->update($object);
        }
        else
        {
            $res=  $this->insert($object);
        }




        if(count($files)>0)
        {

            if($archivoData)
            {
                $uploadedFiles=  $archivoData->upload($files);
               $filesSql="INSERT INTO archivos_objetos (archivo,tabla,objeto) VALUES ";
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


        /*if($archivoData)
        {
            return $filesSql;
        }*/

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

        if($res)
        {
            $res=true;
        }
        return $res;


    }
}