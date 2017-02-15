<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/01/2017
 * Time: 13:14
 */

error_reporting(E_ALL & ~E_NOTICE );
/** Helpers */

include ("includes/framework/helpers/error-handler.php");
/** Base de datos **/

include("includes/framework/db/conector.php");


/** Clases **/


include("includes/framework/classes/Data.php");

include("includes/datasite/schema/DAO/CoreDAO.php");
include("includes/datasite/schema/DAO/JugadorDAO.php");
include("includes/datasite/schema/DAO/EquipoDAO.php");

include("includes/framework/Mustache/Autoloader.php");

Mustache_Autoloader::register();
$mustache = new Mustache_Engine();

/*** helpers**/

include("includes/framework/helpers/files.php");

