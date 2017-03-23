<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/01/2017
 * Time: 13:14
 */



define("ROOT_DIR", str_replace("includes","",__DIR__));



error_reporting(E_ALL & ~E_NOTICE );

/*** helpers**/

include_once("includes/framework/helpers/files.php");
include_once("includes/framework/helpers/arrays.php");
include_once("includes/framework/helpers/strings.php");
include_once("includes/framework/helpers/users.php");

/** configuraciones e idioma **/
$configPath='includes/datasite/config.json';
$config =   json_decode(file_get_contents($configPath),true);

$cookieIdioma = $_COOKIE["lang"];

switch ($cookieIdioma)
{
    default:

        $langPath='includes/datasite/lang/es.json';
        break;
    case "en":
        $langPath='includes/datasite/lang/en.json';

        break;
}

$lang =   json_decode(file_get_contents($langPath),true);


/*


switch (getSubdomain($_SERVER['HTTP_HOST']))
{
    default:
        break;
    case "panel":
        $subdomain="panel";
        break;

}*/

$subdomain="panel";

/** Base de datos **/

include_once("includes/framework/db/conector.php");


/** Clases **/

include_once("includes/datasite/schema/DAO/CoreDAO.php");
include_once("includes/datasite/schema/DAO/ArchivoDAO.php");
include_once("includes/datasite/schema/DAO/RepositorioDAO.php");
include_once("includes/datasite/schema/DAO/UsuarioDAO.php");
include_once("includes/framework/classes/ImageResize.php");
include_once("includes/framework/Mustache/Autoloader.php");
include_once("includes/framework/classes/JWT/JWT.php");

/** Testeando un poco **/
include_once("includes/framework/classes/DAO/Persona/PersonaDAO.php");

Mustache_Autoloader::register();
$mustache = new Mustache_Engine();

$repositorios = new \DAO\RepositorioDAO($db,"repositorios");

$repositorios= $repositorios->read();
if(count($repositorios)>0)
{
    foreach($repositorios as $k=>$rep)
    {

        $lang["menu"]["repositorios"]["items"][$k]=array(
            "texto"=>$rep["nombre"],
            "href"=>"files.php?rep={$rep["repositorio"]}"
        );

    }

}
else
{
    unset(  $lang["menu"]["repositorios"]);
}

date_default_timezone_set($lang["php_timezone"]);
/** Preload del sitio **/
include_once("includes/datasite/preload.php");

