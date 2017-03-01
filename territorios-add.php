<?php
require("/includes/autoload.php");
$site="datasite/territorios";
$action="add";

$t= new TerritorioDAO($db,"territorios");
$sqlExtra="";
if(is_numeric($_GET["n"]))
{

    $obj= $t->read(
        array(
            "territorio_numero"=>$_GET["n"]
        )
    );
    $sqlExtra=    " WHERE territorio_numero!={$obj[0]["territorio_numero"]}";
    $obj= json_encode($obj,JSON_NUMERIC_CHECK);
}

$territorios = $t->read(array(),$sqlExtra);


require ("/includes/templates/comun/estructura.php");