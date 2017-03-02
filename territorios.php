<?php
require("includes/autoload.php");

$action="list";
$site="datasite/territorios";
$sqlExtra =" ORDER BY territorio_id";
$id=$_GET["id"];

if(!is_numeric($id) && !empty($id))
{
    header("Location:");
    exit();
}




$territorios =new TerritorioDAO($db,"territorios");

if(isset($id))
{
    $dataToSkin=  $territorios->read(array(
        "territorio_id"=>$id
    ),$sqlExtra);
}
else
{
    $dataToSkin=  $territorios->read(array(),$sqlExtra);
}


require ("includes/templates/comun/estructura.php");