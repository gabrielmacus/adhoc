
<script>
    $(document).ready(function () {

        // Initialize collapse button
        $(".button-collapse").sideNav();
    });
</script>
<ul id="slide-out" class="side-nav fixed grey lighten-4">
    <?php foreach($lang["menu"] as $item)
    {

        if(!$item["items"])
        {
            ?>

            <li><a href="<?php echo $item["href"]; ?>"><?php echo $item["texto"]; ?></a></li>

            <?php
        }
        else
        {
            ?>
            <li><a class="dropdown-button" href="#!" data-activates="<?php echo $item["texto"]; ?>"><?php echo $item["texto"]; ?><i class="material-icons right">arrow_drop_down</i></a></li>
            <ul id='<?php echo $item["texto"]; ?>' class='dropdown-content'>

                <?php
             
                foreach ($item["items"] as $dropdownItem)
                {
                    ?>

                    <li><a href="<?php echo $dropdownItem["href"]; ?>"><?php echo $dropdownItem["texto"]; ?></a></li>


                    <?php
                }
                ?>
            </ul>

            <?php
        }
        ?>


        <?php
    }?>


</ul>
<a href="#" data-activates="slide-out" class="button-collapse large" ><i class="material-icons white-text" style="font-size: 50px">menu</i></a>
<style>
    .body {
        padding-left: 300px;
        width: 90%;
    }
  

    @media only screen and (max-width : 992px) {
        .body  {
            padding-left: 0;
        }
    }
</style>