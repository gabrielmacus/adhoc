<?php
require("includes/autoload.php");

$site="framework/repositorios";
$action="list";
//Content

$archivos = new \DAO\ArchivoDAO($db,"archivos");

$dataToSkin = $archivos->read();

require ("includes/templates/comun/estructura.php");