
<?php


?>
<form class="row">
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

    <div class="input-field col s12 m12 l6">
       <input id="territorio_numero"  type="number" name="territorio_numero" class="input-field">
        <label for="territorio_numero">Numero</label>
    </div>
    <div class="input-field col s12 m12 l6">
        <input id="territorio_color"  type="text"  name="territorio_color" class="input-field jscolor {hash:true} ">

    </div>
    <div class="input-field col s12">

        <div id="map" style="width: 100%;height: 400px"></div>

    </div>
    <div class="input-field col s12">
        <textarea id="textarea1" name="territorio_notas" class="materialize-textarea"></textarea>
        <label for="textarea1">Notas</label>
    </div>


    <div class="col s12" data-ng-if="adjuntos">

        <h3>Adjuntos</h3>

        <ul id="file-list" class="sortable collection" >


            <li data-ng-if="a.archivo_data.type=='image/jpeg'"class="valign-wrapper collection-item avatar" data-ng-repeat="a in adjuntos" data-id="{{a.archivo_id}}">


                    <a data-fancybox="image" href="{{a.archivo_data.sizes.o.completeUrl}}" class="title valign">{{a.archivo_data.originalName}}</a>
                    <img style="object-fit: cover" data-ng-src="{{a.archivo_data.sizes.p.completeUrl}}" alt="" class="circle">

                <a href="#!" class="secondary-content"><i class="fa fa-times" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>


    <div class="input-field col s12 center">
        <a data-fancybox data-src="files.php?rep=5&modal=true"  class="btn">Adjuntar archivo</a>
        &nbsp;
        <a id="marcar-territorio"  class="btn">Marcar</a>
        &nbsp; <button  type="submit" class="btn">Enviar</button>
    </div>






    <!--
    <div class="file-field input-field col s12">
        <div class="btn">
            <span>Archivo</span>
            <input id="files" type="file" name="files" multiple>
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>
    </div>-->

<script>

    var adjuntos={};

    $(document).on("click",".collection-item a",function(){
        var item= $(this).closest(".collection-item");

       var id= item.data("id");

        if(  !scope.adjuntos[id])
        {
            scope.adjuntos[id]={};

        }
        scope.adjuntos[id]["delete"]=true;

        item.fadeOut(function () {
            item.remove();
        });


    });


    function initMap() {


        var geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: 24.886, lng: -70.268},
            draggableCursor: 'crosshair'
        });
        var points =  new google.maps.Polygon({

            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            draggable:true
        });

        var path= new google.maps.Polyline({

            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map:map
        });
        $(document).on("click","#marcar-territorio",function () {

            marcarTerritorio();
        });
        function marcarTerritorio() {



            points.setPath(path.getPath());
            path.setPath([]);



        }




        $(document).ready(function () {



            scope.adjuntos={};
            <?php

            if($obj)
            {
            ?>
            var obj= <?php echo $obj;?>;

            $.each(obj,function (k,v) {

                $.each(v,function (clave,valor) {

                    switch (clave)
                    {
                        default:

                            $("[name='"+clave+"']").val(valor);

                            break;
                        case 'territorio_polygons':

                            points.setPath(JSON.parse(valor));

                            var color = v["territorio_color"];
                            points.setOptions({strokeColor:color,fillColor: color});

                            break;
                        case 'archivos':


                            scope.adjuntos=valor;

                            scope.$apply();




                            break;
                    }
                })

            });

            <?php
            }?>


        });









        points.addListener("click",function () {

            points.setPath([]);

        });


        points.setMap(map);
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map.setCenter(pos);
        });

        $(document).on("change","#territorio_color",function () {

            var color =$(this).val();
            points.setOptions({strokeColor:color,fillColor: color});
        });

        map.addListener("click",function (data) {

            path.getPath().push(data.latLng);

        });



        function receiveMessage(event)
        {


            if(event.origin==location.origin)
            {


            $.each(event.data,function(k,v)
                {

                    scope.adjuntos[v["archivo_id"]]=v;

                  //  delete      adjuntos[v["archivo_id"]]["archivo_data"];
                });

     scope.$apply();



            }
        }

        window.addEventListener("message", receiveMessage, false);
        
        

        $(document).on("submit", "form", function (e) {


            e.preventDefault();
            var data = {};
            var serialized = $(this).serializeArray();
            $.each(serialized, function (k, v) {

                data[v["name"]] = v["value"];
            });

            data.adjuntos = scope.adjuntos;

                var manzana = [];
                $.each(points.getPath().b, function (clave, valor) {

                    var loc = {lat: valor.lat(), lng: valor.lng()};

                    manzana.push(loc);
                });



            data["territorio_polygons"]=  JSON.stringify(manzana);



            $.ajax(
                {
                    url: "territorios-data.php?act=add",
                    method: "post",
                    dataType: "json",
                    data: data,
                    success: function (res) {

                        console.log(res);
                        if(res)
                        {

                        }
                        else
                        {
                            error();
                        }
                    },
                    error: function (err) {

                        console.log(err);
                        error(err);
                    }
                }
            );

        });

    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>
    <ul class="sortable">
        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
    </ul>