<script>
    $(document).on("submit","form",function (e) {

        var files = $(this).find("#archivos")[0].files;

        var data = new FormData();
        $.each(files, function(key, value)
        {
            data.append(key, value);
        });

        var serializedForm =$(this).serializeArray();

        $.each(serializedForm,function(key,value)
        {
            data.append(value["name"], value["value"]);
        });


        $.ajax({
            url: "files-data.php?act=add&rep="+$("[name='archivo_repositorio']").val(),
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


                    if(res)
                    {

                        window.location="files.php";
                    }
                }
                catch(e)
                {

                }

            }
        })



        e.preventDefault();
    });



</script>

<form class="row">

    <div class="col s12 m12 l12">
        <h2>Subir archivos</h2>

        <div class="file-field input-field">
            <div class="btn">
                <span>ARCHIVO</span>
                <input id="archivos" type="file" name="archivos" multiple>
            </div> 
            <div class="file-path-wrapper">
                <input id="files"  class="file-path validate" type="text" placeholder="Uno o mas archivos">
            </div>
        </div>

        <div class="input-field ">
            <select name="archivo_repositorio">
                <option value="" disabled selected>Elegi una opcion</option>
                <?php foreach ($lang["repositorios"] as $k=>$v)

                {
                    ?>
                    <option value="<?php echo $k?>"><?php echo $v;?></option>
                    <?php
                }?>

            </select>
            <label>Repositorio</label>
        </div>
    </div>

    <div class="col s12">
        <button class="btn waves-effect right waves-light" type="submit" >Submit
            <i class="material-icons right">send</i>
        </button>
    </div>


</form>

<script>

  
</script>