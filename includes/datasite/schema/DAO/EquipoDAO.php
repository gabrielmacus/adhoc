<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 04:25 PM
 */

namespace DAO;


class EquipoDAO extends CoreDAO
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

    function read($object =array(),$sqlExtra="")
    {

        $result=array();

        $sql="SELECT * FROM equipos_view ";

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


                $result[$item["equipo_id"]]["equipo_id"]=$item["equipo_id"];
                $result[$item["equipo_id"]]["equipo_nombre"]=$item["equipo_nombre"];
                $result[$item["equipo_id"]]["equipo_bandera"]=$item["equipo_bandera"];

                foreach ($item as $clave =>$valor)
                {
                    switch ($clave)
                    {
                        case 'jugador_id':


                            if($item["jugador_id"])
                            {
                                $jugador["jugador_nombre"]=$item["jugador_nombre"];
                                $jugador["jugador_apellido"]=$item["jugador_apellido"];
                                $jugador["jugador_altura"]=$item["jugador_altura"];
                                $jugador["jugador_peso"]=$item["jugador_peso"];
                                $jugador["jugador_pierna"]=$item["jugador_pierna"];
                                $jugador["jugador_notas"]=$item["jugador_notas"];
                                $jugador["jugador_equipo"]=$item["jugador_equipo"];
                                $jugador["jugador_posicion"]=$item["jugador_posicion"];
                                $jugador["jugador_numero"]=$item["jugador_numero"];
                                $jugador["jugador_id"]=$item["jugador_id"];

                                $result[$item["equipo_id"]]["jugadores"][$item["jugador_id"]]=$jugador;
                            }

                            break;

                        case 'archivo_id':

                            if($item["archivo_id"]) {

                                $archivo["archivo_id"]=$item["archivo_id"];
                                $archivo["archivo_data"]=$item["archivo_data"];
                                $archivo["archivo_repositorio"]=$item["archivo_repositorio"];

                                $result[$item["equipo_id"]]["archivos"][$item["archivo_id"]]=$archivo;


                            }

                            break;
                    }
                }


            }

        }
        else
        {
            $result=false;
        }


        return $result;

    }

}