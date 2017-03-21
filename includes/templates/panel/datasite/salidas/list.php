

<?php

foreach($dataToSkin as $item)
{

}
?>



<div class="row">
    <ul class="collection">
        <?php

        foreach ($dataToSkin as $item)
        {
            ?>
            <li class="collection-item" style="position:relative;">
                <a style="position: absolute;right: 10px;top:10px;" href="publicador-add.php?id=<?php  echo $item["publicador_id"]?>" class="material-icons black-text">edit</a>

                <h3 style="font-size: 23px"><?php echo $item["publicador_apellido"]?>, <?php echo $item["publicador_nombre"]?></h3>
                <div class="row ">
                    <div class="col s12 m6 l3">
                        <b  style="text-decoration: underline">Grupo</b><h4 class="truncate " style="font-size: 18px"><?php echo $item["publicador_grupo"]?> </h4>
                    </div>

                    <div class="col s12 m6 l3">
                        <b style="text-decoration: underline">Direccion</b>
                        <a data-fancybox="iframe"  data-caption="<?php echo $item["publicador_direccion_string"]?>" href="publicadores.php?id=<?php echo $item["publicador_id"]?>&modal=true&act=map"><h4 class="truncate tooltipped" data-tooltip="<?php echo $item["publicador_direccion_string"]?>" style="font-size: 18px"><?php echo $item["publicador_direccion_string"]?>
                            </h4></a>
                    </div>
                    <div class="col s12 m6 l3">
                        <b style="text-decoration: underline">Telefonos</b>
                        <div>
                            <?php
                            $telefonos = explode(",",$item["publicador_telefonos"]);

                            foreach ($telefonos as $t)
                            {
                                ?>

                                <h4    class="chip" style="font-size: 18px;margin-top: 5px"><?php echo $t?></h4>

                                <?php
                            }
                            ?>


                        </div>

                    </div>

                    <div class="col s12 m6 l3">
                        <b style="text-decoration: underline">Edad</b><h4 style="font-size: 18px"><?php echo $item["publicador_edad"]?> años</h4>
                    </div>
                </div>

            </li>

            <?php
        }?>

    </ul>



    <?php include "includes/templates/panel/framework/paginators/pager.php"; ?>
</div>

