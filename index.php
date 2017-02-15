<?php
require("/includes/autoload.php");



$equipo = new \DAO\EquipoDAO($db,"equipos");

echo json_encode($equipo->read());
$db->commit();