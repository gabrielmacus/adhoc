
<form>


    <input hidden name="equipo_id">
    <div>
        <label>Nombre</label>
        <input name="equipo_nombre">
    </div>

    <div class="jugadores">
        <a class="fancybox" href="jugadores.php?modal=true" data-fancybox-type="iframe" >Armar plantel</a>


    </div>

    <button type="submit">Aceptar</button>

    <script>

        $(document).ready(function () {
            <?php if($equipo)
            {
            ?>


            var equipo=<?php echo $equipo;?>;

            $.each(equipo,function (k,v) {

                switch (k)
                {
                    default:
                        $("[name='"+k+"']").val(v);
                        break;
                }

            });

            <?php
            }?>

        });
        $(document).on("submit","form",function (e) {

            var data = $(this).serialize();
            $.ajax(
                {
                    "url":"equipos-add.php?act=add",
                    "method":"post",
                    "data":data,
                    "dataType":"json",
                    "success":function (res) {
                        console.log(res);
                    },
                    "error":function (err) {

                        throw err;
                    }
                }
            );
            e.preventDefault();
        });


        window.addEventListener("message", function (e) {

            if(e.origin=="<?php echo $config["address"]?>")
            {
                var equipo=e.data;

                $("[name='jugador_equipo']").val(equipo["equipo_id"]);
                $("[name='equipo_nombre']").html(equipo["equipo_nombre"]);


            }

        }, false);

    </script>
</form>
