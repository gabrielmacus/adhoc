<?php
require("includes/autoload.php");



$id = $_GET["id"];

if(!$id)
{


$territorios = new TerritorioDAO($db,"territorios");

}



if(is_numeric($id))
{
    $territorios = new TerritorioDAO($db,"territorios");


    $territorio=$territorios->read(
        array(
            "territorio_id"=>$id
        )
    );
}



    switch ($_GET["act"])
    {
        case 'add':


            $filesDao = new \DAO\ArchivoDAO($db,"archivos",$repositorios[5]);

         
            echo json_encode($territorios->upsert($_POST,$filesDao));

            break;
        case 'delete':

            echo  json_encode($territorios->delete(
                $_POST
            ));


            break;
    }

    $db->commit();

