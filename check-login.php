<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 09/03/2017
 * Time: 10:31 AM
 */
include_once("includes/framework/helpers/users.php");
include_once ("includes/framework/classes/JWT/JWT.php");

$config= json_decode(file_get_contents("includes/datasite/config.json"),true);


if(!$usr = getUserData($config["secret"]))
{
    header("Location: {$config["panelAddress"]}/login.php");
    exit();
}

