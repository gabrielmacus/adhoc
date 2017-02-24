<?php
$repositorios = new \DAO\RepositorioDAO($db,"repositorios");

$repositorios= $repositorios->read();
foreach($repositorios as $rep)
{
    $lang["menu"][0]["items"][]=array(
        "texto"=>$rep["nombre"],
        "href"=>"files.php?rep={$rep["repositorio"]}"
    );


}
/*
 * {"texto":"Imagenes","href":"files.php?rep=1"},{"texto":"Videos","href":"files.php?rep=2"},{"texto":"Archivos","href":"files.php?rep=3"}
      ,{"texto":"Audios","href":"files.php?rep=4"}
,
  "repositorios":
  {
    "1":
    {
      "pass":"sercan02",
      "user":"sub697_26",
      "server":"184.154.92.174",
      "dns":"http://electrostyleinformatica.com",
      "dir":"/imagenes",
      "dateformat":"/d/m/Y",
      "root_dir":"/httpdocs",
      "repositorio":1,
      "formats":["jpg","png","jpeg","svg","gif"]
    },
    "2":
    {
      "pass":"sercan02",
      "user":"sub697_26",
      "server":"184.154.92.174",
      "dns":"http://electrostyleinformatica.com",
      "dir":"/videos",
      "dateformat":"/d/m/Y",
      "root_dir":"/httpdocs",
      "repositorio":2,
      "formats":["mp4","avi"]
    },
    "3":
    {
      "pass":"sercan02",
      "user":"sub697_26",
      "server":"184.154.92.174",
      "dns":"http://electrostyleinformatica.com",
      "dir":"/archivos",
      "dateformat":"/d/m/Y",
      "root_dir":"/httpdocs",
      "repositorio":3,
      "formats":["jpg","png","jpeg","svg","gif"]
    },
    "4":
    {
      "pass":"sercan02",
      "user":"sub697_26",
      "server":"184.154.92.174",
      "dns":"http://electrostyleinformatica.com",
      "dir":"/audios",
      "dateformat":"/d/m/Y",
      "root_dir":"/httpdocs",
      "repositorio":4
    }
  }


,
  "repositorios":
  {
    "1":"Imagenes",
    "2":"Videos",
    "3":"Archivos",
    "4":"Audios"
  }
 * */