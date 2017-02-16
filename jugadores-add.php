<?php
require("/includes/autoload.php");

$action="add";
$site="jugadores";

$jugadores = new \DAO\EquipoDAO($db,"jugadores");
require ("/includes/templates/estructura.php");