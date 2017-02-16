<?php
require("/includes/autoload.php");
$equipos = new \DAO\EquipoDAO($db,"equipos");

$id = $_GET["id"];
if(is_numeric($id))
{
    $equipo=  json_encode($equipos->read(
        array(
            "equipo_id"=>$id
        )
    )[0]);
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

            echo $equipos->upsert($_POST);
            $db->commit();

            break;
    }
}
