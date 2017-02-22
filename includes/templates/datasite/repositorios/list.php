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

<style>
    .card-image img
    {
        object-fit: cover;
        height: 300px;
    }
    .floating-buttons
    {
        position: absolute;right: 10px;
        z-index:10000;
    }
</style>
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
      
        $file =$item["archivo_data"]// json_decode(stripslashes(), true);

        ?>

         <li class="col m12 l6"  data-id="<?php echo $item["archivo_id"]; ?>">






                 <div class="card hoverable">
                 <div class="card-image  " style="position: relative">

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

                     <span style=" background-color: rgba(0,0,0,0.6);
    margin-left: 10px;
    margin-bottom: 10px;font-size: 20px" class="card-title activator flow-text"><?php echo $file["name"] ?><i class="material-icons right">more_vert</i></span>
                     <a style="right: 126px"   href="archivos-data.php?id=<?php echo $item["archivo_id"];  ?>" data-fancybox-type="iframe" class="fancybox btn-floating halfway-fab waves-effect waves-light blue"><i class="material-icons" aria-hidden="true">mode_edit</i></a>

                     <a style="right: 75px" download href="<?php echo $file["o"]["completeUrl"] ?>" class="btn-floating halfway-fab waves-effect waves-light green"><i class="fa fa-download" aria-hidden="true"></i></a>
                     <a  onclick='deleteArchivo({archivo_id:<?php echo $item["archivo_id"];  ?>,dir:"<?php echo $file["folder"];  ?>"},<?php echo $item["archivo_repositorio"][0]; ?>)' class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">delete</i></a>


                   <!--  <a  onclick='deleteArchivo({archivo_id:<?php echo $item["archivo_id"];  ?>,dir:"<?php echo $file["folder"];  ?>"},<?php echo $item["archivo_repositorio"][0]; ?>)' class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">delete</i></a>
                     <a  onclick='deleteArchivo({archivo_id:<?php echo $item["archivo_id"];  ?>,dir:"<?php echo $file["folder"];  ?>"},<?php echo $item["archivo_repositorio"][0]; ?>)' class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">delete</i></a>
                     -->
                 </div>
                 <div class="card-reveal valign-wrapper grey lighten-4 ">
                     <span class="card-title grey-text text-darken-4" style="margin-bottom: 25px"><?php echo $file["name"] ?></span>
                      <?php
                     if( !$item["archivo_descripcion"] )
                     {
                         $item["archivo_descripcion"] =$lang["nodescription"];
                     }
                     ?>
                     <p class="valign flow-text grey-text" ><?php echo $item["archivo_descripcion"];?></p>
                     <h4 class="blue-text"><?php echo bytesToSize( $file["size"]);?></h4>

                 </div>
                 <div class="card-action" >
<!--
                     <a class="blue-text" download href="<?php echo $file["o"]["completeUrl"] ?>"><?php echo $lang["download"]; ?></a>
-->
                     <a class="grey-text  "  href="<?php echo $file["o"]["completeUrl"] ?>"><?php echo date($lang["dateFormat"],$file["date"]); ?></a>




                 </div>
             </div>

        </li>


        <?php
    }

}

?>
</ul>
