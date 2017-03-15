<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 15/02/2017
 * Time: 01:56 PM
 */

namespace DAO;


class CoreDAO
{

    protected  $db;
    protected $table;
    protected $idField;
    protected $resultNumber;


    function __construct($db,$table)
    {
        $this->db=$db;
        $this->table=$table;
        $res=$db->query("SHOW KEYS FROM {$this->table} WHERE Key_name = 'PRIMARY'");


            $this->idField=$res->fetch_assoc();
            $this->idField=  $this->idField["Column_name"];





    }

    function getPager($limit,$actualPage,$paddingPages)
    {


        if($limit)
        {
            $pager =array();

            $pages = ceil( $this->resultNumber / $limit);


            if($pages>0)

            {  if($actualPage>$pages)
            {

                $_GET["p"]=$pages;
                $qs=http_build_query($_GET);
                header("Location: files.php?{$qs}");

            }


                //paginas hacia atras

                for($i=$actualPage-$paddingPages;$i<=$actualPage;$i++ )
                {
                    if($i>0)
                    { $pager[]["number"]=$i;

                    }

                }

                // paginas hacia adelante
                for($i=1;$i<=$paddingPages;$i++)
                {
                    if(($actualPage+$i)<=$pages)
                    {

                        $pager[]["number"]=$actualPage+$i;
                    }
                }


                foreach($pager as $k=>$v)
                {
                    if($v["number"]==$actualPage)
                    {
                        $pager[$k]["class"]="active";
                    }

                }


                return $pager;


            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }




    }

    function process(&$result,$item)
    {




        foreach ($item as $clave =>$valor)
        {
            switch ($clave)
            {

                default:
                    $result[$item[$this->idField]][$clave]=$valor;
                    break;



                case 'archivo_id':

                    if($item[$this->idField]) {

                        if($item["archivo_id"])
                        {
                            $archivo["archivo_id"]=$item["archivo_id"];
                            $archivo["archivo_data"]=json_decode($item["archivo_data"],true);
                            $archivo["archivo_repositorio"]=$item["archivo_repositorio"];
                            $archivo["archivos_objetos_id"]=$item["archivos_objetos_id"];
                            $result[$item[$this->idField]]["archivos"][$item["archivo_id"]]=$archivo;

                        }
                        else
                        {
                            unset($item["archivo_id"]);
                            unset($item["archivo_data"]);
                            unset($item["archivo_repositorio"]);
                            unset($item["archivos_objetos_id"]);
                        }



                    }

                    break;
            }
        }



        //$result[]=$item;


//echo json_encode($item);

    }
    function read($object=array(),$sqlExtra="",$offset=0,$limit=false,$joinSql=false)
    {

        $result = array();
        if ($this->table != "archivos")
        {
            $sql="SELECT * FROM {$this->table}  LEFT JOIN archivos_objetos ON objeto={$this->idField} AND tabla = '{$this->table}'  LEFT JOIN archivos ON archivo_id=archivo";

        }
        else
        {
            $sql="SELECT * FROM {$this->table}";

        }



        //LEFT JOIN archivos_objetos ON objeto='{$this->idField}' AND tabla = '{$this->table}' LEFT JOIN archivos ON archivo_id=archivo"
        if($joinSql)
        {
            $sql.=" {$joinSql}";
        }



        $countSql="SELECT count(*) as 'total' FROM {$this->table} ";

        if(count($object)>0)
        {
            $sql.=" WHERE ";

            $countSql.=" WHERE";
            foreach ($object as $k=>$v)
            {
                //$sql.=" {$k}='{$v}' AND";

                if(is_array($v))
                {
                    $values ="";
                    foreach ($v as $item)
                    {

                        $values.="'{$item}',";
                    }
                    $values = rtrim($values,",");

                    $v  =$values;
                }
                else
                {
                    $v = "'$v'";
                }

                $sql.=" {$k} IN ({$v}) AND";
                $countSql.=" {$k} IN ({$v}) AND";

                //$countSql.=" {$k}='{$v}' AND";
            }
            $sql = rtrim($sql,"AND");
            $countSql= rtrim($countSql,"AND");
        }
        $sql.=" {$sqlExtra}";


        //$countSql.= " {$sqlExtra}";


       // $this->resultNumber= $this->db->query($countSql)->fetch_all(true)[0]["total"];



        if($limit)
        {

            $offset = $offset*$limit;

            $sql.=" LIMIT {$limit} OFFSET {$offset}";

        }



        if($res=  $this->db->query($sql))
        {
            $this->resultNumber= $this->db->query($countSql)->fetch_all(true)[0]["total"];




                while($item=$res->fetch_assoc())
                {


                    $this->process($result,$item);
                }




           // $result= $res->fetch_all(1);
        }
        else
        {
            $result=false;
        }



        return $result;
    }

   protected function update($object)
    {
        $sql = "UPDATE {$this->table} SET ";


        foreach ($object as $k=>$v)
        { if(!is_array($v))
        {
            $sql.="{$k}='{$v}',";
        }

        }
        $sql = rtrim($sql,",");
        $sql.=" WHERE {$this->idField}={$object[$this->idField]}";

        if(!$this->db->query($sql))
        {
            return false;
        }

         if($object["adjuntos"])
            {

              // return $this->attach($object[$this->idField],$object["adjuntos"]);
                if(!$this->attach($object[$this->idField],$object["adjuntos"]))
                {
                    return false;
                }
         }

          //  return $object[$this->idField];//$object[$this->idField];

            return $object[$this->idField];
    }



    function attach($id,$adjuntos)
    {
        $sql = "INSERT INTO archivos_objetos (archivo,tabla,objeto) VALUES ";
        $sqlDelete="DELETE FROM archivos_objetos WHERE ";
        $values = "";
        $deleteValues="";
        foreach ($adjuntos as $k=>$item) {

            if(!$item["delete"])
            {
                if(!$item["archivos_objetos_id"])
                {
                    $values .= "({$k},'{$this->table}',{$id}),";
                }

            }
            else
            {
                $deleteValues.="{$k},";
            }


        }

        $deleteValues = rtrim($deleteValues,",");
        $values = rtrim($values, ",");

        $sql .= $values;


       // return $sql." ".$sqlDelete;
       if($deleteValues!="")
       {
           $sqlDelete.=" archivo IN({$deleteValues}) AND objeto={$id}";

           if(!$this->db->query($sqlDelete))
           {
               return false;
           }
       }


      //  return $this->db->error." ".$sql." ".$sqlDelete;//;$sql." ".$sqlDelete;

        if($values!="")
        {
            if(!$this->db->query($sql))
            {
                return false;
            }
        }
        //return $sqlDelete." ".$sql;

        return true;
    }




    
    function getKeys($object)
    {
        $keys=array();
        foreach ($object as $k=>$v)
        {
            if(!is_array($v))
            {
                $keys[]=$k;

            }
        }

        return $keys;
    }

    function insert($object)
    {


        if(!$object["array"])
        {
            $keys= implode(",",$this->getKeys($object));

            $sql ="INSERT INTO {$this->table}  ({$keys}) values ";

            $query="";

            foreach ($object as $k=>$v)
            {
                if(!is_array($v))
                {

                    if($v=='')
                    {
                        $v="NULL";

                    }
                    else
                    {
                        $v="'{$v}'";
                    }
                    $query.="{$v},";


                }


            }
            $query= rtrim($query,",");
            $sql.="({$query})";

        }
        else
        {


            $object = $object["array"];

            $keys= implode(",",$this->getKeys($object[0]));

            $sql ="INSERT INTO {$this->table}  ({$keys}) values ";




            $inserts="";
            foreach ($object as $item)
            {
                $query="";
                foreach ($item as $k=>$v)
                {
                    if(!is_array($v))
                    {

                        if($v=='')
                        {
                            $v="NULL";

                        }
                        else
                        {
                            $v="'{$v}'";
                        }
                        $query.="{$v},";


                    }


                }
                $query= rtrim($query,",");
                $inserts.="({$query}),";
            }

         $inserts = rtrim($inserts,",");


            $sql.="{$inserts}";
            
        }
        


   


       if( $this->db->query($sql))
        {



            if($object["adjuntos"])
            {

              if(!$this->attach($this->db->insert_id,$object["adjuntos"]))
              {
                  return false;
              }
            }



            return $this->db->insert_id;
        }

        return false;

    }

    function upsert($object ,ArchivoDAO $archivoData=null)
    {

        $files = $_FILES;

        if($object[$this->idField])
        {
           $res= $this->update($object);
        }
        else
        {
            $res=  $this->insert($object);
        }






        if(count($files)>0)
        {

            if($archivoData)
            {
              $uploadedFiles=  $archivoData->upload($files);



               $filesSql="INSERT INTO archivos_objetos (archivo,tabla,objeto) VALUES ";
                $values="";
                foreach($uploadedFiles as $file)
                {
                    $values.="({$file},'{$this->table}',{$res}),";


                }
                $values = rtrim($values,",");

                $filesSql.=$values;
                if(!$this->db->query($filesSql))
                {
                    $res=false;
                }
            }



        }

        return $res;
        /*
        if($archivoData)
        {
            return $res;
        }
        else
        {
            return $res;

        }*/

    }

    function delete($object)
    {
        $sql ="DELETE FROM {$this->table} WHERE ";
        
        foreach ($object as $k=>$v)
        {

            
            if(is_array($v))
            {
                $values ="";
                
                foreach ($v as $item)
                {
                    $values.="'{$item}',";
                }
                
                $values = rtrim($values,",");
                
                $v =$values;
                
            }
            
            $sql.=" {$k} IN ({$v}) AND";
            
            
            
        }
        $sql= rtrim($sql,"AND");

        $res=$this->db->query($sql);

        if($res)
        {
            $res=true;
        }
        return $res;


    }
}