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
        parent::process($result, $item);
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

    function upsert($object, \DAO\ArchivoDAO $archivoData = null)
    {
        return parent::upsert($object, $archivoData);
    }

    function delete($object)
    {
        return parent::delete($object);
    }

}