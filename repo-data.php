<?php
require("includes/autoload.php");



$id = $_GET["id"];

if(!$id)
{


    $repositorios =new \DAO\RepositorioDAO($db,"repositorios");

}



if(is_numeric($id))
{
    $repositorios = new \DAO\RepositorioDAO($db,"repositorios");

    $repositorio=$repositorios->read(
        array(
            "repositorio"=>$id
        )
    );
}


if(!isset($_GET["act"]))
{
    $action="add";
    $site="archivos";


    require ("includes/templates/estructura.php");
}
else
{

    switch ($_GET["act"])
    {
        case 'add':

            echo json_encode($repositorios->upsert($_POST));

            break;
        case 'delete':

            echo  json_encode($repositorios->delete(
                $_POST
            ));


            break;
    }

    $db->commit();
}
