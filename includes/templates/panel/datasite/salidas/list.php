<script>
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });
</script>
<div class="row">
    <style> .tabla .data-chips
        {
          /*  margin-top: 5px;
        */
        padding: 10px}
        .tabla .data
        {
            /*margin-top: 8px;
        */

          padding: 15px;
        }

    </style>
    <?php

    foreach ($dataToSkin as $y =>$m)
    {
        ?>
        <h3 class="teal white-text lighten-1" style="padding: 10px;font-size: 25px">Salidas <?php echo $y?></h3>


        <?php
        foreach ($m as $k=>$v)
        {
?>

            <ul class=" tabla collection with-header" style="width: 100%;position: relative;">
                <li class="collection-header"><h4><?php  echo  $lang["meses"][$k]?></h4></li>


                        <li style="padding-left: 35px" class="header collection-item row  hide-on-small-only">
                            <div class="col s12 m2">
                                <b>Dia</b>
                            </div>

                            <div class="col s12 m2">
                                <b>Hora</b>
                            </div>
                            <div class="col s12 m3">
                                <b>Territorios</b>
                            </div>

                            <div class="col s12 m3">
                                <b>Punto de encuentro</b>
                            </div>

                            <div class="col s12 m2">
                                <b>Notas</b>
                            </div>
                        </li>



                        <?php
                        foreach ($v as $item)
                        {

                            ?>



                            <li class="collection-item row " style="position: relative">


                                <div class="col s6 m2 data" >
                                    <?php echo  $lang["dias"][$item["salida_dia"]];?>
                                </div>

                                <div class="col s6 m2 data">
                                    <time><?php echo  $item["salida_hora"];?></time>
                                </div>


                                <div class="col s6 m3 data-chips">

                                    <?php
                                    if($item["territorios"]) {
                                        ?>
                                        <?php
                                        foreach ($item["territorios"] as $t) {

                                            ?>

                                            <span class="chip"><?php echo $t["territorio_numero"] ?></span>

                                            <?Php
                                        }

                                        ?> <?php
                                    }

                                    ?>
                                </div>
                                <div class="col s6 m2 data">
                                    <?php
                                    $loc = json_decode($item["salida_encuentro"],true);
                                    ?>
                                    <a data-fancybox="iframe" class="truncate tooltipped" data-tooltip="<?php echo  $item["salida_encuentro_string"];?>" href="map.php?lat=<?php echo $loc["lat"] ?>&lng=<?php echo $loc["lng"]?>"><?php echo  $item["salida_encuentro_string"];?></a>
                                </div>

                                <div  class="col s6 m2 data">
                                    <p>
                                        <?php echo $item["salida_notas"];?>
                                    </p>
                                </div>


                            <div style="position: absolute;top: 10px;right: 20px;"><a href="salidas-add.php?id=<?php echo $item["salida_id"]?>"><i class="material-icons">edit</i></a></div>


                            </li>
                            <?php
                        }
                        ?>



            </ul>
            <?php

        }
    }
    ?>

</div>

