<?php

require("includes/autoload.php");

/*
set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});*/

try
{
    $ds = new DataSource("test","sercan02","173.236.78.206","adhoc");
//$ds = new DataSource("root","","localhost","adhoc");



    /*
    $repositorioDao = new RepositorioDAO($ds);

    $r = new Repositorio("localhost","prueba","sercan02","Repositorio de prueba","/");


    var_dump($repositorioDao->insertRepositorio($r));

    */


    $archivoDao = new ArchivoDAO($ds);
    var_dump($archivoDao->selectArchivos());

/*
   $archivoDao = new ArchivoDAO($ds);

    $a = $archivoDao->selectArchivoById(14);

    $a->setName("dani.xps");
    $archivoDao->updateArchivos($a);
*/

/*
    $archivoDao = new ArchivoDAO($ds);
    $repositorioDao = new RepositorioDAO($ds);

    $repositorio=$repositorioDao->selectRepositorioById(1);



    foreach($_FILES as $file)
    {
        $archivo = new Archivo($file["size"],$file["name"],$file["type"],null,null,$file["tmp_name"],$repositorio);
        var_dump($archivoDao->insertArchivo($archivo));

    }*/

}
catch (Exception $e)
{
    var_dump($e->getMessage());
}

