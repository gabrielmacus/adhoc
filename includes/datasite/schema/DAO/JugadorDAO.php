<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 04:08 PM
 */

namespace DAO;


class JugadorDAO extends CoreDAO
{
    public function __construct($db, $table)
    {
        parent::__construct($db, $table);
    }

    function upsert($object)
    {
        return parent::upsert($object);
    }

    function delete($object)
    {
        return parent::delete($object);
    }

    function read($object =array())
    {

    }


}