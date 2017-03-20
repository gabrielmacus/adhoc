
<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17/03/2017
 * Time: 9:20
 */



if(is_numeric($reporteFecha))
{

    if($reporteFecha)
    {
        $diasManzana=(time()-$reporteFecha) / (60 * 60 * 24);
    }




    if($diasManzana>=0 && $diasManzana<=15)
    {

        $manzanaColor="#4CAF50";

    }

    if($diasManzana>15 && $diasManzana<=30)
    {

        $manzanaColor="#ffeb3b";

    }


    if($diasManzana>30 && $diasManzana<=45)
    {

        $manzanaColor="#ff9800";

    }



    if($diasManzana>45)
    {

        $manzanaColor="#F44336";

    }






}
else
{
    $manzanaColor='#393c42';
}


$lineColor=$manzanaColor;