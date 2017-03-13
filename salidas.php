<?php
require("includes/autoload.php");

require("check-login.php");


$action= $_GET["act"]?$_GET["act"]:"list";



if(!$_GET["modal"])
{
    $site="datasite/salidas";
}
else
{
    $site="datasite/salidas/modal";
}



$sqlExtra =" ORDER BY publicador_apellido,publicador_nombre ASC";
$id=$_GET["id"];

if(!is_numeric($id) && !empty($id))
{
    header("Location:");
    exit();
}


$page = $_GET["p"];
if(!$page)
{
    $page=1;
}

$limit=20;
$padding=4;



$DAO =new \DAO\SalidaDAO($db,"salidas");

$joinSQL = "";
if(isset($id))
{
    $dataToSkin=  $DAO->read(array(
        "salida_id"=>$id
    ),$sqlExtra,0,false,$joinSQL);
}
else
{
    $dataToSkin=  $DAO->read(array(),$sqlExtra,($page-1),$limit,$joinSQL);
}


$pager = $DAO->getPager($limit,$page,$padding);

$lang["menu"]["salidas"]["active"]=true;

$lang["menu"]["salidas"]["items"]["list"]["active"]=true;


require ("includes/templates/{$subdomain}/comun/estructura.php");