<?php

include("includes/datasite/schema/DAO/TerritorioDAO.php");
include("includes/datasite/schema/DAO/ManzanaDAO.php");


$repositorios = new \DAO\RepositorioDAO($db,"repositorios");

$repositorios= $repositorios->read();
foreach($repositorios as $rep)
{
    $lang["menu"]["repositorios"]["items"][]=array(
        "texto"=>$rep["nombre"],
        "href"=>"files.php?rep={$rep["repositorio"]}"
    );
    
}



set_time_limit(60);
?>
