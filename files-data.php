<?php
require("includes/autoload.php");


$id = $_GET["id"];

if($id)
{
    if(is_numeric($id)) {
        $archivos = new \DAO\ArchivoDAO($db, "archivos");

        $archivo = $archivos->read(
            array
            (
                "archivo_id" => $id
            )
        );

    }
    else
    {

        echo json_encode(false);
        exit();
    }
    }
else
{
    $repositorio=$repositorios[$_GET["rep"]];
    $archivos =new \DAO\ArchivoDAO($db,"archivos",$repositorio);

    if(!$repositorio)
    {

        echo json_encode(false);
        exit();
    }

}

switch ($_GET["act"])
{
    case 'add':


        echo json_encode($archivos->upload($_FILES,$_POST));

        break;
    case 'edit':
        echo json_encode($archivos->upsert($_POST));

        break;
    case 'delete':


        echo  json_encode($archivos->delete(
            $_POST
        ));


        break;
    case 'list':

        $dataToSkin=$archivos->read();
        if(!$page)
        {
            echo  json_encode($dataToSkin);
        }



        break;
}
$db->commit();


