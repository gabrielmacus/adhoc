<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17/03/2017
 * Time: 10:25 AM
 */function HTTPrequest($url,$q=false)
{

    //Initialize cURL.
    $ch = curl_init();
//Set the URL that you want to GET by using the CURLOPT_URL option.
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);

    if($q)
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS,
        http_build_query($q));
    }

    /*array("titulo"=>$_POST["titulo"])*/
//Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Execute the request.
    $data = curl_exec($ch);
//Close the cURL handle.
    curl_close($ch);

    return $data;
}