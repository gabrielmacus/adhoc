<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 02/03/2017
 * Time: 11:16 AM
 */


?>


<script>

    var tooltipTimer;
    function hideTooltip() {
        var tt=$("#tt");


        tooltipTimer = setTimeout(function(){

           tt.fadeOut();
        },500);

    }
    function showTooltip(data,e) {
        clearTimeout(tooltipTimer);
        var tt=$("#tt");
        tt.stop();
        tt.html(data);



        var keys = Object.keys(e);
        var x, y;
        for (var i = 0; i < keys.length; i++) {
            if (MouseEvent.prototype.isPrototypeOf(e[keys[i]])) {
                x = e[keys[i]].clientX;
                y = e[keys[i]].clientY;
            }
        }


        y=parseInt($(window).scrollTop())+parseInt(y);

            tt.css("left",x);
            tt.css("top",y+"px");
        tt.fadeIn();


    }
</script>

<style>

    .body
    {
        height: 100%;
    }
    .btn.active
    {
        background-color: white!important;
        color: teal!important;
    }
</style>

<div class="row center" style="height: 100%">

    <h2>Territorios</h2>


    <?php
    switch($_GET["view"]) {

        case "time":

            include ("objetos/vistas-mapa/time/time-references.php");
            break;

    }

    ?>
    <div class="row">


        <div class="col s12">
            <a class="btn col s12 m6 <?php if(!$_GET["view"]){ echo "active";} ?>" href="territorios.php">Vista por territorios</a>
            <a class="btn col s12 m6  <?php if($_GET["view"]=="time"){ echo "active";} ?>" href="territorios.php?view=time">Vista por manzanas</a>

        </div>


    </div>

   
    <div id="map" style="width: 100%;height: 100%;">

    </div>



    <script>

        var selectedManzanas=[];


        function initMap() {



            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center:  {lat: -31.7333 , lng: -60.5333},
                gestureHandling:'cooperative'
            });
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map.setCenter(pos);
            });






            <?php foreach ($dataToSkin as $data)
            {



            $maxDate=null;


            //$polygons =json_decode($data["territorio_polygons"],true);

?>
            var marker<?php echo $data["territorio_numero"];?>= new google.maps.Marker({
                map: map,
                visible: true,
                icon:"https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_red<?php echo $data["territorio_numero"];?>.png"
            });

        <?Php
             foreach($data["manzanas"] as $k=>$manzana)
             {


foreach($manzana["reportes"] as $r)//Obtengo el ultimo reporte de la manzana
{
$reporte=$r;
break;
}

$reporteFecha=$reporte["manzana_reporte_fecha"];




$strokeColor= $data["territorio_color"];
$lineColor= $data["territorio_color"];

           switch($_GET["view"])
           {

           case "time":

           include ("objetos/vistas-mapa/time/time.php");

           break;


           }

?>



            var   polygon<?php echo $k?>= new google.maps.Polygon({

                strokeColor:'<?php echo $strokeColor?>',
                strokeOpacity: 0.7,
                strokeWeight: 2,
                fillColor: '<?php echo $lineColor ?>',
                fillOpacity: 0.7,
                path:<?php echo $manzana["manzana_polygon"] ?>,
                map:map
            });



        <?php






                  if(!$maxDate || $reporteFecha>$maxDate)
             {

               $maxDate=$reporteFecha

               ;?>

             marker<?php echo  $data["territorio_numero"];?>.setPosition(polygonCenter(  polygon<?php echo $k?>));

                <?php


                 }
                 ?>

            polygon<?php echo $k?>.addListener("click",
            function () {

          
                if(this.strokeColor!="black")
                {
                    this.setOptions({strokeColor:"black"
                        ,strokeWeight:3});

                    selectedManzanas.push(<?php echo $manzana["manzana_id"] ?>);
                }
                else
                {
                    this.setOptions({strokeColor:"<?php echo $data["territorio_color"]?>"
                        ,strokeWeight:2});

                    var idx=        selectedManzanas.indexOf(<?php echo $manzana["manzana_id"] ?>);
                    selectedManzanas.splice(idx,1);
                }

                console.log(selectedManzanas);


               

            });
            polygon<?php echo $k?>.addListener("mouseover",function(e){
                var tooltipData="<?php

                    $lastPreach=date("d/m/Y",$reporteFecha);
                    $lastPreachDays=ceil( (time()-$reporteFecha) / (60 * 60 * 24));
                    if(!$reporteFecha)
                    {
                        echo  "No predicado";
                    }
                    else
                    {
                        if($lastPreachDays==1)
                        {
                            echo "Ultima vez predicada el <time class='blue-text'>{$lastPreach}</time>, hace {$lastPreachDays} dia";
                        }
                        else
                        {
                            echo "Ultima vez predicada el <time class='blue-text'>{$lastPreach}</time>, hace {$lastPreachDays} dias";
                        }

                    }

                    ?>";




                showTooltip(tooltipData,e);


            });

            polygon<?php echo $k?>.addListener("mouseout",function(e){
              hideTooltip();


            });




            
            <?php
             }?>


            var infowindow = new google.maps.InfoWindow();

            marker<?php echo $data["territorio_numero"];?>.addListener("click",function () {


                var infoHtml= "<a href='territorios.php?id=<?php echo $data["territorio_id"];?>'><h5 style='color:black!important' class='center'>N°&nbsp;<b><?php echo $data["territorio_numero"];?></b></h5>"
                    + "<span style='color:black;display:block'>" +
                    "<?php echo $data["territorio_notas"];?>" +
                    "</span>" +
                    "<h6 style='color:teal'><?php  if($maxDate){

                        $dias=(time()-$maxDate) / (60 * 60 * 24);


                        $fecha=date("d/m/Y",$maxDate);

                       $dias = ceil($dias);


                        if($dias!=1)
                        {
                            echo "Territorio predicado hace {$dias} dias, <time class='grey-text'>{$fecha}</time>";
                        }
                        else
                        {
                            echo "Territorio predicado hace {$dias} dia, <time class='grey-text'>{$fecha}</time>";
                        }



                    }else{echo "Territorio no predicado";}?></h6>" +
                    "<a class='btn'  style='width:100%!important;color:white!important;margin-top:10px!important;' href='territorios-add.php?id=<?php echo $data["territorio_id"];?>'>Editar</a><br>"+
                    "<a class='btn'  style='width:100%!important;color:white!important;margin-top:10px!important;' href='territorios-data.php?id=<?php echo $data["territorio_id"];?>&act=delete'>Eliminar</a><br>"+
                    "</a>";


                infowindow.setContent(infoHtml);
                    infowindow.open(map,this);


            });


            <?php
            }?>







        }

        function polygonCenter(poly) {
            var lowx,
                highx,
                lowy,
                highy,
                lats = [],
                lngs = [],
                vertices = poly.getPath();

            for(var i=0; i<vertices.length; i++) {
                lngs.push(vertices.getAt(i).lng());
                lats.push(vertices.getAt(i).lat());
            }

            lats.sort();
            lngs.sort();
            lowx = lats[0];
            highx = lats[vertices.length - 1];
            lowy = lngs[0];
            highy = lngs[vertices.length - 1];
            center_x = lowx + ((highx-lowx) / 2);
            center_y = lowy + ((highy - lowy) / 2);
            return (new google.maps.LatLng(center_x, center_y));
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>

<div class="row" >

<div class="col s12">
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header"><i class="material-icons">timer</i>Informar</div>
            <div class="collapsible-body center">

                <?php
                include ("objetos/report.php")?>

            </div>
        </li>

    </ul>
</div>

    <div class="col s12">
        <?php
        include ("objetos/files-loader.php")?>
        </div>





</div>

</div>
