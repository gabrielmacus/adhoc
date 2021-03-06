<?php


class TerritorioDAO extends \DAO\CoreDAO
{
    public function __construct($db, $table)
    {
        parent::__construct($db, $table);
    }

    function getPager($limit, $actualPage, $paddingPages)
    {
        return parent::getPager($limit, $actualPage, $paddingPages);
    }

    function process(&$result, $item)
    {



        foreach ($item as $clave => $valor) {
            switch ($clave) {

                default:
                    $result[$item[$this->idField]][$clave] = $valor;
                    break;


                case 'archivo_id':

                    if ($item[$this->idField]) {

                        $archivo["archivo_id"] = $item["archivo_id"];
                        $archivo["archivo_data"] = json_decode($item["archivo_data"], true);
                        $archivo["archivo_repositorio"] = $item["archivo_repositorio"];
                        $archivo["archivos_objetos_id"] = $item["archivos_objetos_id"];

                        $result[$item[$this->idField]]["archivos"][$item["archivo_id"]] = $archivo;


                    }

                    break;
                case 'manzana_id':

                    if($item[$this->idField]) {

                        $manzana["manzana_id"]=$item["manzana_id"];
                        $manzana["manzana_polygon"]=$item["manzana_polygon"];
                        $manzana["manzana_territorio"]=$item["manzana_territorio"];



                        if(!  $result[$item[$this->idField]]["manzanas"][$item["manzana_id"]])
                        {
                            $result[$item[$this->idField]]["manzanas"][$item["manzana_id"]]=$manzana;
                        }




                    }

                    break;
                case 'reporte_id':
                    if($item[$this->idField]) {
                        $reporte["manzana_tiempo"]=$item["manzana_tiempo"];
                        $reporte["manzana_reporte_fecha"]=$item["manzana_reporte_fecha"];
                        $reporte["reporte_manzana"]=$item["reporte_manzana"];
                        $reporte["reporte_id"]=$item["reporte_id"];




                        $result[$item[$this->idField]]["manzanas"][$item["manzana_id"]]["reportes"][$item["reporte_id"]]= $reporte;



                    }
                    break;

            }
        }
    }

    function read($object = array(), $sqlExtra = "", $offset = 0, $limit = false,$joinSql=false)
    {
        return parent::read($object, $sqlExtra, $offset, $limit,$joinSql);
    }

    protected function update($object)
    {
        return parent::update($object);

    }


    function insert($object)
    {


        return parent::insert($object);

        
    }
    
    function attach($id, $adjuntos)
    {

        return parent::attach($id, $adjuntos); // TODO: Change the autogenerated stub
    }

    function upsert($object, \DAO\ArchivoDAO $archivoData = null)
    {
        include (ROOT_DIR."flush-territorios-cache.php");
        return parent::upsert($object, $archivoData);

    }

    function delete($object)
    {
        include (ROOT_DIR."flush-territorios-cache.php");
        return parent::delete($object);

    }

}