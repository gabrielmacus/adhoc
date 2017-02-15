<?php

require("/includes/autoload.php");

$schema =array(

   array(
       "join"=>"telefonos_empleados",
       "foreign"=>"telefonos",
       "type"=>3
   )

);
$data = new Data("empleados",$schema,$db);

var_dump($data->select());


