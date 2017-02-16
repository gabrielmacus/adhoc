
<form>


    <input hidden name="jugador_id">
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

            var data = $(this).serialize();
            $.ajax(
                {
                    "url":"jugadores-add.php?act=add",
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
