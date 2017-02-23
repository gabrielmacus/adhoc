<?php
require("includes/autoload.php");

$site="framework/repositorios";
$action="list";
//Content

$archivos = new \DAO\ArchivoDAO($db,"archivos");

$filter=array();

if($_GET["rep"])
{
    $filter["archivo_repositorio"]=$_GET["rep"];;
}

$dataToSkin = $archivos->read($filter);

require ("includes/templates/comun/estructura.php");