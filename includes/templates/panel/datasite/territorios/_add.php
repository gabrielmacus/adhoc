<style>
    .fancybox-close-small
    {
        background-color: white!important;

    }
    .clone
    {
        display:none;
    }
</style>

<form class="row">

    <div class="col s12 m12 l12">

        <h2 class="grey-text">Territorios</h2>
        <?php if($obj)

        {
            ?>

            <h3>Modificando el territorio <?php  echo json_decode($obj,true)[0]["territorio_numero"]?></h3>
            <input name="territorio_id" hidden  >
            <?php
        }
        else
        {
            ?>


            <h3>Creando nuevo territorio</h3>
            <?php
        }?>

        <div class="input-field col s12 m6 l6">
            <input id="numero" type="number" name="territorio_numero" class="validate">
            <label for="numero">Numero del territorio</label>
        </div>

        <div class="input-field col s12 m6 l6">
            <input id="color" name="territorio_color" value="#40FF6E"  class="jscolor  {hash:true}">
        </div>

        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map-wrapper {
                height: 400px
            }
        </style>
        <div class="input-field col s12 m12 l12">
            <div id="map-wrapper" style="position: relative">

                <div id="map" style="position: relative;height:100%;">
                </div>
                <div class="input-field col s6 m4 l4" style="position: absolute;top: 10px;right: 10px;">
                    <input placeholder="Buscar ubicación..."   style="padding-left: 10px" id="search-location"  class="validate white" >

                </div>
            </div>
            <div class="input-field col s12 m12 l12">



            </div>

            <div class="input-field col s12 m12 l12">
                <textarea name="territorio_notas" id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Notas</label>
            </div>

            <script>

                // This example creates a simple polygon representing the Bermuda Triangle.
                var polygonsArray = [];

                $(document).on("click","#delete-territorio",function (e) {




                    var n =$(this).data("territorio");

                        e.preventDefault();
                        var data = new FormData();

                        data.append("territorio_numero",n);


                        $.ajax({
                            url: "territorios-data.php?act=delete",
                            type: "post",
                            dataType: "html",
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (res) {

                                try {
                                    res = JSON.parse(res);




                                    if (res) {

                                        window.location.href="territorios-add.php";
                                    }
                                    else {


                                        error(null, "<?php echo $lang["errors"]["filesError"]["text"]; ?>" + res.error.join());
                                    }

                                }
                                catch (e) {
                                    error();
                                }

                            },
                            error:function (e) {

                                error(e);
                            }
                        })



                });
                function initMap() {


                    $(document).on("submit", "form", function (e) {
                        e.preventDefault();
                        var data = new FormData();
                        var polygons = [];

                        var serialized = $(this).serializeArray();

                        $.each(serialized, function (k, v) {


                            data.append(v["name"], v["value"]);
                        });
                        $.each(polygonsArray, function (k, v) {

                            var manzana = [];
                            $.each(v.getPath().b, function (clave, valor) {

                                var loc = {lat: valor.lat(), lng: valor.lng()};

                                manzana.push(loc);
                            });
                            polygons.push(manzana);
                        });

                        data.append("territorio_polygons", JSON.stringify(polygons));


                        $.ajax({
                            url: "territorios-data.php?act=add",
                            type: "post",
                            dataType: "html",
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (res) {

                                try {
                                    res = JSON.parse(res);

                                    console.log(res);


                                    if (res) {

                                    window.location.reload();
                                    }
                                    else {


                                        error(null, "<?php echo $lang["errors"]["filesError"]["text"]; ?>" + res.error.join());
                                    }

                                }
                                catch (e) {
                                    error();
                                }

                            }
                        })

                    });

                    var geocoder = new google.maps.Geocoder();
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: {lat: 24.886, lng: -70.268},
                        draggableCursor: 'crosshair'
                    });

                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };

                            map.setCenter(pos);
                        });







                    var polygonCoords = [];

                    var points = [];
                    var path = new google.maps.Polyline({
                        strokeColor: '#000000',
                        strokeOpacity: 1.0,
                        strokeWeight: 3,
                        map: map
                    });

                    <?php if($territorios)
                    {
                    
                        ?>      var territorios =<?php echo json_encode($territorios,JSON_NUMERIC_CHECK)?>;

                    

                    $.each(territorios,function (k,v) {

                       var territorioPolygons=JSON.parse(v["territorio_polygons"]);

                        $.each(territorioPolygons,function (key,value) {
                            marcarMapa(value,v["territorio_color"],v["territorio_numero"],true);
                        });



                    });

                    <?Php
                    }?>

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


                    map.addListener('click', function (data) {


                      

                        path.getPath().push(data.latLng);
                        points.push(new google.maps.Marker({
                            position: loc,
                            map: map
                        }));


                    });



                    function marcarMapa(coords,color,territorio,readOnly)
                    {

                        if(!coords || !coords.length)
                        {
                            coords=polygonCoords;
                        }

                        if(!color)
                        {
                            color = "#41f468";
                        }
                        var arrayPolygon=new google.maps.Polygon(
                            {
                                strokeColor:color,
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                fillColor: color,
                                fillOpacity: 0.35,
                                map:map,
                                path:coords
                            }
                        );


                        var infoHtml= "<h6 class='center'>Territorio "+territorio+"</h6>" +
                            "<br>" +
                            "<div style='width: 100%' class=''>" +
                            "<a class='btn ' href='territorios-add.php?n="+territorio+"' style='width: 50%'>Editar</a>" +
                            "<a class='btn'  data-territorio="+territorio+" style='width: 50%' id='delete-territorio' >Eliminar</a>" +
                            "</div>";



                        if(!readOnly)
                        {
                            if(territorio)
                            {
                                var marker = new google.maps.Marker({
                                    position: polygonCenter(arrayPolygon),
                                    map: map,
                                    visible: false
                                });

                                var infowindow = new google.maps.InfoWindow({
                                    content: "<h6>"+territorio+"</h6>"
                                });
                                infowindow.open(map,marker);
                            }

                            arrayPolygon.addListener("click",function()
                            {

                                this.setMap(null);
                                var idx= polygonsArray.indexOf(this);
                                polygonsArray.splice(idx,1);

                                var infowindow = new google.maps.InfoWindow({
                                    content:infoHtml
                                });
                               

                            });

                            polygonsArray.push(arrayPolygon);
                            polygonCoords=[];

                            $.each(points, function (k,v) {

                                v.setMap(null);
                                delete v;
                            });
                            path.setPath([]);
                        }
                        else
                        {
                            arrayPolygon.addListener("click",function()
                            {
                                if(territorio)
                                {
                                    var marker = new google.maps.Marker({
                                        position: polygonCenter(arrayPolygon),
                                        map: map,
                                        visible: false
                                    });

                                    var infowindow = new google.maps.InfoWindow({
                                        content: infoHtml
                                    });
                                    infowindow.open(map,marker);
                                }

                            });
                        }





                        // alert("Area marcada: "+ google.maps.geometry.spherical.computeArea(arrayPolygon.getPath())+"m2");

                    }


                    //map.addListener('rightclick', marcarMapa);

                    $(document).on("click","#marcar-mapa",function () {
                        marcarMapa(null,$("[name='territorio_color']").val(),$("[name='territorio_numero']").val());
                    });
                    $(document).on("keypress","#search-location",function (e) {

                        alert(e.which);
                      if(e.which==13)
                      {
                          e.preventDefault();
                          geocoder.geocode({'address': $(this).val()}, function(results, status) {
                              if (status === google.maps.GeocoderStatus.OK) {


                                  map.setCenter(results[0].geometry.location);

                              } else {
                                  alert('Geocode was not successful for the following reason: ' + status);
                              }
                          });
                      }

                    })


                    <?php if($obj)

                    {
                    ?>

                    var obj = <?php echo $obj; ?>;


                    $.each(obj,function(clave,valor)
                    {
                        $.each(valor,function(k,v)
                        {
                            switch (k){
                                default:
                                    $("[name='"+k+"']").val(v);
                                    break;

                                case "territorio_polygons":


                                    var polygons = JSON.parse(v);


                                    $.each(polygons,function(clave,coordenadas)
                                    {

                                        marcarMapa(coordenadas,valor["territorio_color"],valor["territorio_numero"]);
                                    })

                                    break;
                            }

                        });


                    });


                    <?php
                    }?>





                }

            </script>
           <div class="col s12 center " style="margin-top: 20px">
               <button class="btn aves-effect  waves-light" id="marcar-mapa" type="button">Marcar</button>&nbsp;<button class="btn waves-effect  waves-light" type="submit" >Aceptar
                   <i class="material-icons right">send</i>
               </button>
           </div>




       cl
        </div>



    </div>

    <div class="col s12 input-field" style="margin-top: 15px">

    </div>


</form>

<script>


</script>