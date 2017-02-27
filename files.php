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

$page = $_GET["p"];
if(!$page)
{
    $page=1;
}

$limit=6;
$padding=4;

$dataToSkin = $archivos->read($filter," ORDER BY archivo_id DESC",($page-1),$limit);

$pager = $archivos->getPager($limit,$page,$padding);

unset($_GET["p"]);
$qs=http_build_query($_GET);
require ("includes/templates/comun/estructura.php");



?>