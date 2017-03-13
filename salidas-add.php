<?php
require("/includes/autoload.php");


require("check-login.php");
$site="datasite/salidas";
$action="add";


if(is_numeric($_GET["id"]))
{
    $obj= new \DAO\SalidaDAO($db,"salidas");
    $obj= json_encode($obj->read(
        array(
            "salida_id"=>$_GET["id"]
        )
    )[$_GET["id"]]);

}
$publicadorDAO = new \DAO\PublicadorDAO($db,"publicadores");

$conductores = $publicadorDAO->read(array(

    "publicador_conductor"=>1
));

require ("includes/templates/{$subdomain}/comun/estructura.php");