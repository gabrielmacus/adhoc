<?php
require("/includes/autoload.php");



$equipo = new \DAO\EquipoDAO($db,"equipos");

echo json_encode($equipo->read(
    array(
        "equipo_id"=>1
    )
));
$db->commit();