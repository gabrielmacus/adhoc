
<form>

    <?php if($jugador)
    {
    ?>
    <input hidden name="jugador_id">
    <?php }?>

    <div>
        <label>Foto</label>
        <input id="jugador_foto" type="file">
    </div>
    <div>
        <label>Nombre</label>
        <input name="jugador_nombre">
    </div>

    <div>
        <label>Apellido</label>
        <input name="jugador_apellido">
    </div>

    <div>
        <label>Altura</label>
        <input type="number" name="jugador_altura">
    </div>
    <div>
        <label>Peso</label>
        <input type="number" name="jugador_peso">
    </div>
    <div>
        <label>Pierna</label>
        <select name="jugador_pierna">
            <?php foreach ($lang["piernas"] as $k => $v)
            {
                ?>
                <option value="<?php echo $k;?>"><?php echo $v;?></option>
                <?php
            }?>
        </select>
    </div>
    <div>
        <label>Posicion</label>
        <select name="jugador_posicion">
            <?php foreach ($lang["posiciones"] as $k => $v)
            {
                ?>
                <option value="<?php echo $k;?>"><?php echo $v;?></option>
                <?php
            }?>
            
        </select>
    </div>
    <div>
        <label>Numero</label>
        <input name="jugador_numero" type="number">
    </div>
    
    

    <div class="equipo">

        <a class="fancybox" href="equipos.php?modal=true" data-fancybox-type="iframe" >Seleccionar equipo</a>

        <input hidden name="jugador_equipo" >
        <input name="equipo_nombre" disabled>
    </div>

    <div>
        <label>Notas</label>
        <textarea name="jugador_notas">

        </textarea>
    </div>
    <button type="submit">Aceptar</button>

    <script>

       $(document).ready(function () {
           <?php if($jugador)
           {
           ?>


           var jugador=<?php echo $jugador;?>;

           $.each(jugador,function (k,v) {

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

            var files = $(this).find("#jugador_foto")[0].files;

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
                url: "jugadores-data.php?act=add",
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
                var equipo=e.data;

                $("[name='jugador_equipo']").val(equipo["equipo_id"]);
                $("[name='equipo_nombre']").val(equipo["equipo_nombre"]);


            }

        }, false);

    </script>
</form>
