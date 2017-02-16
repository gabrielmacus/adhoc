<ul>
    <?php
    foreach ($dataToSkin as $item) {

        ?>

        <li>
           <h2><?php echo $item["equipo_nombre"];?></h2>

                <?php
                if(!empty($item["equipo_bandera"]))
                {
                    $bandera = json_decode($item,true);
                    ?>
            <figure>
                <img src="<?php echo $bandera["src"]["o"];?>">
            </figure>
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
             <?php
                }?>


            <?php
            var_dump($item)?>

        </li>

        <?php
    }

    ?>

</ul>