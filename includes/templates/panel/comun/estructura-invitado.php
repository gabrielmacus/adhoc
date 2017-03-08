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
    app.controller('ctrl', function($scope) {

        });

    </script>

<div class="body ">

    <?php

    include ("includes/templates/{$subdomain}/{$site}/{$action}.php");
    //echo $mustache->render(readTemplate("{$site}/{$action}.php"),$dataToSkin);
    ?>
</div>


</body>


</html>