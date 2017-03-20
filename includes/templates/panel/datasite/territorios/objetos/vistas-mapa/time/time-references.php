<script>
    $(document).on("click","#references",function () {

        var x =  $(this).css("width");


        $("#references").fadeOut(
            function () {
                $("#tag").fadeIn();
            }
        );



    });

    $(document).on("click","#tag",function () {

     $("#tag").fadeOut(
            function () {
                $("#references").fadeIn();
            }
        );

    });




</script>
<div id="references-wrapper" style="position: fixed; right: 0px;z-index: 1000;margin: 0px;padding: 0px;top: 40px" class="col s4 m2">

    <div id="tag" class="right grey  card lighten-3" style="padding: 20px;position: absolute;right: 0px;top:40px;z-index: 10000">
        <span style="width: 100%" ><b>Referencias por color</b> (en dias desde la ultima vez predicada la manzana)</span>
    </div>
    <div id="references" class="card"  style="width: 100%;display: none;right: 0px;position: absolute" >


        <div class="col black s12 green" style="padding: 15px">
            <span class="white-text" >No predicado</span>

        </div>
        <div class="col red s12 green" style="padding: 15px">
            <span >0 - 15 dias</span>

        </div>

        <div class="col red s12 yellow" style="padding: 15px">
            <span >15 - 30 dias</span>

        </div>
        <div class="col orange s12 center" style="padding: 15px">
            <span >30 - 45 dias</span>

        </div>
        <div class="col red s12 center" style="padding: 15px">
            <span >Más de 45 dias</span>

        </div>




    </div>



</div>


