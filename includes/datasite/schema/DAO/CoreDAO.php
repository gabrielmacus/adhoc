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

    function process(&$result,$item)
    {

        $result[]=$item;


//echo json_encode($item);

    }
    function read($object=array(),$sqlExtra="",$offset=0,$limit=false,$joinSql=false)
    {

        $result=array();
        $sql="SELECT * FROM {$this->table} ";

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
                $sql.=" {$k}={$v} AND";

                $countSql.=" {$k}={$v} AND";
            }
            $sql = rtrim($sql,"AND");
            $countSql= rtrim($countSql,"AND");
        }
        $sql.=" {$sqlExtra}";
        $countSql.= " {$sqlExtra}";


        $this->resultNumber= $this->db->query($countSql)->fetch_all(true)[0]["total"];



        if($limit)
        {


            $offset = $offset*$limit;

            $sql.=" LIMIT {$limit} OFFSET {$offset}";

        }



        if($res=  $this->db->query($sql))
        {


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
        {
            $sql.="{$k}='{$v}',";
        }
        $sql = rtrim($sql,",");
        $sql.=" WHERE {$this->idField}={$object[$this->idField]}";

        if($this->db->query($sql))
        {
            return $object[$this->idField];
        }
            return false;
    }

    function insert($object)
    {
        $keys= implode(",",array_keys($object));

        $sql ="INSERT INTO {$this->table}  ({$keys}) values ";

        $query="";



        foreach ($object as $k=>$v)
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


        $query= rtrim($query,",");
        $sql.="({$query})";

       if( $this->db->query($sql))
        {

            return $this->db->insert_id;
        }

        return $sql;

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

            $sql.=" {$k}='{$v}' AND";
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