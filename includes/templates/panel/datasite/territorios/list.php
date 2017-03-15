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

            var infoHtml= "<a href='territorios.php?id=<?php echo $data["territorio_id"];?>'><h6 class='center'><?php echo $data["territorio_numero"];?></h6>"
            + "<span style='color:black;display:block'>" +
                "<?php echo $data["territorio_notas"];?>" +
                "</span>" +
                "<a href='territorios-add.php?id=<?php echo $data["territorio_id"];?>'>Editar</a><br>"+
                "<a href='territorios-data.php?id=<?php echo $data["territorio_id"];?>&act=delete'>Eliminar</a><br>"+
                "</a>";





            var polygon;
            <?php
             foreach($data["manzanas"] as $manzana)
             {
             ?>



                polygon= new google.maps.Polygon({

                    strokeColor:'<?php echo $data["territorio_color"]?>',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '<?php echo $data["territorio_color"]?>',
                    fillOpacity: 0.35,
                    path:<?php echo $manzana["manzana_polygon"] ?>,
                    map:map
                });


            <?php
             }?>




            var marker = new google.maps.Marker({
                position: polygonCenter(polygon),
                map: map,
                visible: false
            });

            var infowindow = new google.maps.InfoWindow({
                content: infoHtml
            });
            infowindow.open(map,marker);

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

<div class="row " >
    <?php
    include ("objetos/files-loader.php")?>

</div>


</div>
