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
        <h2>Crear territorio</h2>

        <?php if($obj)

        {
            ?>

            <input name="territorio_id" hidden  >
            <?php
        }?>

        <div class="input-field col s12 m6 l6">
            <input id="numero" type="number" name="territorio_numero" class="validate">
            <label for="numero">Numero del territorio</label>
        </div>

        <div class="input-field col s12 m6 l6">
            <input id="color" name="territorio_color"  class="jscolor  {hash:true}">
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
                <textarea name="territorio_notas" id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Notas</label>
            </div>

            <script>

                // This example creates a simple polygon representing the Bermuda Triangle.
                var polygonsArray = [];
                function initMap() {



                    $(document).on("submit","form",function (e) {
                        e.preventDefault();
                        var data = new FormData();
                        var polygons= [];

                        var serialized = $(this).serializeArray();

                        $.each(serialized,function (k,v) {


                            data.append(v["name"],v["value"]);
                        });
                        $.each(polygonsArray,function(k,v)
                        {

                            var manzana=[];
                            $.each(v.getPath().b,function(clave,valor){

                                var loc ={lat:valor.lat(),lng:valor.lng()};

                                manzana.push(loc);
                            });
                            polygons.push(manzana);
                        });

                        data.append("territorio_polygons",JSON.stringify(polygons));



                        $.ajax({
                            url: "territorios-data.php?act=add",
                            type: "post",
                            dataType: "html",
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(res)
                            {

                                try{
                                    res = JSON.parse(res);

                                    console.log(res);



                                    if( res)
                                    {

                                        //window.location="territor.php?rep="+res;
                                    }
                                    else
                                    {


                                        error(null,"<?php echo $lang["errors"]["filesError"]["text"]; ?>"+res.error.join());
                                    }

                                }
                                catch(e)
                                {
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










                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };

                            map.setCenter(pos);
                        });
                    }


                    var polygonCoords = [];

                    var points = [];
                    var path = new google.maps.Polyline({
                        strokeColor: '#000000',
                        strokeOpacity: 1.0,
                        strokeWeight: 3,
                        map: map
                    });

                    var territorios = <?php echo $territorios?>;


                    $.each(territorios,function (k,v) {

                        console.log(JSON.parse(v["territorio_polygons"]));

                        marcarMapa(JSON.parse(v["territorio_polygons"]));
                        /* var poly=  new google.maps.Polygon(
                         {
                         strokeColor:"#2d2e30",
                         strokeOpacity: 0.8,
                         strokeWeight: 2,
                         fillColor: "#2d2e30",
                         fillOpacity: 0.35,
                         map:map,
                         path:JSON.parse(v["territorio_polygons"])
                         }
                         );*/


                    });
                    map.addListener('click', function (data) {


                        var lat = data.latLng.lat();
                        var lng = data.latLng.lng();

                        var loc = {lat: lat, lng: lng};
                        polygonCoords.push(loc);


                        path.getPath().push(data.latLng);
                        points.push(new google.maps.Marker({
                            position: loc,
                            map: map
                        }));


                    });


                    function marcarMapa(coords,color)
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



                        arrayPolygon.addListener("click",function()
                        {

                            this.setMap(null);
                            var idx= polygonsArray.indexOf(this);
                            polygonsArray.splice(idx,1);


                        });


                        polygonsArray.push(arrayPolygon);
                        polygonCoords=[];

                        $.each(points, function (k,v) {

                            v.setMap(null);
                            delete v;
                        });
                        path.setPath([]);

                        // alert("Area marcada: "+ google.maps.geometry.spherical.computeArea(arrayPolygon.getPath())+"m2");

                    }


                    //map.addListener('rightclick', marcarMapa);

                    $(document).on("click","#marcar-mapa",function () {


                        marcarMapa();
                    });
                    $(document).on("keypress","#search-location",function (e) {

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

                                    console.log(polygons);
                                    $.each(polygons,function(clave,coordenadas)
                                    {

                                        marcarMapa(coordenadas,valor["territorio_color"]);
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
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>


        </div>



    </div>

    <div class="col s12 input-field" style="margin-top: 15px">

    </div>


</form>

<script>


</script>