<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 02/03/2017
 * Time: 11:16 AM
 */


?>
<style>
    .body
    {
        height: 100%;
    }
</style>
<div class="row center" style="height: 100%;padding-top: 50px">


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


            //$polygons =json_decode($data["territorio_polygons"],true);
            ?>






            var polygon=false;
            var marker= new google.maps.Marker({
                map: map,
                visible: true,
                icon:"https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_red<?php echo $data["territorio_numero"];?>.png"
            });
            <?php


$maxDate=null;


             foreach($data["manzanas"] as $manzana)
             {



$strokeColor= $data["territorio_color"];
$lineColor= $data["territorio_color"];

           switch($_GET["view"])
           {

           case "time":

           include ("objetos/vistas-mapa/time.php");

           break;


           }

?>

            polygon= new google.maps.Polygon({

                strokeColor:'<?php echo $strokeColor?>',
                strokeOpacity: 0.7,
                strokeWeight: 2,
                fillColor: '<?php echo $lineColor ?>',
                fillOpacity: 0.8,
                path:<?php echo $manzana["manzana_polygon"] ?>,
                map:map
            });
            <?php







                  if(!$maxDate || $manzana["manzana_reporte_fecha"]>$maxDate)
             {




               $maxDate=$manzana["manzana_reporte_fecha"];?>

            marker.setPosition(polygonCenter(polygon));




                <?php

                 }
                 ?>

            polygon.addListener("click",
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

            <?php
             }?>






            <?php



             ?>

            marker.addListener("click",function () {

                var infoHtml= "<a href='territorios.php?id=<?php echo $data["territorio_id"];?>'><h5 style='color:black!important' class='center'><b><?php echo $data["territorio_numero"];?></b></h5>"
                    + "<span style='color:black;display:block'>" +
                    "<?php echo $data["territorio_notas"];?>" +
                    "</span>" +
                    "<h5 style='color:teal'><?php  if($maxDate){

                        $dias=(time()-$maxDate) / (60 * 60 * 24);

                       $dias = floor($dias);
                        if($dias!=1)
                        {
                            echo "Predicado hace {$dias} dias";
                        }
                        else
                        {
                            echo "Predicado hace {$dias} dia";
                        }



                    }else{echo "No predicado";}?></h5>" +
                    "<a class='btn'  style='width:100%!important;color:white!important;margin-top:10px!important;' href='territorios-add.php?id=<?php echo $data["territorio_id"];?>'>Editar</a><br>"+
                    "<a class='btn'  style='width:100%!important;color:white!important;margin-top:10px!important;' href='territorios-data.php?id=<?php echo $data["territorio_id"];?>&act=delete'>Eliminar</a><br>"+
                    "</a>";

                var infowindow = new google.maps.InfoWindow({
                    content: infoHtml,
                });
                infowindow.open(map,this);
            })


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
