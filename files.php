<?php


require("includes/autoload.php");


include("check-login.php");


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

$limit=20;
$padding=4;



if($_GET["modal"])

{
    $action="modal/list";
  //  $limit=false;
}

$dataToSkin = $archivos->read($filter," ORDER BY archivo_id ",($page-1),$limit);


$pager = $archivos->getPager($limit,$page,$padding);

unset($_GET["p"]);
$qs=http_build_query($_GET);


require ("includes/templates/{$subdomain}/comun/estructura.php");


?>