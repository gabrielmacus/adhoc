<?php
require("/includes/autoload.php");

require("check-login.php");
$action="list";
$site="jugadores";

$id=$_GET["id"];

if(!is_numeric($id) && !empty($id))
{
    header("Location:");
    exit();
}



$jugadores = new \DAO\JugadorDAO($db,"jugadores");

if(isset($id))
{
    $dataToSkin=  $jugadores->read(array(
        "jugador_id"=>$id
    ));
}
else
{
    $dataToSkin=  $jugadores->read();
}

require ("/includes/templates/estructura.php");