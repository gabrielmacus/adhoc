<?php
require("includes/autoload.php");

//$ds = new DataSource("gmac","sercan02","173.236.78.206","cm");
$ds = new DataSource("root","","localhost","adhoc");

$usuarioDAO = new UserDAO($ds);

$usuario= new User(null,null,null,"gabrielmacus@gmail.com","sercan02","gabi2012");

var_dump($usuarioDAO->insertUsuario($usuario));