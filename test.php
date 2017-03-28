<?php


require("includes/autoload.php");


$ds = new DataSource("test","sercan02","173.236.78.206","adhoc");
//$ds = new DataSource("root","","localhost","adhoc");



/*
$repositorioDao = new RepositorioDAO($ds);

$r = new Repositorio("localhost","prueba","sercan02","Repositorio de prueba","/");


var_dump($repositorioDao->insertRepositorio($r));

*/




$archivoDao = new ArchivoDAO($ds);
$repositorioDao = new RepositorioDAO($ds);

$repositorio=$repositorioDao->selectRepositorioById(1)[0];


foreach($_FILES as $file)
{
    $archivo = new Archivo($file["size"],$file["name"],$file["type"],$file["tmp_name"],$repositorio);
var_dump($archivoDao->insertArchivo($archivo));

}
