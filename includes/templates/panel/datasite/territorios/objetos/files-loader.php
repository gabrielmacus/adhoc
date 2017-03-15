<?php
if(count($dataToSkin)==1)
{
    foreach ($dataToSkin as $data)
    {
        ?>

        <h3>Datos del territorio</h3>



        <?php


        $archivos = $data["archivos"];


        if(count($archivos)>0) {


            ?>
            <h4 class="grey-text">Archivos adjuntos</h4>

            <?php
        }


        foreach ($archivos as $archivo)
        {


            $archivo=$archivo["archivo_data"];
            $type= explode(".",$archivo["name"]);
            $type= $type[count($type)-1];


            switch ($type)
            {
                case "jpg":
                case "png":
                case "gif":


                    ?>
                    <a data-fancybox="image" data-src="<?php echo $archivo["sizes"]["o"]["completeUrl"]?>" class="col s12 m6 l4">
                        <figure style="padding: 0px;margin: 0px;">

                            <img style="width: 100%;height:200px;object-fit: cover" src="<?php echo $archivo["sizes"]["p"]["completeUrl"]?>">
                        </figure>
                    </a>


                    <?php

                    break;
            }



            ?>

            <?php
        }

        ?>



        <?Php
    }

    ?>




    <?php
}
?>
