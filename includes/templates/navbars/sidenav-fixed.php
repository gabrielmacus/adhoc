
<script>
    $(document).ready(function () {

        // Initialize collapse button
        $(".button-collapse").sideNav();
    });
</script>
<ul id="slide-out" class="side-nav fixed grey lighten-4">
    <?php foreach($lang["menu"] as $item)
    {
        ?>

        <li><a href="<?php echo $item["href"]; ?>"><?php echo $item["texto"]; ?></a></li>
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