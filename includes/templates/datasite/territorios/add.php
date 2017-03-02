

<form class="row">
    <h3>Nuevo territorio</h3>
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

    <div class="input-field col s12 center">

        <button id="marcar-territorio" type="button" class="btn">Marcar</button>
        &nbsp; <button  type="submit" class="btn">Enviar</button>
    </div>
    <div class="input-field col s12">
        <textarea id="textarea1" name="territorio_notas" class="materialize-textarea"></textarea>
        <label for="textarea1">Notas</label>
    </div>
    <div class="file-field input-field col s12">
        <div class="btn">
            <span>Archivo</span>
            <input id="files" type="file" name="files" multiple>
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>
    </div>

<script>


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
            fillOpacity: 0.35
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


        $(document).on("submit", "form", function (e) {
            e.preventDefault();
            var data = new FormData();
            var serialized = $(this).serializeArray();
            var territorio=[];

            var files = document.querySelector("#files").files;

            console.log(files);

            $.each(files,function (k,v) {

                data.append(k,v);
            });

            $.each(serialized, function (k, v) {


                data.append(v["name"], v["value"]);
            });

                $.each(points.getPath().b, function (clave, valor) {

                    var loc = {lat: valor.lat(), lng: valor.lng()};
                    territorio.push(loc);

                });




            data.append("territorio_polygons", JSON.stringify(territorio));


            $.ajax({
                url: "territorios-data.php?act=add",
                type: "post",
                dataType: "html",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log(res);
                    try {


                        res = JSON.parse(res);



                        console.log(res);
                        if (res) {

                        //window.location.reload();
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

    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>
