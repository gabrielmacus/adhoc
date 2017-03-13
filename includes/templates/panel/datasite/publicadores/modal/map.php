
<style>
    .navbar
    {
        display: none;
    }
    .body
    {
        width:100%;
        height: 100%;
        padding: 0px;
        background-color: white;
    }

</style>
<div style="height: 100%;width: 100%" id="map">

</div>
<script>
    function initMap() {


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


        var  marker = new google.maps.Marker({
            map: map
        });
        function  markLocation(loc) {
            map.setCenter(loc);
            marker.setPosition(loc);
        }


        <?php foreach ($dataToSkin as $item) {

        $loc  =$item["publicador_direccion"];
        ?>
        var loc  = <?php echo $loc?>;

        console.log(loc);

        <?php


    break;} ?>
        markLocation(loc);


    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>
