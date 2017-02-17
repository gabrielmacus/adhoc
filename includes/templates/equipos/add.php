
<form>

    <div>
        <label>Nombre</label>
        <input name="equipo_nombre">
    </div>


    <?php if($equipo) {
        var_dump($equipo);
        ?>
        <input hidden name="equipo_id">

        <div class="jugadores">
            <a class="fancybox" href="jugadores.php?modal=true" data-fancybox-type="iframe" >Armar plantel</a>

            <ul>

            </ul>

        </div>

        <?php
    }
    ?>



    <button type="submit">Aceptar</button>

    <script>

        var posiciones  = <?php echo json_encode($lang["posiciones"])?>;
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
                    case 'jugadores':



                        $.each(v,function (clave,valor) {

                            var HTML="<li >";
                            HTML+=" <span class='jugador-numero'>"+valor["jugador_numero"]+"</span>";
                            HTML+=" <span class='jugador-posicion'>"+posiciones[valor["jugador_posicion"]]+"</span>";
                            HTML+=" <span class='jugador-nombre'>"+valor["jugador_nombre"]+"</span>";
                            HTML+=" <span class='jugador-apellido'>"+valor["jugador_apellido"]+"</span>";
                            HTML+=" <span class='jugador-delete' onclick='deleteFromPlantel("+valor+")'>X</span>";


                            HTML+="</li>";
                            $(".jugadores ul").append(HTML);
                        });


                        break;
                }

            });

            <?php
            }?>

        });

        function deleteFromPlantel(jugador) {

            jugador["jugador_equipo"]="";
            $.ajax(
                {

                    "url":"jugadores-data.php?act=add",
                    "method":"post",
                    "data":jugador,
                    "dataType":"json",
                    "success":function (res) {
                        console.log(res);
                    },
                    "error":function (err) {

                        console.log(err);
                    }
                }
            );

        }
        $(document).on("submit","form",function (e) {

            var data = $(this).serialize();
            $.ajax(
                {
                    "url":"equipos-data.php?act=add",
                    "method":"post",
                    "data":data,
                    "dataType":"json",
                    "success":function (res) {
                        console.log(res);
                    },
                    "error":function (err) {

                    console.log(err);
                    }
                }
            );
            e.preventDefault();
        });


        window.addEventListener("message", function (e) {

            if(e.origin=="<?php echo $config["address"]?>")
            {
                var jugador=e.data;

                if($.isNumeric(jugador))
                {

                }
                else
                {

                    delete jugador.equipo_id;
                    delete jugador.equipo_nombre;
                    delete jugador.equipo_bandera;

                    jugador.jugador_equipo=<?php  echo $equipo?>["equipo_id"];

                    console.log(jugador);

                    $.ajax(
                        {
                            "method":"post",
                            "url":"jugadores-add.php?act=add",
                            "dataType":"json",
                            "data":jugador,
                            "success":function (res) {

                              if(res)
                              {
                                  window.location.reload();
                              }
                            }
                            ,"error":function (err) {
                            console.log(err);
                                 }
                        }
                    );




                }


            }

        }, false);

    </script>
</form>
