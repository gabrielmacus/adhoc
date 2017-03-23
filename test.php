<?php
require("includes/autoload.php");

$ds = new DataSource("gmac","sercan02","173.236.78.206","cm");


$personaDAO= new PersonaDAO($ds);
//$personaDAO->insertPersona(new Persona("Gabriel","Macus",12));


var_dump($personaDAO->selectPersonas());
