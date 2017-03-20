
<script>
   var  picker;
    $(document).ready(function () {
         picker= $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
        picker= picker.pickadate('picker');
    });

    $(document).on("submit","#report",function () {



        var array= [];

        var time = $(this).find("[name='reporte_tiempo']").val();

        var date=picker.get('select').obj.getTime()/1000;

        $.each(selectedManzanas,function (k,v) {


            array.push({reporte_manzana:v,reporte_tiempo:time,reporte_fecha:date});


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
                     location.reload();
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

<div  class="row " >

    <form id="report" class=" col s12  center" style="width: 100%">

        <div class="col s12 m5 l5 input-field  inline">

            <input id="report-date" name="reporte_fecha" type="date" class="datepicker">
            <label for="report-date" >Fecha</label>
        </div>
        <div class="col s12 m4 l5 input-field inline
         ">
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

