<?php
require("/includes/autoload.php");

$action="add";
$site="equipos";

$equipos = new \DAO\EquipoDAO($db,"equipos");
require ("/includes/templates/estructura.php");