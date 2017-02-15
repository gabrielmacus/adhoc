<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 01:45 PM
 */
namespace DAO;

class EmployeeDAO extends CoreDAO
{
    public function __construct(mysqli $db)
    {
        parent::__construct($db);
    }


    function create(Employee $employee)
    {

    }

     function read()
    {

    }

     function update()
    {

    }

     function upsert(Employee $employee)
    {
        $sql="REPLACE INTO employees ( `employee_name`, `employee_surname`) VALUES ({$employee->getName()},{$employee->getSurname()})";

        if($this->db->query($sql))
        {
            return $this->db->insert_id;
        }
        else
        {
            return false;

        }

    }

     function delete()
    {

    }


}