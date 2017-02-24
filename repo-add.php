<?php
require("/includes/autoload.php");

$site="framework/repositorios";
$action="add";
//Content

if(is_numeric($_GET["id"]))
{
    $repo= new \DAO\RepositorioDAO($db,"repositorios");
    $repo= json_encode($repo->read(
        array(
      "repositorio"=>$_GET["id"]
        )
    ));
}

require ("/includes/templates/comun/estructura.php");