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
            <li class="waves-effect <?php echo $prevClass; ?>"><a href="<?php echo $url."?".$qs."&p=".($page-1) ?>"><i class="material-icons">chevron_left</i></a></li>

            <?php



            //PAGINADOR
            foreach($pager as $k=>$v)
            {
                ?>



                <li class="waves-effect   <?php echo $v["class"]; ?>"><a href="<?php echo $url."?".$qs."&p={$v["number"]}" ?>"> <?php echo $v["number"]; ?></a></li>


                <?php
            }

            if($page==count($pager))
            {
                $nextClass="disabled";
            }
            ?>
            <li class="waves-effect <?php echo $nextClass; ?>"><a  href="<?php echo $url."?".$qs."&p=".($page+1) ?>"><i class="material-icons">chevron_right</i></a></li>
        </ul>
    </div>
    <?php
}
?>