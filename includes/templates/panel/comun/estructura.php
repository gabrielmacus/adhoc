<!doctype html>
<html lang="es">
<head>
 <?php include("includes/templates/{$subdomain}/comun/header.php"); ?>
</head>
<style>
  
</style>
<body data-ng-app="app" data-ng-controller="ctrl" >


<script>


    var app = angular.module('app', ['ngAnimate']);
    var scope;
    $(window).load(function () {
        Materialize.updateTextFields();
    });
    app.controller('ctrl', function($scope) {

        <?php if($usr)
        {
        ?>
        $scope.user=<?php foreach($usr as $item){ echo json_encode($item); break; }; ?>;

        <?php
        }?>

        $scope.notEmpty=function(array)
        {
            var notEmpty=false;

            $.each(array,function(k,v)
            {
                console.log(v);

                if(v&&v!=""&&k!="")
                {
                    notEmpty=true;

                    return notEmpty;
                }

            })
            return notEmpty;

        }
      scope=$scope;
        $(".sortable").sortable();
    });
</script>
</script>

   <div class="navbar teal lighten-1">
       <?php include ("includes/templates/{$subdomain}/framework/navbars/sidenav-fixed-1.php")?>
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

       include ("includes/templates/{$subdomain}/{$site}/{$action}.php");
      //echo $mustache->render(readTemplate("{$site}/{$action}.php"),$dataToSkin);
    ?>
   </div>
</body>
</html>