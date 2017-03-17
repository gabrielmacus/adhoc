<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 08/03/2017
 * Time: 03:40 PM
 */


    function generateToken($data,$secret)
    {
        $data["iat"] = time();
        $token = \Firebase\JWT\JWT::encode($data, $secret);
        setcookie("usrtk", $token);
        return $token;

    }
    function getUserData($secret)
    {
        try{

            return (array)\Firebase\JWT\JWT::decode($_COOKIE["usrtk"],$secret,array('HS256'));
        }catch (Exception $e)
        {
            return false;
        }
    }

