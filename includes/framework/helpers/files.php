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

function deleteDir($dir,$config)
{

// establecer una conexión b�sica
    $conn_id = ftp_connect($config["server"]);

// iniciar sesi�n con nombre de usuario y contrase�a
    $login_result = ftp_login($conn_id, $config["user"], $config["pass"]);

    ftp_pasv($conn_id,true);


    if($login_result)
    {
        ftp_chdir($conn_id, $dir);
        $files = ftp_nlist($conn_id, ".");
        $success=true;
        foreach ($files as $file)
        {

           if(!ftp_delete($conn_id, $file))
           {
               $success=false;
           }

        }

        return $success;


    } else
    {
        return false;
    }
}
function deleteFile($file,$config)
{


// establecer una conexión b�sica
    $conn_id = ftp_connect($config["server"]);

// iniciar sesi�n con nombre de usuario y contrase�a
    $login_result = ftp_login($conn_id, $config["user"], $config["pass"]);

    ftp_pasv($conn_id,true);


    if($login_result)
    {


        return ftp_delete($conn_id,$file);



    } else
{
   return false;
}

}


function uploadFiles($files,$dir,$config)
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
            $dir=$config["root_dir"].$dir;
            $dirs=explode("/",$dir);
            $dirToMake="";
            for($i=0;$i<count($dirs);$i++)
            {
                $dirToMake.="/{$dirs[$i]}";

                @ftp_mkdir($conn_id,$dirToMake);
            }


            foreach($files as $file)
            {



                $type = explode("/",$file["type"]);
                $type = $type[1];
                if(   in_array($type, $config["formats"]))
                {
                    $tmpFile =$file["tmp_name"];


                    $name =time()."_".$file["name"];

                    $originalName=$file["name"];
                    @ftp_mkdir($conn_id,$dir."/".$name);


                    $folder=$dir."/".$name;

                    $completeName= $folder."/o_".$name;//Se indica el prefijo o para los archivos originales

                    // cargar un archivo
                    if (ftp_put($conn_id,$completeName, $tmpFile, FTP_BINARY)) {


                        $file["o"]["completeUrl"]=$config["dns"].str_replace($config["root_dir"],"",$completeName);

                        $file["folder"]=$folder;
                        $file["name"]=$name;
                        $file["originalName"]=$originalName;
                        $file["date"]=time();


                        unset($file["tmp_name"]);

                        $ret["success"][]=$file;




                    } else {
                        $ret["error"][]=$file["name"];
                    }
                }
                else
                { $ret["error"][]=$file["name"];

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

