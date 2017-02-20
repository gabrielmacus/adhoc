<ul>
<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/02/2017
 * Time: 01:05 AM
 */
foreach ($dataToSkin as $k=>$v)
{

?>
<h2><?php echo $lang["repositorios"][$k];?></h2>
    <script>
        function deleteArchivo(id) {
            $.ajax(
                {
                    method:"post",
                    url:"archivos-data.php?act=delete",
                    data:{archivo_id:id},
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
                };
    </script>
<?php
    foreach ($v as $item) {
        $file = json_decode(stripslashes($item["archivo_data"]), true);

        ?>

        <li style="position: relative" data-id="<?php echo $item["archivo_id"]; ?>">

            <a onclick="deleteArchivo(<?php echo $item["archivo_id"];  ?>)" class="delete" style="position: absolute;top: 10px;right: 10px;">X</a>

        <h3><?php echo $file["name"] ?></h3>
            <figure>
        <?php

        $type = explode("/",$file["type"])[0];
            switch ($type)
            {
                case 'image':

                    ?>
                    <img style="width: 100%" src="<?php echo $file["o"]["completeUrl"]?>">
                    <?php
                    break;
            }

            ?>
                </figure>

            <a download href="<?php echo $file["o"]["completeUrl"] ?>">Descargar</a>
            <h4><?php echo bytesToSize( $file["size"]);?></h4>


        </li>


        <?php
    }

}

?>
</ul>
