<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 04:25 PM
 */

namespace DAO;


class RepositorioDAO extends CoreDAO
{

    public function __construct($db, $table)
    {
        parent::__construct($db, $table);
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
/*INSERT INTO `repositorios`(`repositorio`, `pass`, `user`, `server`, `dns`, `dir`, `dateformat`, `root_dir`, `formats`) VALUES (1,"sercan02","sub697_26","184.154.92.174","http://electrostyleinformatica.com","/imagenes","/d/m/Y","/httpdocs","mp4,avi")*/
   $repositorios =  parent::read($object,$sqlExtra);
        $array = array();
       foreach($repositorios as $rep)
       {

           $rep["formats"]=explode(",",$rep["formats"]);
           $array[$rep["repositorio"]]=$rep;

       }
        return $array;
    }

}