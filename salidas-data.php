<?php
require("includes/autoload.php");


$DAO = new \DAO\SalidaDAO($db, "salidas");


switch ($_GET["act"])
{
    case 'add':
    case 'edit':


        echo json_encode($DAO->upsert($_POST));

        break;

    case 'delete':


        echo  json_encode($DAO->delete(
            $_POST
        ));


        break;
    case 'list':

        $dataToSkin=$DAO->read();
        echo  json_encode($dataToSkin);




        break;
}
$db->commit();


