<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/01/2017
 * Time: 13:14
 */

error_reporting(E_ALL & ~E_NOTICE );

/*** helpers**/

include("includes/framework/helpers/files.php");
include("includes/framework/helpers/arrays.php");
include("includes/framework/helpers/strings.php");
include("includes/framework/helpers/users.php");

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


switch (getSubdomain($_SERVER['HTTP_HOST']))
{
    default:
        break;
    case "panel":
        $subdomain="panel";
        break;

}



/** Base de datos **/

include("includes/framework/db/conector.php");


/** Clases **/

include("includes/datasite/schema/DAO/CoreDAO.php");
include("includes/datasite/schema/DAO/ArchivoDAO.php");
include("includes/datasite/schema/DAO/RepositorioDAO.php");
include("includes/datasite/schema/DAO/UsuarioDAO.php");
include("includes/framework/classes/ImageResize.php");
include("includes/framework/Mustache/Autoloader.php");
include("includes/framework/classes/JWT/JWT.php");


Mustache_Autoloader::register();
$mustache = new Mustache_Engine();





/** Preload del sitio **/
include("includes/datasite/preload.php");

