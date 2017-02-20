<?php
include("includes/autoload.php");

$json["pass"]="sercan02";
$json["user"]="subaquatic-bows";
$json["server"]="files.000webhost.com";
$json["dns"]="https://subaquatic-bows.000webhostapp.com";

$res=uploadFiles($_FILES,"public_html/images",$json);
var_dump($res);?>


<form method="post" enctype="multipart/form-data" action="ftptest.php">
    <input name="archivo" type="file">
    <button type="submit">Enviar</button>
</form>
