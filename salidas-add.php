<?php
require("/includes/autoload.php");


require("check-login.php");
$site="datasite/salidas";
$action="add";


$joinSQL = " LEFT JOIN salidas_territorios ON salida=salida_id LEFT JOIN territorios ON territorio = territorio_id";
if(is_numeric($_GET["id"]))
{
    $obj= new \DAO\SalidaDAO($db,"salidas");
    $obj=$obj->read(
        array(
            "salida_id"=>$_GET["id"]
        )
    ,null,0,false,$joinSQL);

}
$publicadorDAO = new \DAO\PublicadorDAO($db,"publicadores");

$conductores = $publicadorDAO->read(array(

    "publicador_conductor"=>1
));

$familias =$publicadorDAO->read(array()," GROUP BY publicador_apellido");

foreach($familias as $k=>$v)
{
    $familias[$lang["family"]." ".$familias[$k]["publicador_apellido"]]=null;
}

$territoriosDAO =new TerritorioDAO($db,"territorios");
$territorios = $territoriosDAO->read(array()," GROUP BY territorio_numero");





require ("includes/templates/{$subdomain}/comun/estructura.php");