<script>
    $(document).ready(function () {
        //initialize swiper when document ready
        var mySwiper = new Swiper ('.swiper-container', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            // If we need pagination
            pagination: '.swiper-pagination',

            // Navigation arrows
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            paginationClickable:true,
            autoHeight:true

        })
    });
</script>
<style>
    .swiper-container {
        width: 50%;

    }
</style>

<?php
if(count($dataToSkin)==1)
{
    foreach ($dataToSkin as $data)
    {
        ?>

        <h3>Datos del territorio</h3>



        <?php


        $archivos = $data["archivos"];


        if(count($archivos)>0) {


            ?>
            <h4 class="grey-text">Archivos adjuntos</h4>

            <?php
        }

?>

        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">


        <?php

        foreach ($archivos as $archivo)
        {


            $archivo=$archivo["archivo_data"];
            $type= explode(".",$archivo["name"]);
            $type= $type[count($type)-1];



            switch ($type)
            {
                case "jpg":
                case "png":
                case "gif":
                case "svg":
                    ?>

                <div class="swiper-slide">

                    <a data-fancybox="image" data-src="<?php echo $archivo["sizes"]["o"]["completeUrl"]?>" style="width: 100%;height: 100%">
                        <figure style="padding: 0px;margin: 0px;">

                            <img style="width: 100%;height:100%;object-fit: cover" src="<?php echo $archivo["sizes"]["p"]["completeUrl"]?>">
                        </figure>
                    </a>
                </div>




                    <?php

                    break;
            }



            ?>

            <?php
        }

        ?>

            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>

        <?Php
    }

    ?>




    <?php
}
?>
