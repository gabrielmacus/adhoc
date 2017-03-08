<?php

include("includes/datasite/schema/DAO/TerritorioDAO.php");
include("includes/datasite/schema/DAO/ManzanaDAO.php");


$repositorios = new \DAO\RepositorioDAO($db,"repositorios");

$repositorios= $repositorios->read();
foreach($repositorios as $rep)
{
    $lang["menu"][0]["items"][]=array(
        "texto"=>$rep["nombre"],
        "href"=>"files.php?rep={$rep["repositorio"]}"
    );
    
}




$usr = getUserData($config["secret"]);

if(!$usr)
{
    
}


?>
