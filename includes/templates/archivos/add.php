
<form>


    <div>
        <label><?php echo $lang["file"]; ?></label>
        <input type="file" name="archivo">
        <label><?php echo $lang["description"]; ?></label>
        <textarea name="archivo_descripcion"></textarea>

    </div>

    <?php if($archivo) {

        ?>
        <input hidden name="archivo_id">


        <?php
    }
    ?>



    <button type="submit">Aceptar</button>

    <script>


        $(document).ready(function () {

            <?php if($archivo)
            {
            $urlSave="archivos-data.php?act=edit&id={$_GET["id"]}";

            ?>


            var archivo=<?php echo $archivo;?>;

            console.log(archivo);
            $.each(archivo,function (k,v) {

                switch (k)
                {
                    default:
                        $("[name='"+k+"']").val(v);
                        break;

                }

            });

            <?php
            }
            else
            {
                $urlSave="archivos-data.php?act=add&rep={$_GET['rep']}";
            }?>

        });

        $(document).on("submit","form",function (e) {

            var files = $(this).find("[name='archivo']")[0].files;

            var data = new FormData();
            $.each(files, function(key, value)
            {
                data.append(key, value);
            });

            var serializedForm =$(this).serializeArray();

            $.each(serializedForm,function(key,value)
            {
                data.append(value["name"], value["value"]);
            });


            $.ajax({
                url: "<?php echo $urlSave;?>",
                type: "post",
                dataType: "html",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(res)
                {

                    res = JSON.parse(res);

                    if(res)
                    {
                      window.location="repositorios.php";
                    }
                }
            })



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
