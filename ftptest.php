<?php
include("includes/autoload.php");

$json["pass"]="sercan02";
$json["user"]="subaquatic-bows";
$json["server"]="files.000webhost.com";
$json["dns"]="https://subaquatic-bows.000webhostapp.com";

var_dump(uploadFiles($_FILES,"public_html/images",$json));