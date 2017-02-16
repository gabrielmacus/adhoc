<?php
require("/includes/autoload.php");

$site="equipos";
$action ="list";

$id=$_GET["id"];

if(!is_numeric($id) && !empty($id))
{
     header("Location:");
     exit();
}

$equipos = new \DAO\EquipoDAO($db,"equipos");

if(isset($id))
{
   $dataToSkin=  $equipos->read(array(
        "equipo_id"=>$id
   ));

}
else
{
     $dataToSkin=  $equipos->read();
}





require ("/includes/templates/estructura.php");