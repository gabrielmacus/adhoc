<?php

 class Data
{

    protected $db;
    protected $table;
    protected $schema;
    protected $tableId;
    function __construct($table,$schema,$db)
    {
        $this->db=$db;
        $this->table=$table;
        $this->tableId="{$table}_id";
        $this->schema=$schema;

    }

    function select()
    {
        $sql = "SELECT * FROM {$this->table}";

        foreach($this->schema as $relationship)
        {
            switch($relationship["type"])
            {
                case 3://many to many

                       $sql.=" LEFT JOIN {$relationship["join"]} ON {$this->tableId}={$this->table} LEFT JOIN {$relationship["foreign"]} ON {$relationship["foreign"]}_id = {$relationship["foreign"]}";
                    break;
            }

        }

        $objects =$this->db->query($sql)->fetch_all(1);

        $res=array();

        foreach($objects as $object)
        {

            foreach($objects as $object)
            {

                foreach($object as $k=>$v)
                {

                    if($k==$this->tableId)
                    {
                        $res[$v];
                    }
                }

            }

        }


        return $res;
    }
}



