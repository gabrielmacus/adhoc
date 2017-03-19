<?php


require("check-login.php");
error_reporting(0);

$idQuery=isset($_GET["id"]) && is_numeric($_GET["id"]);

if(!is_dir("cache/territorios"))
{
    mkdir("cache/territorios");

}

if(!$idQuery)
{
    $dirCache="cache/territorios/territorios.html";
}
else
{
    $dirCache = "cache/territorios/territorios-{$_GET["id"]}.html";
}

switch ($_GET["view"])
{
    case "time":

        $dirCache.=".time";

        break;
}






if(!file_exists($dirCache) || $_GET["cache"]=="false")
{


    ob_start();

    require("includes/autoload.php");


    $id=$_GET["id"];
    
    if(!is_numeric($id) && !empty($id))
    {
        header("Location:");
        exit();
    }
 


    $action="list";
    $site="datasite/territorios";
    $sqlExtra ="  ORDER BY manzana_reporte_fecha DESC";

//ORDER BY territorio_id,orden DESC



    $territorios =new TerritorioDAO($db,"territorios");

//$joinSQL = " LEFT JOIN manzanas ON territorio_id=manzana_territorio LEFT JOIN (SELECT reporte_id,reporte_tiempo as 'manzana_tiempo',reporte_fecha as 'manzana_reporte_fecha' ,reporte_manzana  FROM `reportes` GROUP BY manzana_territorio) as reportes_group  ON manzana_id = reporte_manzana";

    $joinSQL =" LEFT JOIN (SELECT *,reporte_tiempo as 'manzana_tiempo',reporte_fecha as 'manzana_reporte_fecha' FROM manzanas LEFT JOIN reportes  ON  reporte_manzana = manzana_id) as manzanas_reportes ON territorio_id = manzana_territorio WHERE reporte_manzana=38";
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

    if(count($dataToSkin)==0)
    {
        $dirCache="cache/sin-resultados.html";
    }


    $lang["menu"]["territorios"]["active"]=true;

    $lang["menu"]["territorios"]["items"]["list"]["active"]=true;

    echo json_encode($dataToSkin);

    exit();


    require ("includes/templates/{$subdomain}/comun/estructura.php");


    file_put_contents($dirCache,ob_get_contents());



    ob_end_clean();

}

echo  file_get_contents($dirCache);