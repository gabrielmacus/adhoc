<style>
    .fancybox-close-small
    {
        background-color: white!important;

    }
</style>
<script>

    $(document).ready(function(){

        <?php if($repo)

        {
        ?>

        var repo = <?php echo $repo; ?>;

        $.each(repo,function(clave,valor)
        {
            $.each(valor,function(k,v)
            {
                switch (k){
                    default:
                        $("[name='"+k+"']").val(v);
                        break;
                    case "formats":


                        for(var i=0;i<v.length;i++)
                        {
                            $("#"+v[i]).click();
                            $("#"+v[i]).val(v[i]);
                        }


                        break;
                }

            });


        });


        <?php
        }?>

    });
    $(document).on("submit","form",function (e) {

        var data = new FormData();
        var serializedForm =$(this).serializeArray();

        var formats="";




        $(".formats:checked").each(function(k,v){


            formats+=$(v).val()+",";
        });
       formats = removeLastComma(formats);
        data.append("formats", formats);
        data.append("dir","/"+ $("#nombre").val().toLowerCase());
        $.each(serializedForm,function(key,value)
        {
            data.append(value["name"], value["value"]);
        });


 $.ajax({
            url: "repo-data.php?act=add",
            type: "post",
            dataType: "html",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success:function(res)
            {

                console.log(res);

                try{
                    res = JSON.parse(res);


                    if( res)
                    {


                    window.location="files.php?rep="+res;
                    }
                    else
                    {


                        error(null,"<?php echo $lang["errors"]["filesError"]["text"]; ?>"+res.error.join());
                    }

                }
                catch(e)
                {
                    error();
                }

            }
        })



        e.preventDefault();
    });



</script>
<h1>Area en desarrollo..</h1>
<form class="row">

    <div class="col s12 m12 l12">
        <h2>Crear repositorio</h2>

        <?php if($repo)

        {
           ?>

            <input name="repositorio" hidden  >
            <?php
        }?>

        <div class="input-field col s12 m12 l12">
            <input id="nombre" type="text" name="nombre" class="validate">
            <label for="nombre">Nombre del repositorio</label>
        </div>


        <div class="col s12 m12 l12">
            <?php
            foreach($lang["formatList"] as $k=>$format)
            {
                ?>

                <div class="col s6 m3 l3" style="padding: 10px">
                    <input class="formats" type="checkbox"   value="<?php echo $format; ?>" id="<?php echo $format; ?>"  />
                    <label for="<?php echo $format; ?>"><?php echo $format; ?></label>
                </div>
                <?php
            }?>


        </div>
    </div>

    <div class="col s12" style="margin-top: 15px">
        <button class="btn waves-effect right waves-light" type="submit" >Submit
            <i class="material-icons right">send</i>
        </button>
    </div>


</form>

<script>


</script>