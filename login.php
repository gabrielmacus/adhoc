<?php
require("/includes/autoload.php");

$site="framework/usuario";
$action ="login";

if($_GET["login"])
{
    $usuariosDAO = new UsuarioDAO($db,"usuarios");


    $usr=$usuariosDAO->read(

        array(

            "usuario_nick"=>$_POST["usuario_nick"],
            "usuario_contrasena"=>hash("sha256",$_POST["usuario_contrasena"])
        )
    );


  if($usr)
  {

     

      exit();
  }

}


require ("includes/templates/{$subdomain}/comun/estructura-invitado.php");