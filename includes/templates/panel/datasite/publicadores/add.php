
<script>

    $(document).on("submit","form",function () {

        scope.publicador.publicador_telefonos=   scope.publicador.publicador_telefonos.join();

        console.log(  scope.publicador);
      $.ajax(
          {url:"publicadores-data.php?act=add",
          dataType:"json",
          method:"post",
              data:scope.publicador,
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




    $(document).on("click","#add-telefono",function () {


        var t=angular.copy(scope.telefono);
        if(t!="")
        {
            scope.publicador.publicador_telefonos.push(t);
            scope.telefono="";
            scope.$apply();
        }



    });

</script>
<div class="row">
    <form class="col s12">
        <div class="row">
            <div class="input-field col s12 m6">
                <input data-ng-model="publicador.publicador_nombre" id="first_name" type="text">
                <label for="first_name">Nombre</label>
            </div>
            <div class="input-field col s12 m6">
                <input  data-ng-model="publicador.publicador_apellido" name="publicador_apellido" id="last_name" type="text" >
                <label for="last_name">Apellido</label>
            </div>
        </div>
        <div class="row">

            <div class="input-field col s12 m6">
                <input   data-ng-model="publicador.publicador_grupo" name="grupo" id="grupo">
                <label for="grupo">Grupo</label>
            </div>
            <div class="input-field col s12 m6">
                <input   data-ng-model="publicador.publicador_edad" name="age" id="age">
                <label for="age">Edad (opcional)</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 ">
                <span style="font-size: 25px">Telefonos</span>

                <div >
                     <input placeholder="Telefono" data-ng-model="telefono" class="col s12 m10">
                    <div class=" col s12 m2 right" style="padding: 10px;    padding-right: 0px!important">
                        <button type="button" style="width: 100%" id="add-telefono" class="btn"><i class="material-icons">add</i></button>
                    </div>

                </div>

                <ul class="collection col s12" data-ng-if="publicador.publicador_telefonos.length > 0">
                   <li class="collection-item " style="position: relative" data-ng-repeat="t in publicador.publicador_telefonos">
                       <h5>{{t}}</h5>
                       <span class="red-text btn white" style="position: absolute;right: 10px;top: 10px;" data-ng-click="deleteTelefono(t)"><i class="material-icons">delete</i></span>
                   </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 ">

                <h5>Direccion</h5>
                <div style="position: relative">
                    <input data-ng-model="publicador.publicador_direccion_string" id="direccion" class="col s12 m10" placeholder="Buscar por calle y numero..." >
                    <div class=" col s12 m2 right" style="padding: 10px;    padding-right: 0px!important">
                        <button type="button" id="buscar-direccion"  style="width: 100%" class="btn " ><i class="material-icons">search</i></button>
                        </div>

                </div>


                <div id="map" style="height: 300px;width: 100%">

                </div>

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

                    scope.publicador.publicador_direccion=JSON.stringify({lat:loc.lat(),lng:loc.lng()});

                    scope.$apply();
                });

            }

        });

        angular.element(document).ready(function () {
            scope.publicador={};
            scope.publicador.publicador_telefonos=[];
            scope.deleteTelefono=function (tel) {
                var idx=    scope.publicador.publicador_telefonos.indexOf(tel);

                scope.publicador.publicador_telefonos.splice(idx,1);

            }

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
                            scope["publicador"][k]=v;
                        }


                        break;
                    case "publicador_telefonos":
                        if(v)
                        {  scope.publicador[k] = v.split(",");


                        }

                        break;
                    case "publicador_direccion":
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
            console.log( scope.publicador);
        });


    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>
