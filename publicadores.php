<?php
require("includes/autoload.php");

require("check-login.php");
$action="list";
$site="datasite/publicadores";
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




$publicadoresDAO =new \DAO\PublicadorDAO($db,"publicadores");

$joinSQL = "";
if(isset($id))
{
    $dataToSkin=  $publicadoresDAO->read(array(
        "publicador_id"=>$id
    ),$sqlExtra,$page,$limit,$joinSQL);
}
else
{
    $dataToSkin=  $publicadoresDAO->read(array(),$sqlExtra,($page-1),$limit,$joinSQL);
}


$pager = $publicadoresDAO->getPager($limit,$page,$padding);

$lang["menu"]["publicadores"]["active"]=true;

$lang["menu"]["publicadores"]["items"]["list"]["active"]=true;


require ("includes/templates/{$subdomain}/comun/estructura.php");