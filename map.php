<style>
    body
    {
        height: 100%;
        margin: 0;
        padding: 0;
    }

</style>

<body>

<div style="height: 100%;width: 100%" id="map">

</div>
<script>
    function initMap() {


        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -31.7333, lng: -60.5333},
            gestureHandling: 'cooperative'
        });




        var  marker = new google.maps.Marker({
            map: map
        });
        function  markLocation(loc) {
            marker.setPosition(loc);
            map.setCenter(loc);

        }


        <?php
        if(isset($_GET["lat"])&& isset($_GET["lng"]))
        {
            ?>
        markLocation({lat:<?php echo $_GET["lat"]?>,lng:<?php echo $_GET["lng"]?>});
        <?php
        }else
        {
            ?>
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map.setCenter(pos);
        });
        <?php
        }?>



    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxqL3eG6quOKEbnY7d00DUPX0h5yoqS5Q&callback=initMap"></script>



</body>