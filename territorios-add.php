<?php
require("/includes/autoload.php");
$site="datasite/territorios";
$action="add";

$t= new TerritorioDAO($db,"territorios");
$sqlExtra="";
if(is_numeric($_GET["id"]))
{

    $obj= $t->read(
        array(
            "territorio_id"=>$_GET["id"]
        )
    );

    $obj= json_encode($obj,JSON_NUMERIC_CHECK);
}

$territorios = $t->read(array(),$sqlExtra);


require ("/includes/templates/comun/estructura.php");