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

                if(is_numeric($v["numero"]) || !$v["numero"])
                {

                    $t=array(
                        "territorio"=>$v["numero"],
                        "salida"=>$res
                    );


                    if($v["id"])
                    {
                        $t["salidas_territorios_id"]=$v["id"];
                    }


                    if(!$v["delete"])
                    {
                        $t= $territoriosDAO->upsert($t);


                    }
                    else
                    {
                        $t= $territoriosDAO->delete(
                            array(
                                "salidas_territorios_id"=>$v["id"]
                            )
                        );


                    }

                }



               // $salidasTerritorio[]= $t;
           }
        //    $t =$territoriosDAO->upsert(array("array"=>$salidasTerritorio));


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


