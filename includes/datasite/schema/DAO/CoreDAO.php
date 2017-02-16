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

    function read($object=array())
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
    
    function upsert($object)
    {

        $sql ="REPLACE INTO {$this->table} SET ";


        foreach ($object as $k=>$v)
        {
            $sql.="{$k}='{$v}',";
        }


        $sql= rtrim($sql,",");


        $res=$this->db->query($sql);

        if($res)
        {
            $res =$this->db->insert_id;
        }

        echo $this->db->error;

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