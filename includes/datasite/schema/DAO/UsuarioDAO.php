<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 08/03/2017
 * Time: 05:52 PM
 */

class UsuarioDAO extends \DAO\CoreDAO
{
    public function __construct($db, $table)
    {
        parent::__construct($db, $table);
    }

    function getPager($limit, $actualPage, $paddingPages)
    {
        return parent::getPager($limit, $actualPage, $paddingPages); // TODO: Change the autogenerated stub
    }

    function process(&$result, $item)
    {
        parent::process($result, $item); // TODO: Change the autogenerated stub
    }

    function read($object = array(), $sqlExtra = "", $offset = 0, $limit = false, $joinSql = false)
    {
        return parent::read($object, $sqlExtra, $offset, $limit, $joinSql); // TODO: Change the autogenerated stub
    }

    protected function update($object)
    {
        return parent::update($object); // TODO: Change the autogenerated stub
    }

    function attach($id, $adjuntos)
    {
        return parent::attach($id, $adjuntos); // TODO: Change the autogenerated stub
    }

    function getKeys($object)
    {
        return parent::getKeys($object); // TODO: Change the autogenerated stub
    }

    function insert($object)
    {
        return parent::insert($object); // TODO: Change the autogenerated stub
    }

    function upsert($object, \DAO\ArchivoDAO $archivoData = null)
    {
        return parent::upsert($object, $archivoData); // TODO: Change the autogenerated stub
    }

    function delete($object)
    {
        return parent::delete($object); // TODO: Change the autogenerated stub
    }

}