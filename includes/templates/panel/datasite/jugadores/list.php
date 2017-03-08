
<script>
    function seleccionarJugador(target,data) {
        var id =$(target).closest(".jugador").data("id");

        parent.postMessage(data,"<?php echo $config["address"]?>");
        javascript:parent.$.fancybox.close();
    }


</script>
<ul>
    <?php
    foreach ($dataToSkin as $item)
    {
        ?>
        <li class="jugador">

            <?php echo $item["jugador_nombre"] ?>   <?php echo $item["jugador_apellido"] ?>
            <?php if(isset($_GET["modal"]))
            {
                ?>
                <span onclick='seleccionarJugador(this,<?php echo json_encode($item);?>)'>Seleccionar</span>

                <?php
            }?>
        </li>
        <?php
    }?>
</ul>