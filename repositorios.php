<?php
require("/includes/autoload.php");

$action="list";
$site="repositorios";
$sqlExtra =" ORDER BY archivo_repositorio";
$id=$_GET["id"];

if(!is_numeric($id) && !empty($id))
{
    header("Location:");
    exit();
}




$archivos = new \DAO\ArchivoDAO($db,"archivos");

if(isset($id))
{
    $dataToSkin=  $archivos->read(array(
        "archivo_repositorio"=>$id
    ),$sqlExtra);
}
else
{
    $dataToSkin=  $archivos->read(array(),$sqlExtra);
}

require ("/includes/templates/estructura.php");