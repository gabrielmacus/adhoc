<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17/03/2017
 * Time: 9:20
 */

if(is_numeric($manzana["manzana_reporte_fecha"]))
{

    if($manzana["manzana_reporte_fecha"])
    {
        $diasManzana=(time()-$manzana["manzana_reporte_fecha"]) / (60 * 60 * 24);
    }




    if($diasManzana>=0 && $diasManzana<=15)
    {

        $manzanaColor="#79dd46";

    }

    if($diasManzana>15 && $diasManzana<=30)
    {

        $manzanaColor="#f2ff63";

    }


    if($diasManzana>30 && $diasManzana<=45)
    {

        $manzanaColor="#ffaa00";

    }



    if($diasManzana>45)
    {

        $manzanaColor="#d63d17";

    }






}
else
{
    $manzanaColor='black';
}


$lineColor=$manzanaColor;