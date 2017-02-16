<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/01/2017
 * Time: 13:11
 */


$configPath='includes/datasite/config.json';
$langPath='includes/datasite/lang.json';
$config =   json_decode(file_get_contents($configPath),true);
$lang =   json_decode(file_get_contents($langPath),true);
$db=mysqli_connect($config["db"]["host"],$config["db"]["user"],$config["db"]["password"],$config["db"]["name"]);
$db->autocommit(false);
