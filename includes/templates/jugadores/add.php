

<a class="fancybox" href="equipos.php?modal=true" data-fancybox-type="iframe" >Seleccionar equipo</a>

<script>
    window.addEventListener("message", function (e) {

        if(e.origin=="<?php echo $config["address"]?>")
        {
           console.log(e.data);
        }

    }, false);

</script>