<?php
require("/includes/autoload.php");



$id = $_GET["id"];

if(!$id)

{
    $repositorio=$config["repositorios"][$_GET["rep"]];
    $archivos =new \DAO\ArchivoDAO($db,"archivos",$repositorio);
    if(!$repositorio)
    {
        return false;
    }
}



if(is_numeric($id))
{
    $archivos = new \DAO\ArchivoDAO($db,"archivos");

    $archivo=$archivos->read(
        array(
            "archivo_id"=>$id
        )
    );



    foreach($archivo as $k=>$v)
    {
        $archivos->setConfig($config["repositorios"][$k]);
        $archivo=$archivo[$k][$id];

       

        $archivo=json_encode($archivo);



    }





}


if(!isset($_GET["act"]))
{
    $action="add";
    $site="archivos";


    require ("/includes/templates/estructura.php");
}
else
{

    switch ($_GET["act"])
    {
        case 'add':



            echo json_encode($archivos->upload($_FILES,$_POST));


            break;
        case 'edit':
            echo json_encode($archivos->upsert($_POST));

            break;
        case 'delete':

            echo  json_encode($archivos->delete(
             $_POST
            ));


            break;
    }

    $db->commit();
}
