<?php
require("/includes/autoload.php");
$site="datasite/territorios";
$action="add";


if(is_numeric($_GET["n"]))
{
    $obj= new TerritorioDAO($db,"territorios");
    $territorios = json_encode($obj->read(),JSON_NUMERIC_CHECK);
    $obj= json_encode($obj->read(
        array(
            "territorio_numero"=>$_GET["n"]
        )
    ));

}

require ("/includes/templates/comun/estructura.php");