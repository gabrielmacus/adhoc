<?php
require("/includes/autoload.php");
$equipos = new \DAO\EquipoDAO($db,"equipos");



$id = $_GET["id"];
if(is_numeric($id))
{

    $equipo=$equipos->read(
        array(
            "equipo_id"=>$id
        )
    )[$id];

    $equipo=  json_encode($equipo);
}


if(!isset($_GET["act"]))
{
    $action="add";
    $site="equipos";


    require ("/includes/templates/estructura.php");
}
else
{

    switch ($_GET["act"])
    {
        case 'add':

            $archivoDAO=new \DAO\ArchivoDAO($db,"archivos",$config["imagenes"],2);

            echo json_encode($equipos->upsert($_POST,$archivoDAO));
            $db->commit();

            break;
    }
}
