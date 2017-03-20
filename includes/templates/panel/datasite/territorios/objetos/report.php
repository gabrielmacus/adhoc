
<script>
    $(document).on("submit","#report",function () {


        var array= [];

        var time = $(this).find("[name='reporte_tiempo']").val();

        $.each(selectedManzanas,function (k,v) {


            array.push({reporte_manzana:v,reporte_tiempo:time});


        });


        console.log(array);
      $.ajax(
            {
                url: "territorios-data.php?act=report",
                method: "post",
                dataType: "json",
                data: {array},
                success: function (res) {

                    console.log(res);
                    if(res)
                    {
                   //     location.reload();
                    }
                    else
                    {
                        error();
                    }
                },
                error: function (err) {

                    console.log(err);
                    error(err);
                }
            }
        );
    })
</script>

<div  class="row" >

    <form id="report" class="input-field inline col s12" style="width: 100%">

        <div class="col s12 m9 l10">
            <input name="reporte_tiempo" id="report" type="text" >
            <label for="report" >Minutos a informar</label>
        </div>

        <div class="col s12 m3 l2">

            <button  type="submit" class="btn ">
                Informar
            </button>
        </div>


    </form>
</div>

