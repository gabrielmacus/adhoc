
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


    <div class="col s12">

        <ul id="file-list" class="collection">

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

    var adjuntos=[];

    $(document).on("click",".adjunto a",function(){
       var id= $(this).closest(".collection-item").data("id");

        adjuntos[id]=false;

        console.log(adjuntos);


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
                            var html="";

                            $.each(valor,function(k,v){
                                var data= v["archivo_data"];
                                if(data)
                                {
                                    html+="<li class='adjunto collection-item avatar' data-id='"+v["archivo_id"]+"'>" +
                                        "<a  ><i class='fa fa-times right secondary-content' aria-hidden='true'></i></a>"+
                                        "<img style='object-fit: cover' src='"+data["sizes"]["p"]["completeUrl"]+"' class='circle'>" +
                                        "<span class='title'>" ;





                                    var type  = data["type"].split("/");
                                    type=type[0];
                                    switch ( type)
                                    {
                                        case "image":

                                            html+=data["originalName"];


                                            break;
                                        default:

                                            break;
                                    }



                                    html+="</span>" +
                                        "<p>"+formatBytes(data["size"],2)+"</p>" +
                                        "</li>";
                                }



                            });
                            $("#file-list").append(html);

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
                    adjuntos[v]= true;

                });


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

            data.adjuntos = adjuntos;

                var manzana = [];
                $.each(points.getPath().b, function (clave, valor) {

                    var loc = {lat: valor.lat(), lng: valor.lng()};

                    manzana.push(loc);
                });



            data["territorio_polygons"]=  JSON.stringify(manzana);

            console.log(data);


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
