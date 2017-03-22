
<script>


$(document).on("submit","form", function () {

    var data =$(this).serializeFormJSON();

    data.salida_encuentro=JSON.stringify(puntoEncuentro);

    data.salida_territorios=[];

    $("#salida_territorios :selected").each(function () {
     data.salida_territorios.push({numero:$(this).val(),id:$(this).data("id")});
    });

    console.log(data);

    $.ajax(
        {
            method:"post",
            url:"salidas-data.php?act=add",
            data:data,
            dataType:"json",
            success:function(res)
            {
                console.log(res);
                if(res)
                {
                    ///location.reload();
                }
                else {
                    error();
                }
            }
            ,
            error:error
        }
    );

});;

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
            <div class="input-field col s12 m6">

                <input hidden name="salida_id">
                <select name="salida_conductor">
                    <option   disabled selected>Conductor...</option>
                <?php

                foreach ($conductores as $k=>$conductor)
                {

                    ?>

                    <option value="<?php echo $k?>"><?php echo $conductor["publicador_apellido"]." ,".$conductor["publicador_nombre"]?></option>
                    <?php
                }?>
                </select>


            </div>

            <div class="input-field col s12 m6">


                <select multiple  id="salida_territorios">
                    <option   disabled selected>Territorios...</option>
                    <?php

                    foreach ($territorios as $k=>$territorio)
                    {

                        ?>

                        <option value="<?php echo $k?>"><?php echo $territorio["territorio_numero"];?></option>
                        <?php
                    }?>
                </select>


            </div>
            <div class="input-field col s12 m4">
                <select name="salida_mes">
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
                <select  name="salida_dia">
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



                <input type="time"  placeholder="Hora" style="display: inline-block"   id="hora" name="salida_hora">

            </div>


        </div>

        <div class="row">
            <div class="input-field col s12 ">

                <h5>Punto de encuentro</h5>
                <div  class="input-field" style="position: relative">

                    <input name="salida_encuentro_string" id="direccion" class="col s12 autocomplete" placeholder="Punto de encuentro..." >

                    <label for="direccion"></label>
                </div>

                <h5>Marcar en el mapa</h5>
                <div id="map" style="height: 300px;width: 100%">

                </div>

            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 ">

                <label for="salida_observaciones">Notas</label>
                <textarea name="salida_observaciones"  class="materialize-textarea"></textarea>
                </div>

         </div>

        <div class="row center">
            <button class="btn" type="submit">Aceptar</button>

        </div>
    </form>
</div>

<script>
    var puntoEncuentro;



    function initMap() {

        $('input.autocomplete').autocomplete({
            data: <?Php echo json_encode($familias); ?>
        });

        var geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -31.7333, lng: -60.5333},
            gestureHandling: 'cooperative'
        });



        var  marker = new google.maps.Marker({
            map: map
        });


        map.addListener("click",function(e){
            markLocation(e.latLng);
            puntoEncuentro = {lat: e.latLng.lat(),lng: e.latLng.lng()};


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


        <?php
        if($obj)
        {

        foreach ($obj as $i)
        {
            foreach ($i as $j)
            {
                foreach ($j as $x)
                {
                    $obj = $x;

                    break;
                }



            }
        }
        ?>    var obj = <?php echo json_encode($obj,JSON_NUMERIC_CHECK) ?>;

        console.log(obj);
        $.each(obj,function(k,v)
        {

            switch (k)
            {
                default:
                    $("[name='"+k+"']").val(v);
                    break;

                case 'salida_encuentro':

                    var loc =JSON.parse(v);
                    console.log(loc);
                    markLocation(loc);
                    break;
                case 'territorios':

                    $.each(v,function (k,v) {


                        var opt=    $("#salida_territorios option[value='"+v["territorio_id"]+"']");
                        opt.attr("selected",true);
                        opt.attr("data-id",v["salidas_territorios_id"]);

                    });


                    break;
            }



        });<?php
        }
        ?>



        $("select").material_select();
        Materialize.updateTextFields();

    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>
