<?php
require("/includes/autoload.php");
$jugadores = new \DAO\JugadorDAO($db,"jugadores");

$id = $_GET["id"];
if(is_numeric($id))
{
    $jugador=  json_encode($jugadores->read(
    array(
        "jugador_id"=>$id
    )
    )[0]);
}

if(!isset($_GET["act"]))
{
    $action="add";
    $site="jugadores";


    require ("/includes/templates/estructura.php");
}
else
{

    switch ($_GET["act"])
    {
        case 'add':




            $archivoDAO=new \DAO\ArchivoDAO($db,"archivos",$config["imagenes"],1);


           echo  json_encode($jugadores->upsert($_POST,$archivoDAO));
           $db->commit();


            break;

   
    }
}
