<script>
    function deleteFile(id,rep)
    {

        $.ajax(
            {
                url:"files-data.php?act=delete&rep="+rep,
                method:"post",
                dataType:"json",
                data:{archivo_id:id},
                success:function(res)
                {
                    if(res)
                    {
                        window.location.reload();
                    }
                },
                error:function(err)
                {
                    console.log(err);
                }
            }
        );


    }
</script>
<?php foreach($dataToSkin as $k=>$v)
{

?>


<div class="row">

    <h2><?php echo $lang["repositorios"][$k]; ?></h2>

    <?php
    foreach($v as $clave=>$valor)
    {

        $type= explode("/",$valor["archivo_data"]["type"])[0];


        ?>
        <div class="col s12 m12 l6">
            <div class="card">
                <div class="card-image ">

                    <?php

                    switch($type)
                    {
                        case 'image':
                            ?>
                            <img style="object-fit: cover;height: 300px" src="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>">
                            <?php
                            break;
                        default:
                            ?>


                            <div style="width: 100%;height: 300px" class="valign-wrapper center grey lighten-3">
                                <i style="font-size: 250px;width: 100%" class="valign fa fa-file-archive-o" aria-hidden="true"></i>

                            </div>



                            <?php
                            break;
                    }?>


                    <div class="actions " style="position: absolute;right: 10px;top: 10px">
<!--
                        <a class="white-text green" style="display: inline-block;padding: 5px">
                            <i  class=" material-icons">mode_edit</i>
                        </a>-->
                        <a onclick="deleteFile(<?php echo $valor["archivo_id"]; ?>,<?php echo $valor["archivo_repositorio"]; ?>)" class="white-text red" style="display: inline-block;padding: 5px"><i  class=" material-icons">delete</i>
                        </a>
                    </div>
                    <span class="card-title " style="background-color: rgba(0,0,0,0.7); font-size: 20px;width: 100%"><?php echo $valor["archivo_data"]["name"]; ?></span>
                </div>
                <!--  <div class="card-content">
                    <p>I am a very simple card. I am good at containing small bits of information.
                         I am convenient because I require little markup to use effectively.</p>
                 </div>-->
                <div class="card-action">
                    <a  href="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>" download=""><?php  echo $lang["download"];?></a>
                    <a class="grey-text"><?php  echo date($lang["dateFormat"],$valor["archivo_data"]["date"]); ?></a>
                </div>
            </div>
        </div>
        <?php
    }?>



 </div>

    <?php
}?>



