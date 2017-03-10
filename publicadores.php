<?php
require("includes/autoload.php");

require("check-login.php");
$action="list";
$site="datasite/publicadores";
$sqlExtra =" ORDER BY publicador_id,orden DESC";
$id=$_GET["id"];

if(!is_numeric($id) && !empty($id))
{
    header("Location:");
    exit();
}




$publicadoresDAO =new \DAO\PublicadorDAO($db,"publicadores");

$joinSQL = "";
if(isset($id))
{
    $dataToSkin=  $publicadoresDAO->read(array(
        "publicador_id"=>$id
    ),$sqlExtra,0,false,$joinSQL);
}
else
{
    $dataToSkin=  $publicadoresDAO->read(array(),$sqlExtra,0,false,$joinSQL);
}


$lang["menu"]["publicadores"]["active"]=true;

$lang["menu"]["publicadores"]["items"]["list"]["active"]=true;


require ("includes/templates/{$subdomain}/comun/estructura.php");