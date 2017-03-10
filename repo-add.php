<?php
require("/includes/autoload.php");


require("check-login.php");
$site="framework/repositorios";
$action="add";


if(is_numeric($_GET["id"]))
{
    $obj= new \DAO\RepositorioDAO($db,"repositorios");
    $obj= json_encode($obj->read(
        array(
      "repositorio"=>$_GET["id"]
        )
    ));
}

require ("includes/templates/{$subdomain}/comun/estructura.php");