
<script>

    $(document).on("submit","form",function () {



        console.log(  scope.salida);
        $.ajax(
            {url:"salidas-data.php?act=add",
                dataType:"json",
                method:"post",
                data:scope.salida,
                error:function (err) {

                    console.log(err);
                    error(err);
                }  ,
                success:function (res) {

                    console.log(res);
                }
            }
        )
    });




    /*$(document).on("click","#add-telefono",function () {


        var t=angular.copy(scope.telefono);
        if(t!="")
        {
            scope.publicador.publicador_telefonos.push(t);
            scope.telefono="";
            scope.$apply();
        }



    });*/

</script>



<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s12">

                <select name="conductor " class="browser-default" data-ng-model="salida.salida_conductor">
                    <option  selected disabled>Conductor...</option>
                <?php

                foreach ($conductores as $k=>$conductor)
                {

                    ?>

                    <option value="<?php echo $k?>"><?php echo $conductor["publicador_apellido"]." ,".$conductor["publicador_nombre"]?></option>
                    <?php
                }?>
                </select>
                
                
            </div>
            <div class="input-field col s12 m4">
                <select class="browser-default" data-ng-model="salida.salida_mes">
                    <option disabled selected>Mes...</option>
                    <?php
                    foreach ($lang["meses"] as $k=>$v)
                    {
                        ?>
                        <option value="<?php echo $k?>"><?php echo $v?></option>
                        <?php
                    }?>
                    </select>

            </div>
            <div class="input-field col s12 m4">
                <select  class="browser-default" data-ng-model="salida.salida_dia">
                    <option disabled selected>Dia...</option>
                    <?php
                    foreach ($lang["dias"] as $k=>$v)
                    {
                        ?>
                        <option value="<?php echo $k?>"><?php echo $v?></option>
                        <?php
                    }?>
                </select>

            </div>


            <div class="input-field col s12 m4">
               <label for="hora">Hora</label>


                <input  style="display: inline-block" type="text" data-ng-model="salida.salida_hora" id="hora" name="hora">
         
            </div>


        </div>

        <div class="row">
            <div class="input-field col s12 ">

                <h5>Direccion</h5>
                <div style="position: relative">
                    <input data-ng-model="salida.salida_encuentro_string" id="direccion" class="col s12 m10" placeholder="Buscar por calle y numero..." >
                    <div class=" col s12 m2 right" style="padding: 10px;    padding-right: 0px!important">
                        <button type="button" id="buscar-direccion"  style="width: 100%" class="btn " ><i class="material-icons">search</i></button>
                    </div>

                </div>


                <div id="map" style="height: 300px;width: 100%">

                </div>

            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 ">

                <label for="notas">Notas</label>
                <textarea name="notas" data-ng-model="salida.salida_observaciones" class="materialize-textarea"></textarea>
                </div>

         </div>

        <div class="row center">
            <button class="btn" type="submit">Aceptar</button>

        </div>
    </form>
</div>
<script>
    function initMap() {


        var geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -31.7333, lng: -60.5333},
            gestureHandling: 'cooperative'
        });

        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map.setCenter(pos);
        });

        var path = new google.maps.Polyline({

            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
        });
        var  marker = new google.maps.Marker({
            map: map
        });
        function  markLocation(loc) {
            map.setCenter(loc);
            marker.setPosition(loc);
        }
        function geocode(data,reverse,callback) {

            if(!reverse)
            {
                var geoInfo={ 'address': data};
            }
            else
            {
                var geoInfo={ 'location': data};
            }


            geocoder.geocode( geoInfo, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {



                    if(callback)
                    {
                        callback(results);
                    }


                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });

        }
        $(document).on("click","#buscar-direccion",function () {

            var dir=$("#direccion").val()+" Paraná Entre Rios";
            if(dir!="")
            {
                geocode(dir,false,function (results) {
                    var loc=results[0].geometry.location;
                    markLocation(loc);

                    scope.salida.salida_encuentro=JSON.stringify({lat:loc.lat(),lng:loc.lng()});

                    scope.$apply();
                });

            }

        });

        angular.element(document).ready(function () {

            Materialize.updateTextFields();
            scope.salida={};
/*            scope.publicador.publicador_telefonos=[];
            scope.deleteTelefono=function (tel) {
                var idx=    scope.publicador.publicador_telefonos.indexOf(tel);

                scope.publicador.publicador_telefonos.splice(idx,1);

            }*/

            <?php
            if($obj)
            {
            ?>

            var obj= <?php echo $obj;?>;

            console.log(obj);
            $.each(obj,function (k,v) {

                switch (k)
                {
                    default:

                        if(v)
                        {
                            console.log(k+" "+v);
                            scope["salida"][k]=v;
                        }


                        break;

                    case "salida_encuentro":
                        var dir=JSON.parse(v);
                        markLocation(dir);

                        /*
                         geocode(dir,true,function (results) {

                         scope.dir= results[0].formatted_address;

                         scope.$apply();
                         });*/


                        break;
                }
            })  ;



            <?php
            }
            ?>

            scope.$apply();
            console.log( scope.salida);
        });


    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>
