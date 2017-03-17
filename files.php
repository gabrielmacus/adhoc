<?php


require("check-login.php");
error_reporting(0);

$idQuery=isset($_GET["rep"]) && is_numeric($_GET["rep"]);


if(!is_dir("cache/files"))
{
    mkdir("cache/files");

}


if(!$_GET["p"])
{
    $_GET["p"]=1;
}


if(!$idQuery)
{
    $dirCache="cache/files/files.html";
}
else
{

    $dirCache = "cache/files/files-{$_GET["rep"]}-{$_GET["p"]}.html";
}




if(!file_exists($dirCache) || $_GET["cache"]=="false") {


    ob_start();
require("includes/autoload.php");


include("check-login.php");


$site="framework/repositorios";

$action="list";

//Content


$archivos = new \DAO\ArchivoDAO($db,"archivos");

$filter=array();

if($_GET["rep"])
{
    $filter["archivo_repositorio"]=$_GET["rep"];



    $lang["menu"]["repositorios"]["active"]=true;
    $lang["menu"]["repositorios"]["items"][$_GET["rep"]]["active"]=true;


}

$page = $_GET["p"];
if(!$page)
{
    $page=1;
}

$limit=2;
$padding=4;



if($_GET["modal"])

{
    $action="modal/list";
  //  $limit=false;
}

$dataToSkin = $archivos->read($filter," ORDER BY archivo_id DESC",($page-1),$limit);


$pager = $archivos->getPager($limit,$page,$padding);

unset($_GET["p"]);
$qs=http_build_query($_GET);

$url=strtok($_SERVER["REQUEST_URI"],'?');

require ("includes/templates/{$subdomain}/comun/estructura.php");
file_put_contents($dirCache,ob_get_contents());



ob_end_clean();
}



echo  file_get_contents($dirCache);



?>