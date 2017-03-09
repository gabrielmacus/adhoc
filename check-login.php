<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 09/03/2017
 * Time: 10:31 AM
 */
require("/includes/autoload.php");

if($_GET["login"]) {
    $usuariosDAO = new UsuarioDAO($db, "usuarios");


    if($usr = $usuariosDAO->read(

        array(

            "usuario_nick" => $_POST["usuario_nick"],
            "usuario_contrasena" => hash("sha256", $_POST["usuario_contrasena"])
        )
    ))
    {

        unset($usr["usuario_contrasena"]);
        generateToken($usr,$config["secret"]);

        header("Location: {$config["panelAddress"]}");
        exit();
    }
}

if(!$usr = getUserData($config["secret"]))
{
    header("Location: {$config["panelAddress"]}/login.php");
    exit();
}

