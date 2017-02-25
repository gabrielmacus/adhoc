<script>


    var id ;
    var rep;
    function showDeleteDialog(_id,_rep,div) {

        id=_id;
        rep=_rep;


        if(!div)
        {
            div="#file-delete";
        }



        $.fancybox.open({
            src  :div,
            type : 'inline'
        });
    }

    <?php if(count($dataToSkin)==0)
    {
    ?>
    function deleteRepo()
    {

        $.ajax(
            {
                url:"repo-data.php?act=delete",
                method:"post",
                dataType:"json",
                data:{repositorio:rep},
                success:function(res)
                {

                    console.log(res);
                    if(res)
                    {
                        window.location.href="files-add.php";
                    }
                    else
                    {
                        error();
                    }
                },
                error:error
            }
        );
        parent.jQuery.fancybox.getInstance().close();

    }



    <?php
    }?>


    function deleteFile()
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
                    else
                    {
                        error();
                    }
                },
                error:error
            }
        );
        parent.jQuery.fancybox.getInstance().close();


    }
</script>


<?php if(count($dataToSkin)==0)
{
    ?>

    <div class="row center">

        <div class="col s12 m12 l12">
            <h2><?php echo $lang["nofiles"];?></h2>

            <h3>Si no usas el repositorio, podés <a onclick='showDeleteDialog(0,"<?php echo $_GET["rep"] ?>","#repo-delete")' style="font-size: 18px" class="waves-effect waves-light btn">borrarlo</a></h3>
        </div>


    </div>


    <?php
}?>

<?php foreach($dataToSkin as $k=>$v)
{

?>


<div  class="row">

    <h2><?php echo $lang["repositorios"][$k]; ?></h2>

    <?php
    foreach($v as $clave=>$valor)
    {

        $type= explode("/",$valor["archivo_data"]["type"])[0];

        $ext  =explode(".", $valor["archivo_data"]["name"]);
        $ext  =$ext[count($ext)-1];


        ?>
        <div class="col s12 m12 l6">
            <div class="card " style="overflow: hidden">
                <div class="card-image ">

                    <?php


                    switch($type)
                    {
                        case 'image':
                            ?>
                            <a href="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>" data-fancybox="images">
                                <img class="zoomOnHover"  rel="<?php  echo  $lang["repositorios"][$k]; ?>" style="object-fit: cover;height: 300px" src="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>">
                            </a>

                            <?php
                            break;
                        case "application":
                              switch ($ext)
                              {
                                  case "odt":
                                  case "doc":
                                  case "docx":



                                      ?>

                                      <a   rel="<?php  echo  $lang["repositorios"][$k]; ?>"   data-fancybox="iframe"  href="http://docs.google.com/gview?url=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true"
                                                style="width: 100%;height: 300px" class="valign-wrapper center grey lighten-3">
                                          <!--
                                          <iframe style="width: 100%;height: 100%" class="valign "  src="http://docs.google.com/gview?url=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true" aria-hidden="true"></iframe>
                                          -->
                                          <i  style="font-size: 250px;width: 100%" class="zoomOnHover valign fa fa fa-file-word-o blue-text darken-1" aria-hidden="true"></i>

                                      </a>


                                      <?php
                                      break;
                                  case "xls":
                                  case "xlsx":
                                      ?>
                                      <a  rel="<?php  echo  $lang["repositorios"][$k]; ?>"    data-fancybox="iframe"  href="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true"
                                              style="width: 100%;height: 300px" class="valign-wrapper center grey lighten-3">
                                          <!--
                                          <iframe style="width: 100%;height: 100%" class="valign "  src="http://docs.google.com/gview?url=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true" aria-hidden="true"></iframe>
                                          -->
                                          <i style="font-size: 250px;width: 100%" class="zoomOnHover valign fa fa fa-file-excel-o green-text" aria-hidden="true"></i>

                                      </a>


                                      <?php
                                      break;
                                  case "pptx":

                                      ?>
                                      <a  rel="<?php  echo  $lang["repositorios"][$k]; ?>"    data-fancybox="iframe"  href="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true"
                                          style="width: 100%;height: 300px" class="valign-wrapper center grey lighten-3">
                                          <!--
                                          <iframe style="width: 100%;height: 100%" class="valign "  src="http://docs.google.com/gview?url=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true" aria-hidden="true"></iframe>
                                          -->
                                          <i style="font-size: 250px;width: 100%" class="zoomOnHover valign fa fa fa-file-powerpoint-o purple-text" aria-hidden="true"></i>

                                      </a>


                                      <?php
                                      break;
                                  case "odp":
                                      ?>


                                      <div style="width: 100%;height: 300px" class="valign-wrapper center grey lighten-3">
                                          <i style="font-size: 250px;width: 100%" class="zoomOnHover valign fa fa fa-file-powerpoint-o purple-text" aria-hidden="true"></i>

                                      </div>



                                      <?php
                                      break;

                              }

                            break;
                        case "video":

                           ?>

                            <div style="width: 100%;height: 300px" class="valign-wrapper center grey lighten-3">
                                <video preload="none" controls style="width: 100%;height: 300px;" class="mejs-player">
                                    <source src="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>" />
                                </video>
                            </div>



                            <?php

                            break;
                        case "audio":

                            ?>

                            <div style="width: 100%;padding:10px;height: 300px" class="valign-wrapper center grey lighten-3 ">


                                <audio controls style="width: 100%;position: absolute;bottom: 0px" class="mejs-player ">
                                    <source src="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>" />
                                </audio>
                            </div>


                            <?php

                            break;
                        default:
                            ?>


                            <div style="width: 100%;height: 300px" class="valign-wrapper center grey lighten-3">
                                <i style="font-size: 250px;width: 100%" class="zoomOnHover valign fa fa-file-archive-o" aria-hidden="true"></i>

                            </div>



                            <?php
                            break;
                    }?>


                    <div class="actions " style="position: absolute;right: 10px;top: 10px">
<!--
                        <a class="white-text green" style="display: inline-block;padding: 5px">
                            <i  class=" material-icons">mode_edit</i>
                        </a>-->
                        <a onclick="showDeleteDialog(<?php echo $valor["archivo_id"]; ?>,<?php echo $valor["archivo_repositorio"]; ?>)" class="white-text red btn " style="display: inline-block;padding: 5px!important;height: auto;line-height: inherit;"><i  style="font-size: 25px" class=" material-icons">delete</i>
                        </a>
                    </div>
                    <div style="position: absolute;left: 10px;top: 10px;max-width: 50%">

                        <span  class="white-text truncate tooltipped btn" data-position="bottom" data-delay="50" data-tooltip="<?php echo $valor["archivo_data"]["name"]; ?>" style="background-color: rgba(0,0,0,0.7); font-size: 20px;width: 100%"><?php echo $valor["archivo_data"]["name"]; ?></span>


                    </div>

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
<style>
    .fancybox-close-small
    {
        background-color: white!important;

    }
</style>

<div style="display: none;" class="card" id="file-delete">
    <div class="card-content black-text center">
        <span class="card-title"></span>
        <p><?php echo $lang["fileDelete"];?></p>
    </div>
    <div class="card-action">
        <button onclick="parent.jQuery.fancybox.getInstance().close();" class="waves-effect waves-teal btn white teal-text"><?php echo $lang["no"];?></button>
        <button onclick="deleteFile()" class="waves-effect waves-teal btn white teal-text"><?php echo $lang["yes"];?></button>
    </div>

</div>

<div style="display: none;" class="card" id="repo-delete">
    <div class="card-content black-text center">
        <span class="card-title"></span>
        <p><?php echo $lang["repoDelete"];?></p>
    </div>
    <div class="card-action center">
        <button onclick="parent.jQuery.fancybox.getInstance().close();" class="waves-effect waves-teal btn white teal-text"><?php echo $lang["no"];?></button>
        <button onclick="deleteRepo()" class="waves-effect waves-teal btn white teal-text"><?php echo $lang["yes"];?></button>
    </div>

</div>

