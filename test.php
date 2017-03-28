<?php

var_dump($_FILES);

require("includes/autoload.php");

//$ds = new DataSource("gmac","sercan02","173.236.78.206","cm");
$ds = new DataSource("root","","localhost","adhoc");

$ftp = new \FtpClient\FtpClient();
$ftp=$ftp->connect("localhost");
$ftp = $ftp->login("test","sercan02");
$archivoDao = new ArchivoDAO($ftp,$ds);

foreach($_FILES as $file)
{
    $archivo = new Archivo($file["size"],$file["name"],$file["type"],$file["tmp_name"]);
var_dump($archivoDao->insertArchivo($archivo));

}
