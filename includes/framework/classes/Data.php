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

                case 2://many to one
                       



                    break;
                case 3://many to many

                       $sql.=" LEFT JOIN {$relationship["join"]} ON {$this->tableId}={$this->table} LEFT JOIN {$relationship["foreign"]} ON {$relationship["foreign"]}_id = {$relationship["foreign"]}";

                 break;
            }

        }



        $res =$this->db->query($sql)->fetch_all(1);



        return $res;
    }
     public function getKeys($arr)
     {
         $keys="";
         foreach ($arr as $k=>$v)
         {
             if(!is_array($v))
             {
                 $keys.="{$k},";
             }

         }
         $keys=rtrim($keys,",");
         return $keys;
     }

     public function upsert($obj)
     {


         if(!is_assoc($obj))
         {
             $fields=array_keys($obj[0]);

             $fields=implode(",",$fields);

             $sql="REPLACE INTO {$this->table} ({$fields}) VALUES  ";

             foreach ($obj as $array)
             {

                 $values ="";
                 foreach ($array as $k=>$v)
                 {

                     if(!is_array($v))
                     {
                         $values.="'{$v}',";

                     }


                 }

                 $values=rtrim($values,",");
                 $sql.=" ({$values}),";

             }
             $sql=rtrim($sql,",");
         }
         else
         {
             $fields=array_keys($obj);

             $fields=implode(",",$fields);

             $sql="REPLACE INTO {$this->table} ({$fields}) VALUES  ";


             $values="";

             foreach ($obj as $k=>$v)
             {

                 if(!is_array($v))
                 {
                     $values.="'{$v}',";

                 }




             }

             $values=rtrim($values,",");

             $sql.=" ({$values})";
         }

         $this->db->query($sql);



         if( $this->db->affected_rows>1)
         {
             for($i=0;$i<$this->db->affected_rows;$i++)
             {
                 $id[]=$this->db->insert_id+$i;
             }
         }
         else
         {
             $id=$this->db->insert_id;
         }


         if(!$this->db->error)
         {
             return $id;
         }
         else
         {
             return false;
         }






     }

     public function delete($obj)
     {  $idKey="{$this->table}_id";
         $id = $obj[$idKey];
         $sql ="DELETE FROM {$this->table} WHERE {$idKey}={$id}";
         $this->db-query($sql);

         if(!$this->db->error)
         {
             return $id;
         }
         else
         {
             return false;
         }




     }
}



