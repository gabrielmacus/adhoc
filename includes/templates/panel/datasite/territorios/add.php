
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


    <div class="col s12" data-ng-if="notEmpty(adjuntos)">

        <h3>Adjuntos</h3>

        <ul id="file-list" class="sortable collection"   >


            <li data-ng-if="a.archivo_data.type=='image/jpeg'"class="valign-wrapper collection-item avatar" data-ng-repeat="a in adjuntos" data-id="{{a.archivo_id}}">


                    <a data-fancybox="image" href="{{a.archivo_data.sizes.o.completeUrl}}" class="title valign">{{a.archivo_data.originalName}}</a>
                    <img style="object-fit: cover" data-ng-src="{{a.archivo_data.sizes.p.completeUrl}}" alt="" class="circle">

                <a href="#!" class="secondary-content"><i class="fa fa-times" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>


    <div class="input-field col s12 center">
        <a  href="files.php?rep=<?php foreach ($repositorios as $k=>$v){echo $k; break;}?>&modal=true&cache=false" data-lity  class="btn iframe">Adjuntar archivo</a>
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



</script>

    <script>
        function initMap() {


            var geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: {lat: -31.7333 , lng: -60.5333},
                draggableCursor: 'crosshair',
                gestureHandling:'cooperative'
            });

            var path= new google.maps.Polyline({

                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2,
                map:map
            });



            var manzanas=[];
            var colorArray=[];
            $(document).on("click","#marcar-territorio",function () {

                marcarTerritorio(path.getPath());
            });
            function marcarTerritorio(coords,id) {




                path.setPath([]);

                var color=$("#territorio_color").val();
                var manzana=new google.maps.Polygon({

                    strokeColor: color,
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: color,
                    fillOpacity: 0.35,
                    draggable:true,
                    path:coords
                });



                manzana.addListener("click",function () {



                    if(!id)
                    {
                        manzana.setPath([]);

                        manzanas.splice(manzanas.indexOf(manzana),1);

                    }
                    else
                    {
                        manzana.setPath([{lat:0,lng:id},{lat:0,lng:0},{lat:0,lng:0},{lat:0,lng:0}]);
                        manzanas.push(manzana);

                    }





                });


                manzana.setMap(map);




                if(!id)
                {   manzanas.push(manzana);

                }
                colorArray.push(manzana)




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
                            case 'manzanas':


                                $.each(valor,function(k,manzana)
                                {
                                    id = manzana["manzana_id"];
                                    manzana=JSON.parse(manzana["manzana_polygon"]);
                                    marcarTerritorio(manzana,id);
                                    $("#territorio_color").val( v["territorio_color"]);
                                });





                                break;
                            case 'archivos':


                                scope.adjuntos=valor;

                                scope.$apply();



                                console.log(scope.adjuntos);
                                break;
                        }
                    })

                });

                <?php
                }?>


            });






            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map.setCenter(pos);
            });

            $(document).on("change","#territorio_color",function () {

                var color =$(this).val();
                $.each(colorArray,function(k,v)
                {
                    v.setOptions({strokeColor:color,fillColor: color});
                });

            });

            map.addListener("click",function (data) {

                path.getPath().push(data.latLng);

            });



            function receiveMessage(event)
            {


                if(event.origin==location.origin)
                {

                    console.log(event.data);

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


                var manzanasJSON=[];

                $.each(manzanas,function(k,manzana)
                {
                    var manzanaJSON=[];



                    $.each(manzana.getPath().b, function (clave, valor) {



                        var loc = {lat: valor.lat(), lng: valor.lng()};

                        manzanaJSON.push(loc);
                    });

                    if(manzanaJSON.length>0)
                    {
                        if(manzanaJSON[0].lat==0)
                        {
                            id=manzanaJSON[0].lng;
                            manzanaJSON={};
                            manzanaJSON["delete"]=true;
                            manzanaJSON["manzana_id"]=id;
                        }


                        manzanasJSON.push(manzanaJSON);

                    }


                });




                data["territorio_polygons"]=  JSON.stringify(manzanasJSON);



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
