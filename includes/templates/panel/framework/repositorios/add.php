<style>
    .fancybox-close-small
    {
        background-color: white!important;

    }
    .clone
    {
        display:none;
    }
</style>
<script>

    var i=0;
    function deleteSize(e)
    {
        var target =$(e);
        target.closest(".size").remove();
    }
    function clone(selector,obj)
    {
        var clon =$(selector).clone()
        clon.removeClass("clone");

        if(obj)
        {

            clon.find(".width input").val(obj.width);
            clon.find(".height input").val(obj.height);
        }

        $(selector).after(clon);


    }
    $(document).ready(function(){



        <?php if($obj)

        {
        ?>

        var repo = <?php echo $obj; ?>;

        $.each(repo,function(clave,valor)
        {
            $.each(valor,function(k,v)
            {
                switch (k){
                    default:
                        $("[name='"+k+"']").val(v);
                        break;
                    case "formats":


                      if(!$.isArray(v))
                      {
                          v = [v];
                      }

                        for(var i=0;i<v.length;i++)
                        {
                            $("#"+v[i]).click();
                            $("#"+v[i]).val(v[i]);
                        }


                        break;
                    case "sizes":



                        console.log(v);

                        for(var i=0;i<v.length;i++)
                        {
                            var split = v[i].split(",");

                         clone(".resolution .clone",{width:split[0],height:split[1]});

                        }


                        break;
                }

            });


        });


        <?php
        }?>

    });
    $(document).on("submit","form",function (e) {
        e.preventDefault();
        var data = new FormData();
        var serializedForm =$(this).serializeArray();

        var formats="";
        var sizes="";



        $(".formats:checked").each(function(k,v){


            formats+=$(v).val()+",";
        });


        $(".size:visible").each(function(k,v){

            v= $(v);
            sizes+=   v.find(".width input").val()+","+   v.find(".height input").val()+";";
        });



        formats = removeLast(formats,",");
        sizes = removeLast(sizes,";");

        data.append("formats", formats);
        data.append("sizes",sizes);
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

                try{
                    res = JSON.parse(res);

                    console.log(res);



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




    });



</script>
<form class="row">

    <div class="col s12 m12 l12">
        <h2>Crear repositorio</h2>

        <?php if($obj)

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
        <div class="resolution">

            <div class="clone size" style="float: left;width: 100%;position: relative">
                <div class="input-field col s12 m12 l6 width">

                    <input data-name="sizes[$][width]"  type="number" class="validate" placeholder="<?php echo $lang["width"]; ?>">
                </div>
                <div class="input-field col s12 m12 l6 height">

                    <input data-name="sizes[$][height]"  type="number" placeholder="<?php echo $lang["height"]; ?>">
                </div>
                <i onclick="deleteSize(this)" class="close material-icons " style="position: absolute;top: 0px;right: 10px">delete</i>

             </div>
   </div>
        <div class="col s12 center" style="margin-top: 15px">
            <button onclick='clone(".resolution .clone")' class="btn waves-effect right waves-light col s12 m5 l3"  type="button" ><span class="truncate">Agregar resolucion</span>
                <i class="fa fa-desktop right" aria-hidden="true"></i>

            </button>
        </div>



        <div class="col s12 input-field" style="margin-top: 15px">
            <button  class="btn waves-effect right waves-light col s12 m3 l2" type="submit" >Aceptar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>



</form>

<script>


</script>