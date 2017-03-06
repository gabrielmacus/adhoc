<?php
require("includes/autoload.php");



$id = $_GET["id"];

$manzanas = new \DAO\ManzanaDAO($db,"manzanas");
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


            $manzanasJSON = json_decode($_POST["territorio_polygons"],true);

            unset($_POST["territorio_polygons"]);

            $territorio=$territorios->upsert($_POST,$filesDao);

            foreach($manzanasJSON as $manzana)
            {

                if(!$manzana["delete"])
                {
                    $manzanas->insert(array(

                        "manzana_polygon"=>json_encode($manzana),
                        "manzana_territorio"=>$territorio

                    ));
                }
                else
                {
                    $manzanas->delete(
                        array("manzana_id"=>$manzana["manzana_id"])
                    );
                }

            }

           echo json_encode($territorio);

            break;
        case 'delete':

            
            echo  json_encode($territorios->delete(
                $_POST
            ));


            break;
    }

    $db->commit();

