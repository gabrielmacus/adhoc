
<form>

    <div>
        <label>Escudo</label>
        <input id="equipo_escudo" type="file">
    </div>

    <div>
        <label>Nombre</label>
        <input onkeydown="upperCaseF(this)" name="equipo_nombre">
    </div>


    <?php if($equipo) {

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

                        console.log(v);

                        if(v)
                        {
                            $.each(v,function (clave,valor) {

                                if(valor["jugador_id"])
                                {
                                    var HTML="<li >";
                                    HTML+=" <span class='jugador-numero'>"+valor["jugador_numero"]+"</span>";
                                    HTML+=" <span class='jugador-posicion'>"+posiciones[valor["jugador_posicion"]]+"</span>";
                                    HTML+=" <span class='jugador-nombre'>"+valor["jugador_nombre"]+"</span>";
                                    HTML+=" <span class='jugador-apellido'>"+valor["jugador_apellido"]+"</span>";
                                    HTML+=" <span class='jugador-delete' onclick='deleteFromPlantel("+JSON.stringify(valor)+")'>X</span>";


                                    HTML+="</li>";
                                    $(".jugadores ul").append(HTML);
                                }

                            });
                        }




                        break;
                }

            });

            <?php
            }?>

        });

        function deleteFromPlantel(jugador) {



            jugador["jugador_equipo"]=null;
            console.log(jugador);
            $.ajax(
                {

                    "url":"jugadores-data.php?act=add",
                    "method":"post",
                    "data":jugador,
                    "dataType":"json",
                    "success":function (res) {
                       if(res)
                       {
                           window.location.reload();
                       }
                    },
                    "error":function (err) {

                        console.log(err);
                    }
                }
            );

        }
        $(document).on("submit","form",function (e) {


            var files = $(this).find("#equipo_escudo")[0].files;

            var data = new FormData();
            $.each(files, function(key, value)
            {
                data.append(key, value);
            });
            var extraData = $(this).serializeArray();

            $.each(extraData,function(k,v){

                    data.append(v["name"],v["value"]);
                }
            );

            $.ajax({
                url: "equipos-data.php?act=add",
                type: "post",
                dataType: "html",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(res)
                {

                    console.log(res);
                    res = JSON.parse(res);

                    console.log(res);
                }
            });


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
                            "url":"jugadores-data.php?act=add",
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
