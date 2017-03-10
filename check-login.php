<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 09/03/2017
 * Time: 10:31 AM
 */
require_once("/includes/autoload.php");


if(!$usr = getUserData($config["secret"]))
{
    header("Location: {$config["panelAddress"]}/login.php");
    exit();
}

