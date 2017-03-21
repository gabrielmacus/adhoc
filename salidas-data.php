<?php
require("includes/autoload.php");


$DAO = new \DAO\SalidaDAO($db, "salidas");


switch ($_GET["act"])
{
    case 'add':
    case 'edit':



        $territoriosDAO = new \DAO\CoreDAO($db,"salidas_territorios");

        $territorios=$_POST["salida_territorios"];

        unset($_POST["salida_territorios"]);


        $res=$DAO->upsert($_POST);

        if($res)
        {
            $salidasTerritorio=array();
            foreach ($territorios as $k=>$v)
            {
                $salidasTerritorio[]= array(
                "territorio"=>$v,
                "salida"=>$res
            );
           }
            $territoriosDAO->upsert(array("array"=>$salidasTerritorio));


        }


    echo json_encode($res);
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


