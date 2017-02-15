<script>


    function initMap()
    {

    }


    $(document).ready(function()
    {




        <?php if($isEdit)
        {
        ?>

        $.ajax(
            {
                url:"marcas-data.php?act=list&id=<?php echo $_GET["id"]; ?>",
                method:"get",
                dataType:"json",
                success:function(response)
                {

                    var marca=  response.data[0];

                    console.log(marca);

                    $.each(marca,function(k,v)
                    {



                        switch (k)
                        {

                            default :

                                $("[name='"+k+"']").val(v);
                                break;
                        }







                    });
                }
            }
        );




        <?php
        }?>

    });
    $(document).on("change","#marcaLogo",function(e)
    {

        var files = e.target.files;



        var data = new FormData();
        $.each(files, function(key, value)
        {
            data.append(key, value);
        });

        $.ajax({
            url: "<?php echo $urlSaveLogo ?>",
            type: "post",
            dataType: "html",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success:function(res)
            {

                console.log(res);
                res = JSON.parse(res);
                console.log(res);
            }
        })



    });
    $(document).on("submit",".add form",function (e) {


        $.ajax(
            {
                method:"post",
                url:"<?php echo $urlSave; ?>",
                data:$(this).serialize(),
                dataType:"json",
                success:function (res) {
                    console.log(res);
                },
                error:function (err) {
                    console.log(err);
                }
            }
        );
        e.preventDefault();
    });

</script>
<section class="add">
    <h2>Nueva marca</h2>
    <form>

        <div>
            <label>Nombre
            </label>
            <input name="marcaNombre">
        </div>
        <div>
            <label>Logo</label>
            <input id="marcaLogo"  type="file">
            <input hidden name="marcaLogo">
        </div>
        <div>
            <label>Descripcion</label>
            <textarea name="marcaDescripcion"></textarea>
        </div>

        <div>
            <button type="submit">Aceptar</button>
        </div>
    </form>
</section>