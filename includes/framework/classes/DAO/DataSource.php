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
        try
        {

            $this->conn = new PDO("mysql:host={$host};dbname={$db}",$user,$pass);

        }
        catch (Exception $e)
        {
            $err[]=$e->getCode();
        }


    }

    function runQuery($sql="",$params=array(),$process=false)
    {
        if(count($this->err)>0 || gettype($this->conn)!="object")
        {
            return false;
        }


        $res["error"]=false;
        $res["success"]=false;
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
            {$res["error"]=true;
                $res["info"]=$ecode;

            }
            else
            {
                $res["success"]=true;
                $res["info"]=$data;


            }


        }
        else
        {
            $res["error"]=true;
        }

        return $res;

    }

    function runUpdate($sql="",$params=array())
    {
        if(count($this->err)>0 || gettype($this->conn)!="object")
        {
            return false;
        }

        $res["error"]=false;
        $res["success"]=false;
        if($sql && $sql!="")
        {
            $q = $this->conn->prepare($sql);
            $qRes= $q->execute($params);
            $data = $this->conn->lastInsertId();

            $ecode=$q->errorCode();


            if($ecode!=="00000" )
            {
                $res["error"]=true;
                $res["info"]=$ecode;

            }
            else
            {

                $res["success"]=true;
                $res["info"]=$data;
            }

        }
        else
        {
            $res["error"]=true;
        }



        return $res;
    }




}