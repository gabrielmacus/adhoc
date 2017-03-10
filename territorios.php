<?php
require("includes/autoload.php");

require("check-login.php");
$action="list";
$site="datasite/territorios";
$sqlExtra =" ORDER BY territorio_id,orden DESC";
$id=$_GET["id"];

if(!is_numeric($id) && !empty($id))
{
    header("Location:");
    exit();
}




$territorios =new TerritorioDAO($db,"territorios");

$joinSQL = " LEFT JOIN manzanas ON territorio_id=manzana_territorio";
if(isset($id))
{
    $dataToSkin=  $territorios->read(array(
        "territorio_id"=>$id
    ),$sqlExtra,0,false,$joinSQL);
}
else
{
    $dataToSkin=  $territorios->read(array(),$sqlExtra,0,false,$joinSQL);
}


$lang["menu"]["territorios"]["active"]=true;

$lang["menu"]["territorios"]["items"]["list"]["active"]=true;


require ("includes/templates/{$subdomain}/comun/estructura.php");