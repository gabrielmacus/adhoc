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
                {                    console.log(res);

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


<?php if(count($dataToSkin)==0 || !$dataToSkin)
{
    ?>

    <div class="row center">

        <div class="col s12 m12 l12">
            <h2><?php echo $lang["nofiles"];?></h2>

            <h3>Si no usas el repositorio, podés <a onclick='showDeleteDialog(0,"<?php echo $_GET["rep"] ?>","#repo-delete")' style="font-size: 18px" class="waves-effect waves-light btn">borrarlo</a></h3>
        </div>


    </div>


    <?php
}

if($dataToSkin)
{
    ?>
    <?php foreach($dataToSkin as $k=>$v)
{

    ?>


    <div class="fixed-action-btn horizontal ">
        <a href="repo-add.php?id=<?php echo  $_GET["rep"]; ?>" class="btn-floating btn-large red">
            <i class="material-icons">edit</i>
        </a>

    </div>

    <div  class="row">

        <div class="col s12">
            <h2 style="float: left"><?php

                foreach($v as $data)
                {
                    echo $repositorios[$data["archivo_repositorio"]]["nombre"];
                    break;
                }

                ?>
            </h2>


        </div>



        <style>
            .file
            {object-fit: cover;
                height: 200px;
                width: 100%;
            }
            .file i
            {
                font-size: 150px;width: 100%
            }
        </style>
        <?php
        foreach($v as $clave=>$valor)
        {


            $type= explode("/",$valor["archivo_data"]["type"])[0];

            $ext  =explode(".", $valor["archivo_data"]["name"]);
            $ext  =$ext[count($ext)-1];


            ?>
            <div class="col s12 m6 l4">
                <div class="card " style="overflow: hidden">
                    <div class="card-image ">



                        <?php


                        switch($type)
                        {

                            case 'image':
                                ?>
                                <a href="<?php echo  $valor["archivo_data"]["sizes"]["o"]["completeUrl"];?>" data-fancybox="images">
                                    <img class="zoomOnHover file"  rel="<?php  echo  $lang["repositorios"][$k]; ?>"  src="<?php echo  $valor["archivo_data"]["sizes"]["p"]["completeUrl"];?>">
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
                                             class="valign-wrapper center grey lighten-3 file">
                                            <!--
                                          <iframe style="width: 100%;height: 100%" class="valign "  src="http://docs.google.com/gview?url=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true" aria-hidden="true"></iframe>
                                          -->
                                            <i  style="font-size: 150px;width: 100%" class="zoomOnHover valign fa fa fa-file-word-o blue-text darken-1" aria-hidden="true"></i>

                                        </a>


                                        <?php
                                        break;
                                    case "xls":
                                    case "xlsx":
                                        ?>
                                        <a  rel="<?php  echo  $lang["repositorios"][$k]; ?>"    data-fancybox="iframe"  href="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true"
                                            class="valign-wrapper center grey lighten-3 file">
                                            <!--
                                          <iframe style="width: 100%;height: 100%" class="valign "  src="http://docs.google.com/gview?url=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true" aria-hidden="true"></iframe>
                                          -->
                                            <i class="zoomOnHover valign fa fa fa-file-excel-o green-text" aria-hidden="true"></i>

                                        </a>


                                        <?php
                                        break;
                                    case "pptx":

                                        ?>
                                        <a  rel="<?php  echo  $lang["repositorios"][$k]; ?>"    data-fancybox="iframe"  href="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true"
                                            class="valign-wrapper center grey lighten-3 file">
                                            <!--
                                          <iframe style="width: 100%;height: 100%" class="valign "  src="http://docs.google.com/gview?url=<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>&embedded=true" aria-hidden="true"></iframe>
                                          -->
                                            <i class="zoomOnHover valign fa fa fa-file-powerpoint-o purple-text" aria-hidden="true"></i>

                                        </a>


                                        <?php
                                        break;
                                    case "odp":
                                        ?>


                                        <div class="valign-wrapper center grey lighten-3 file">
                                            <i  class="zoomOnHover valign fa fa fa-file-powerpoint-o purple-text" aria-hidden="true"></i>

                                        </div>



                                        <?php
                                        break;
                                    default:
                                        ?>

                                        <div class="valign-wrapper center grey lighten-3 file">
                                            <i  class="zoomOnHover valign fa fa-file-archive-o" aria-hidden="true"></i>

                                        </div>


                                        <?php
                                        break;

                                }

                                break;
                            case "video":

                                ?>

                                <div  class="valign-wrapper center grey lighten-3 file">
                                    <video preload="none" controls style="width: 100%;height:100%;" class="mejs-player">
                                        <source src="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>" />
                                    </video>
                                </div>



                                <?php

                                break;
                            case "audio":

                                ?>

                                <div class="valign-wrapper center grey lighten-3 file ">


                                    <audio controls style="width: 100%;position: absolute;bottom: 0px" class="mejs-player ">
                                        <source src="<?php echo  $valor["archivo_data"]["o"]["completeUrl"];?>" />
                                    </audio>
                                </div>


                                <?php

                                break;
                            default:
                                ?>


                                <div  class="valign-wrapper center grey lighten-3 file">

                                    <i class="zoomOnHover valign fa fa-file-archive-o" aria-hidden="true"></i>

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

                            <span  class="white-text truncate tooltipped btn" data-position="bottom" data-delay="50" data-tooltip="<?php echo $valor["archivo_data"]["originalName"]; ?>" style="background-color: rgba(0,0,0,0.7); font-size: 20px;width: 100%"><?php echo $valor["archivo_data"]["originalName"]; ?></span>


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

    <?php
}?>


<style>
    .fancybox-close-small
    {
        background-color: white!important;

    }
</style>
<?php

if($pager) {

?>
    <div class="row">


        <ul class="pagination col s12 center ">

            <?php

            if($page==1)
            {
                $prevClass="disabled";
            }
            ?>
            <li class="waves-effect <?php echo $prevClass; ?>"><a href="files.php?<?php echo $qs."&p=".($page-1) ?>"><i class="material-icons">chevron_left</i></a></li>

            <?php



            //PAGINADOR
            foreach($pager as $k=>$v)
            {
                ?>



                <li class="waves-effect   <?php echo $v["class"]; ?>"><a href="files.php?<?php echo $qs."&p={$v["number"]}" ?>"> <?php echo $v["number"]; ?></a></li>


                <?php
            }

            if($page==count($pager))
            {
                $nextClass="disabled";
            }
            ?>
            <li class="waves-effect <?php echo $nextClass; ?>"><a  href="files.php?<?php echo $qs."&p=".($page+1) ?>"><i class="material-icons">chevron_right</i></a></li>
        </ul>
    </div>
    <?php
}
?>

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

