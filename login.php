<?php
require("/includes/autoload.php");


if($_GET["login"]) {
    $usuariosDAO = new UsuarioDAO($db, "usuarios");


    $usr = $usuariosDAO->read(

        array(

            "usuario_nick" => $_POST["usuario_nick"],
            "usuario_contrasena" => hash("sha256", $_POST["usuario_contrasena"])
        )
    );
    var_dump( array(

        "usuario_nick" => $_POST["usuario_nick"],
        "usuario_contrasena" => hash("sha256", $_POST["usuario_contrasena"])
    ));


    if($usr)
    {

        unset($usr["usuario_contrasena"]);
        generateToken($usr,$config["secret"]);

        header("Location: {$config["panelAddress"]}");
        exit();
    }
}
$site="framework/usuario";
$action ="login";





require ("includes/templates/{$subdomain}/comun/estructura-invitado.php");