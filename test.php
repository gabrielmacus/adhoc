<?php

echo json_encode($_FILES);



function uploadFiles($files,$dir,$ftpConfig)
{

    $ret["success"]=false;
    $ret["error"]=false;
// establecer una conexión básica
    $conn_id = ftp_connect($ftpConfig["server"]);

// iniciar sesión con nombre de usuario y contraseña
    $login_result = ftp_login($conn_id, $ftpConfig["user"], $ftpConfig["pass"]);


    if($login_result)
    {
        //creo los directorios

        $dirs=explode("/",$dir);
        $dirToMake="";
        for($i=0;$i<count($dirs);$i++)
        {
            $dirToMake.="/{$dirs[$i]}";
            echo $dirToMake;
            @ftp_mkdir($conn_id,$dirToMake);
        }


        foreach($files as $file)
        {


            $tmpFile =$file["tmp_name"];

            $name =time()."_".$file["name"];

            // cargar un archivo
            if (ftp_put($conn_id, $dir."/".$name, $tmpFile, FTP_ASCII)) {
              $ret["success"][$file["name"]]=true;

            } else {
                $ret["error"][$file["name"]]=true;
            }

        }
    }

    ftp_close($conn_id);
   return json_encode($ret);



}

/*

$file = $_FILES["a"]["tmp_name"];
$remote_file = '/files/today/ok/file.jpg';



$ftp_server ="184.154.92.174";
$ftp_user_name="sub697_26";
$ftp_user_pass="sercan02";

// establecer una conexión básica
$conn_id = ftp_connect($ftp_server);

// iniciar sesión con nombre de usuario y contraseña
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


$dirs=explode("/",$remote_file);
$dirToMake="";
for($i=0;$i<count($dirs)-1;$i++)
{
    $dirToMake.="/{$dirs[$i]}";
    echo $dirToMake;
    @ftp_mkdir($conn_id,$dirToMake);
}





// cargar un archivo
if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
    echo "se ha cargado $file con éxito\n";
} else {
    echo "Hubo un problema durante la transferencia de $file\n";
}

// cerrar la conexión ftp
ftp_close($conn_id);

*/