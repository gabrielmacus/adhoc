<?php
/**
* Created by PhpStorm.
 * User: Gabriel
* Date: 24/02/2017
* Time: 23:46
*/

require("/includes/autoload.php");


$image = new ImageResize('C:\001.jpg');
$image->resizeToBestFit(500, 300);
$image->save('C:\t_001.jpg');

/*var_dump($_FILES);


require("/includes/autoload.php");
use \Eventviva\ImageResize;

foreach($_FILES as $file)
{
    $image = new ImageResize($file["tmp_name"]);
    $image->scale(50);
    $image->save($file["tmp_name"]);

}
