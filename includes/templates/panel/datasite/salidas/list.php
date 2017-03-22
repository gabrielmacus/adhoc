<div class="row">
    <?php

    foreach ($dataToSkin as $y =>$m)
    {
        ?>
        <h3 class="teal white-text lighten-1" style="padding: 10px;font-size: 25px">Salidas <?php echo $y?></h3>


        <?php
        foreach ($m as $k=>$v)
        {
?>

            <ul class="collection with-header" style="width: 100%">
                <li class="collection-header"><h4><?php  echo  $lang["meses"][$k]?></h4></li>

                <?php
                foreach ($v as $item)
                {
                    var_dump($v);
                    ?>
                    <li class="collection-item row">
                        <div class="col s12 m6">
                            <?php echo  $item["salida_hora"];?>
                        </div>
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

<div class="row">
    <h3 class="teal white-text lighten-1" style="padding: 10px;font-size: 25px">Salidas 2017</h3>
    <ul class="collection with-header" style="width: 100%">
        <li class="collection-header"><h4>Enero</h4></li>
        <li class="collection-item row">
            <div class="col s12 m6">
                <strong class="chip">7:30 p.m</strong>
            </div>
        </li>
        <li class="collection-item">Alvin</li>
        <li class="collection-item">Alvin</li>
        <li class="collection-item">Alvin</li>
    </ul>



    <?php include "includes/templates/panel/framework/paginators/pager.php"; ?>
</div>

