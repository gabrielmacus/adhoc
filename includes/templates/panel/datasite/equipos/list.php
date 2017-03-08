<ul>

    <script>
        function seleccionarEquipo(target,data) {
            var id =$(target).closest(".equipo").data("id");

            parent.postMessage(data,"<?php echo $config["address"]?>");
            javascript:parent.$.fancybox.close();
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
                <a onclick='seleccionarEquipo(this,<?php echo json_encode($item);?>)' class="seleccionar-equipo">Select</a>

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

            <ul>
                <?php
                foreach($item["archivos"] as $file)
                {
                    $json=stripslashes($file["archivo_data"]);
                   $file = json_decode($json,true);
                    ?>

                    <img style="width: 100%" src="<?php echo $file["o"]["completeUrl"]; ?>">

                    <?php

                }?>

            </ul>

            <div>

            </div>

            <h3>Equipacion</h3>

            <ul>
                <?php

                $item["jugadores"]=array_sort($item["jugadores"],"jugador_posicion");


                foreach ($item["jugadores"] as $jugador)
                {
                    ?>
                    
                    <li>
                        <div>
                            <span><?php echo $jugador["jugador_nombre"];?></span>
                            <span><?php echo $jugador["jugador_apellido"];?></span>
                            <span><?php echo $jugador["jugador_peso"];?></span>
                        </div>
                    </li>

                      


                    <?php
                }
                
                if(count($item["jugadores"])==0)
                {
                    ?>
                    
                    <h4><?php echo $lang["teamnoplayers"];?></h4>
                    
                    <?php
                }
                ?>
                

            </ul>

            <script>

            </script>

        </li>

        <?php
    }

    ?>

</ul>