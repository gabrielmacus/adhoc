<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 08/03/2017
 * Time: 12:20 PM
 */

function getSubdomain($url)
{
    $explode=explode(".",$url);
   return array_shift($explode);

}
