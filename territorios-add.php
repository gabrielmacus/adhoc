<?php
require("/includes/autoload.php");


require("check-login.php");

$site="datasite/territorios";
$action="add";

$t= new TerritorioDAO($db,"territorios");
$sqlExtra="";

$joinSQL = " LEFT JOIN manzanas ON territorio_id=manzana_territorio";
if(is_numeric($_GET["id"]))
{

    $obj= $t->read(
        array(
            "territorio_id"=>$_GET["id"]
        )
    ,$sqlExtra,0,false,$joinSQL);

    $obj= json_encode($obj,JSON_NUMERIC_CHECK);
}



//$territorios = $t->read(array(),$sqlExtra);



$lang["menu"]["territorios"]["active"]=true;

$lang["menu"]["territorios"]["items"]["add"]["active"]=true;

require ("includes/templates/{$subdomain}/comun/estructura.php");