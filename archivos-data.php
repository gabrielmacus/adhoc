<?php
require("/includes/autoload.php");


$repositorio=$config["repositorios"][$_GET["rep"]];
if(!$repositorio)
{
    return false;
}

$archivos = new \DAO\ArchivoDAO($db,"archivos",$repositorio);

$id = $_GET["id"];





if(is_numeric($id))
{

    $archivo=$archivos->read(
        array(
            "archivo_id"=>$id
        )
    )[$id];

    $archivo=  json_encode($archivo);
}


if(!isset($_GET["act"]))
{
    $action="add";
    $site="archivos";


    require ("/includes/templates/estructura.php");
}
else
{

    switch ($_GET["act"])
    {
        case 'add':



            echo json_encode($archivos->upload($_FILES));


            break;
        case 'delete':

            echo  json_encode($archivos->delete(
             $_POST
            ));


            break;
    }

    $db->commit();
}
