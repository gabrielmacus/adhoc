<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 04:08 PM
 */

namespace DAO;


class JugadorDAO extends CoreDAO
{
    public function __construct($db, $table,$limit=null)
    {
        parent::__construct($db, $table,$limit);
    }


    function upsert($object,ArchivoDAO $archivoData=null)
    {
        return parent::upsert($object,$archivoData);
    }

    function delete($object)
    {
        return parent::delete($object);
    }

    function read($object = array(),$sqlExtra="")
    {

        $sql="SELECT * FROM {$this->table} LEFT JOIN equipos on jugador_equipo=equipo_id";

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


}