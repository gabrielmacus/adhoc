<!doctype html>
<html lang="es">
<head>
 <?php include("includes/templates/comun/header.php"); ?>
</head>
<style>
  
</style>
<body data-ng-app="app" data-ng-controller="ctrl">

   <div class="navbar teal lighten-1">
       <?php include ("includes/templates/navbars/sidenav-fixed.php")?>
   </div>

   <div style="display: none" id="error-modal">
       <div class="card-content black-text">
           <h5 id="error-text" class="card-title"><?php echo $lang["errors"]["genericError"]["text"];?></h5>

       </div>
       <script>
           function error(err,msg) {
               if(msg)
               {
                   $("#error-text").html(msg);
               }
               $.fancybox.open({
                   src  : '#error-modal',
                   type : 'inline'
               });



           }
       </script>

       <div class="card-action center">
           <button onclick="parent.jQuery.fancybox.getInstance().close();" class="waves-effect waves-teal btn white teal-text">OK</button>
       </div>

   </div>



   <div class="body container">

       <?php

       include ("includes/templates/{$site}/{$action}.php");
      //echo $mustache->render(readTemplate("{$site}/{$action}.php"),$dataToSkin);
    ?>
   </div>
</body>
</html>