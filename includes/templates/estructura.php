<!doctype html>
<html lang="es">
<head>
 <?php include("includes/templates/header.php"); ?>
</head>
<style>
  
</style>
<body data-ng-app="app" data-ng-controller="ctrl">

   <div class="navbar blue z-depth-1">
       <?php include ("includes/templates/navbars/sidenav-fixed.php")?>
   </div>


   <div class="body container">

       <?php

       include ("includes/templates/{$site}/{$action}.php");
      //echo $mustache->render(readTemplate("{$site}/{$action}.php"),$dataToSkin);
    ?>
   </div>
</body>
</html>