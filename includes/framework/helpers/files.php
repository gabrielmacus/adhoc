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


/**
 * Convert bytes to human readable format
 *
 * @param integer bytes Size in bytes to convert
 * @return string
 */
function bytesToSize($bytes, $precision = 2)
{
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';

    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';

    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';

    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';

    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}
function uploadFiles($files,$dir,$config,$rootDir="/httpdocs")
{

    $ret["success"]=false;
    $ret["error"]=false;
// establecer una conexión b�sica
    $conn_id = ftp_connect($config["server"]);

// iniciar sesi�n con nombre de usuario y contrase�a
    $login_result = ftp_login($conn_id, $config["user"], $config["pass"]);

    ftp_pasv($conn_id,true);


    if($login_result)
    {
        //creo los directorios

        if(count($files)>0)
        {
            $dir=$rootDir.$dir;
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


                $name =time()."_".$file["name"];

                $completeName= $dir."/".$name;

                // cargar un archivo
                if (ftp_put($conn_id,$completeName, $tmpFile, FTP_BINARY)) {

                    $file["o"]["completeUrl"]=$config["dns"]. str_replace($rootDir,"",$completeName);

                    $file["name"]=$name;


                    unset($file["tmp_name"]);

                    $ret["success"][]=$file;




                } else {
                    $ret["error"][]=$file["name"];
                }

            }
        }
        else{
            $ret["error"]=true;
        }


    }
    else
    {
        $ret["error"]=true;
    }

    ftp_close($conn_id);
    return $ret;



}

