<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/02/2017
 * Time: 01:05 AM
 */

if(count($dataToSkin)==0)
{
    ?>
    <div>
        <h2><?php echo $lang["nofiles"]; ?></h2>
    </div>

    <?php
}
foreach ($dataToSkin as $k=>$v)
{

?>
<h3><?php echo $lang["repositorios"][$k];?></h3>
<script>
    function deleteArchivo(data,rep) {


        $.ajax(
            {
                method:"post",
                url:"archivos-data.php?act=delete&rep="+rep,
                data:data,
                dataType:"json",
                success:function (res) {

                    if(res)
                    {
                        window.location.reload();
                    }

                },error:function (err) {
                console.log(err);
            }
            });
    }
</script>


<ul class="row" >

<?php
    foreach ($v as $item) {
        $file = json_decode(stripslashes($item["archivo_data"]), true);

        ?>

         <li class="col s12  m6"  data-id="<?php echo $item["archivo_id"]; ?>">

             <div class="card">
                 <div class="card-image waves-effect waves-block waves-light" style="position: relative">

                     <?php

                     $type = explode("/",$file["type"])[0];

                     switch ($type)
                     {
                         case 'image':

                             ?>
                             <img class="activator" style="width: 100%" src="<?php echo $file["o"]["completeUrl"]?>">
                             <?php
                             break;
                         case 'video':
                             ?>
                             <video class="activator" controls src="<?php echo $file["o"]["completeUrl"]?>" style="width: 100%;height: 400px"></video>

                             <?php
                             break;
                         case 'audio':
                             ?>
                             <audio class="activator" controls src="<?php echo $file["o"]["completeUrl"]?>"></audio>

                             <?php
                             break;
                     }

                     ?>
                     <i onclick='deleteArchivo({archivo_id:<?php echo $item["archivo_id"];  ?>,dir:"<?php echo $file["folder"];  ?>"},<?php echo $item["archivo_repositorio"][0]; ?>)' class="delete fa fa-times "  style="position: absolute;top: 10px;right: 10px;font-size: 30px"></i>

                     <span class="card-title activator flow-text"><?php echo $file["name"] ?><i class="material-icons right">more_vert</i></span>
                 </div>
                 <div class="card-reveal valign-wrapper">
                     <span class="card-title grey-text text-darken-4" style="margin-bottom: 25px"><?php echo $file["name"] ?><i class="material-icons right blue">close</i></span>
                      <?php
                     if( !$item["archivo_descripcion"] )
                     {
                         $item["archivo_descripcion"] =$lang["nodescription"];
                     }
                     ?>
                     <p class="valign flow-text grey-text" ><?php echo $item["archivo_descripcion"];?></p>
                     <h4 class="blue-text"><?php echo bytesToSize( $file["size"]);?></h4>

                 </div>
                 <div class="card-action">
                     <a class="blue-text" download href="<?php echo $file["o"]["completeUrl"] ?>"><?php echo $lang["download"]; ?></a>
                     <a class="grey-text right nomargin" download href="<?php echo $file["o"]["completeUrl"] ?>"><?php echo date($lang["dateFormat"],$file["date"]); ?></a>




                 </div>
             </div>

        </li>


        <?php
    }

}

?>
</ul>
