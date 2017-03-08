

<script>
    $(document).ready(function () {

        // Initialize collapse button
        $('.collapsible').collapsible();
        
        


    });
</script>
<ul id="slide-out" class="side-nav fixed grey lighten-4">


    <?php foreach($lang["menu"] as $item)
    {


        if(!$item["items"])
        {
            ?>


            <li><a class="waves-effect waves-light " href="<?php echo $item["href"]; ?>"><?php echo $item["texto"]; ?></a></li>

            <?php
        }
        else
        {
            ?>




    <li >
        <ul  id='<?php echo $item["texto"]; ?>' class="collapsible collapsible-accordion">
            <li >
                <a style="    padding: 0 32px;" class="waves-effect waves-light collapsible-header"><?php echo $item["texto"]; ?><i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body no-padding">
                    <ul>
                        <?php
                       foreach ($item["items"] as $subitem)
                       {
                           ?>

                           <li ><a   href="<?php echo  $subitem["href"];?>"><?php echo  $subitem["texto"];?></a></li>
                           <?php
                       }
                        ?>

                    </ul>
                </div>
            </li>
        </ul>
    </li>



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