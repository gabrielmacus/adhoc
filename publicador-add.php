<?php
require("/includes/autoload.php");


require("check-login.php");
$site="datasite/publicadores";
$action="add";


if(is_numeric($_GET["id"]))
{
    $obj= new \DAO\PublicadorDAO($db,"publicadores");
    $obj= json_encode($obj->read(
        array(
            "publicador_id"=>$_GET["id"]
        )
    )[$_GET["id"]]);
   
}

require ("includes/templates/{$subdomain}/comun/estructura.php");