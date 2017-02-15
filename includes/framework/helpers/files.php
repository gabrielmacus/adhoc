<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/01/2017
 * Time: 04:49 PM
 */

function readTemplate($name)
{
    return file_get_contents("includes/templates/".$name);
}


function uploadFiles($files,$dir,$config)
{

    $ret["success"]=false;
    $ret["error"]=false;
// establecer una conexión básica
    $conn_id = ftp_connect($config["server"]);

// iniciar sesión con nombre de usuario y contraseña
    $login_result = ftp_login($conn_id, $config["user"], $config["pass"]);


    if($login_result)
    {
        //creo los directorios

        $dirs=explode("/",$dir);
        $dirToMake="";
        for($i=0;$i<count($dirs);$i++)
        {
            $dirToMake.="/{$dirs[$i]}";

            @ftp_mkdir($conn_id,$dirToMake);
        }


        foreach($files as $file)
        {


            $tmpFile =$file["tmp_name"];

            $imagen = new Imagick($tmpFile);

            $imagen->thumbnailImage(100,0);
            
            $name =time()."_".$file["name"];

            $completeName= $dir."/".$name;

            // cargar un archivo
            if (ftp_put($conn_id,$completeName, $tmpFile, FTP_ASCII)) {

                $file["completeUrl"]=$config["dns"].$completeName;



                $ret["success"][]=$file;




            } else {
                $ret["error"][]=$file["name"];
            }

        }
    }

    ftp_close($conn_id);
    return $ret;



}

