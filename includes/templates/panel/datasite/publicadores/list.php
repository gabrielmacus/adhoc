<div class="row">
    <ul class="collection">
        <?php

     foreach ($dataToSkin as $item)
        {
            ?>
            <li class="collection-item">
                <h3 style="font-size: 23px"><?php echo $item["publicador_nombre"]?> <?php echo $item["publicador_apellido"]?></h3>
               <div class="row">
                   <div class="col s12 m6 l4">
                       <b>Edad</b><h4 style="font-size: 18px"><?php echo $item["publicador_edad"]?> años</h4>
                   </div>
                   <div class="col s12 m6 l4">
                       <b>Direccion</b><h4 class="truncate" style="font-size: 18px"><?php echo $item["publicador_direccion"]?> años</h4>
                   </div>
                   <div class="col s12 m12 l4">
                       <b>Telefonos</b>
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
               </div>

            </li>

            <?php
        }?>

    </ul>
</div>