<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 01:20 PM
 */
class DataSource
{

    protected $err=array();

    public function __construct($user, $pass, $host,$db)
    {

            $this->conn = new PDO("mysql:host={$host};dbname={$db}",$user,$pass);




    }

    function runQuery($sql="",$params=array(),$process=false)
    {
        if(count($this->err)>0 || gettype($this->conn)!="object")
        {
            throw new Exception("DataSource:0");
        }


        if($sql && $sql!="")
        {
            $q = $this->conn->prepare($sql);
            $qRes=  $q->execute($params);



            if(is_callable($process))
            {

                while ($row=$q->fetch(PDO::FETCH_ASSOC))
                {
                    $process($row);
                }

            }
            else
            {

                $data = $q->fetchAll(PDO::FETCH_ASSOC);
            }


            $ecode=$q->errorCode();


            if($ecode!=="00000")
            {
                throw new Exception("DataSource:{$ecode}");
            }
            else
            {
               return $data;


            }


        }
        else
        {
            throw new Exception("DataSource:1");
        }



    }

    function runUpdate($sql="",$params=array())
    {
        if(count($this->err)>0 || gettype($this->conn)!="object")
        {
            throw new Exception("DataSource:0");
        }


        if($sql && $sql!="")
        {
            $q = $this->conn->prepare($sql);
            $qRes= $q->execute($params);
            $data = $this->conn->lastInsertId();

            $ecode=$q->errorCode();


            if($ecode!=="00000" )
            {
                throw new Exception("DataSource:{$ecode}");

            }
            else
            {

              return $data;
            }

        }
        else
        {
            throw new Exception("DataSource:1");
        }



    }




}