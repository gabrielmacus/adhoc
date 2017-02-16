<ul>

    <script>
        function seleccionarEquipo(target,data) {
            var id =$(target).closest(".equipo").data("id");

            parent.postMessage(data,"<?php echo $config["address"]?>");

        }

    </script>
    <?php
    foreach ($dataToSkin as $item) {

        ?>

        <li class="equipo" data-id="<?php echo $item["equipo_id"];?>">
            <?php
            if(isset($_GET["modal"]))
            {
                ?>
                <a onclick='seleccionarEquipo(this,"<?php echo json_encode($item);?>")' class="seleccionar-equipo">Select</a>

                <?php
            }
            ?>

           <h2><?php echo $item["equipo_nombre"];?></h2>

                <?php
                if(!empty($item["equipo_bandera"]))
                {
                    $bandera = json_decode($item,true);
                    ?>
            <figure>
                <img src="<?php echo $bandera["src"]["o"];?>">
            </figure>

             <?php
                }?>

            <h3>Equipacion</h3>

            <ul>
                <?php

                var_dump($item["jugadores"]);
                foreach ($item["jugadores"] as $jugador)
                {
                    ?>

                    <div>
                        <span><?php echo $jugador["jugador_nombre"];?></span>
                        <span><?php echo $jugador["jugador_apellido"];?></span>
                        <span><?php echo $jugador["jugador_peso"];?></span>
                    </div>

                    <?php
                }?>
            </ul>

            <script>

            </script>

        </li>

        <?php
    }

    ?>

</ul>