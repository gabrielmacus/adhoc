<script>


    function initMap()
    {

    }



    function loadDirecciones()
    {
        $.ajax(
            {
                method:"get",
                url:"direcciones-data.php?act=list",
                dataType:"json",
                success:function (res) {
                    console.log(res);
                },
                error:function (err) {
                    console.log(err);
                }
            }
        );
    }

    var direccionIndex=0;
    var telefonoIndex=0;

    function deleteDireccion(element)
    {
        var idx= $(element).closest("[data-id]").data("id");
        $(element).closest("[data-id]").find("[data-name='delete']").attr("name","direcciones["+idx+"][delete]");

        $(element).closest("[data-id]").find("[data-name='delete']").attr("value","true");
        $(element).closest("[data-id]").css("display","none");

    }


    function deleteTelefono(element)
    {
        var idx= $(element).closest("[data-id]").data("id");
        $(element).closest("[data-id]").find("[data-name='delete']").attr("name","telefonos["+idx+"][delete]");

        $(element).closest("[data-id]").find("[data-name='delete']").attr("value","true");
        $(element).closest("[data-id]").css("display","none");
    }

    function addTelefono(telefono)
    {

        var clone= $(".telefonos .clone").clone();

        $(".telefonos .cloned").append("<div data-id="+telefonoIndex+">"+clone.html()+"</div>");
        clone=$(".telefonos [data-id="+telefonoIndex+"]");

        var name=clone.attr("name");

        var numero= clone.find("[data-name='numero']");
        var orden= clone.find("[data-name='orden']");


       numero.attr("name","telefonos["+telefonoIndex+"][telefonoNumero]");
        orden.attr("name","telefonos["+telefonoIndex+"][orden]");



        if(telefono)
        {

            var id= clone.find("[data-name='id']");
            id.attr("name","telefonos["+telefonoIndex+"][telefonoId]");
            id.attr("value",telefono.id);

            numero.val(telefono.numero);
        }



        telefonoIndex++;
    }
    function addDireccion(direccion)
    {

        var clone= $(".direcciones .clone").clone();
        $(".direcciones .cloned").append("<div data-id="+direccionIndex+">"+clone.html()+"</div>");
        clone=$(".direcciones [data-id="+direccionIndex+"]");

        var name=clone.attr("name");

        var calle= clone.find("[data-name='calle']");
        var numero= clone.find("[data-name='numero']");
        var piso= clone.find("[data-name='piso']");
        var depto= clone.find("[data-name='depto']");
        var orden= clone.find("[data-name='orden']");


        calle.attr("name","direcciones["+direccionIndex+"][direccionCalle]");

        numero.attr("name","direcciones["+direccionIndex+"][direccionNumero]");

        piso.attr("name","direcciones["+direccionIndex+"][direccionPiso]");

        depto.attr("name","direcciones["+direccionIndex+"][direccionDepto]");

        orden.attr("name","direcciones["+direccionIndex+"][orden]");


        if(direccion)
        {

            var id= clone.find("[data-name='id']");
            id.attr("name","direcciones["+direccionIndex+"][direccionId]");

            calle.val(direccion.calle);
            numero.val(direccion.numero);
            piso.val(direccion.piso);
            depto.val(direccion.depto);
            id.val(direccion.id);


        }



        direccionIndex++;


    }


    $(document).ready(function()
    {




        <?php if($isEdit)
        {
        ?>

        $.ajax(
            {
             url:"clientes-data.php?act=list&id=<?php echo $_GET["id"]; ?>",
                method:"get",
                dataType:"json",
                success:function(response)
                {

                var cliente=  response.data[0];

                    console.log(cliente);

                    $.each(cliente,function(k,v)
                    {



                            switch (k)
                            {
                                case 'direcciones':



                                    $.each(v,function(clave,valor)
                                    {
                                        console.log(valor);
                                        addDireccion(valor);

                                    });
                                    break;
                                case 'telefono':
                                    $.each(v,function(clave,valor)
                                    {
                                        console.log(valor);
                                        addTelefono(valor);

                                    });
                                    break;
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
    <h2>Nuevo cliente</h2>
    <form>

        <div>
            <label>Nombre
            </label>
            <input name="clienteNombre">
        </div>
        <div>
            <label>Apellido</label>
            <input name="clienteApellido">
        </div>
        <div>
            <label>Notas</label>
            <textarea name="clienteNotas"></textarea>
        </div>
        <div class="direcciones">
            <label>Direcciones</label>
           <div class="clone" style="display: none">
               <span onclick="deleteDireccion(this)">x</span>

               <div>
                   <label>Calle</label>
                   <input data-name="calle" >
               </div>
               <div>
                   <label>Numero</label>
                   <input data-name="numero">
               </div>
               <div>
                   <label>Piso</label>
                   <input data-name="piso" >
               </div>
               <div>
                   <label>Depto</label>
                   <input data-name="depto" >
               </div>

               
               <input data-name="orden" value="0" hidden>
               <input hidden data-name="id">
               <input hidden data-name="delete">
           </div>
            <div class="cloned">

            </div>
                <a onclick="addDireccion()">Agregar direccion</a>
        </div>
        <div class="telefonos">
            <label>Telefonos</label>
            <div class="clone" style="display: none">
                <span onclick="deleteTelefono(this)">x</span>
                <div>
                    <label>Numero</label>
                    <input data-name="numero" >
                </div>

                <input data-name="orden" value="0" hidden>
                <input hidden data-name="id">
                <input hidden data-name="delete">

            </div>
            <div class="cloned">

            </div>
            <a onclick="addTelefono()">Agregar telefono</a>


        </div>






        <div>
            <button type="submit">Aceptar</button>
        </div>
    </form>
</section>