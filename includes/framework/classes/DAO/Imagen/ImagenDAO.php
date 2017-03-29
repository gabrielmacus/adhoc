
<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:32
 */
class ImagenDAO extends ArchivoDAO
{
    public function __construct(DataSource $dataSource, $tableName = "archivos")
    {
        parent::__construct($dataSource, $tableName);
    }

    public function insertArchivo(Archivo $a)
    {

        parent::insertArchivo($a);//Agrego el archivo original

        //get resoluciones del repositorio
        $resoluciones=array(
            array("ancho"=>300,"alto"=>300),
            array("ancho"=>200,"alto"=>200)
        );

        foreach ($resoluciones as $resolucion)
        {
            return parent::insertArchivo($a);
        }


    }


}