
<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:32
 */


require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Archivo/IArchivo.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Archivo/Archivo.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Imagen/Imagen.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/DataSource.php");
class ImagenDAO extends ArchivoDAO
{
    public function __construct(DataSource $dataSource, $tableName = "archivos")
    {
        parent::__construct($dataSource, $tableName);
    }

    


    public function insertArchivo(IArchivo $i)
    {

        $files=array();

        $originalSize = getimagesize($i->getTmpPath()) ;

        $i->setAlto($originalSize[1]);
        $i->setAncho($originalSize[0]);

       $original=  parent::insertArchivo($i);//Agrego el archivo original

        $files[]=$original;
        //get resoluciones del repositorio
        $resoluciones=array(
            array("ancho"=>300,"alto"=>300,"nombre"=>"portada"),
            array("ancho"=>200,"alto"=>200,"nombre"=>"thumbnail")
        );
        

        foreach ($resoluciones as $resolucion)
        {
            $copy=$i->getTmpPath().".{$resolucion["nombre"]}";//Ruta del archivo a redimensionar
            
            if(!copy($i->getTmpPath(),$copy))
            {
                throw  new Exception("ImagenDAO:0");//Error al copiar archivo temporal;
            }
            $image =new \Eventviva\ImageResize($copy);

            $image->resizeToBestFit($resolucion["ancho"],$resolucion["alto"]); //Redimension

            $image->save($copy);

   

            $i->setTmpPath($copy); //Seteo la ruta temporal de la imagen a guardar

            $finalSize = getimagesize($copy) ;
            
            $i->setAlto($finalSize[1]);
            $i->setAncho($finalSize[0]);

            $files[]=parent::insertArchivo($i,$resolucion["nombre"],$original); 
        }

        return $files;

    }
   


}