<?php
require("includes/autoload.php");


$publicadorDAO = new \DAO\PublicadorDAO($db, "publicadores");


switch ($_GET["act"])
{
    case 'add':
    case 'edit':


        echo json_encode($publicadorDAO->upsert($_POST));

        break;
  
    case 'delete':


        echo  json_encode($publicadorDAO->delete(
            $_POST
        ));


        break;
    case 'list':

        $dataToSkin=$publicadorDAO->read();
        echo  json_encode($dataToSkin);
        



        break;
}
$db->commit();


