<?php
/**
 * Created by PhpStorm.
 * User: Luis Garcia
 * Date: 16/01/2017
 * Time: 01:24 AM
 */

require("/includes/autoload.php");

function validateData($data)
{
    return true;
}
$result["error"]=false;
$result["success"]=false;
$act=$_GET["act"];
$id=$_GET["id"];

switch ($act)
{

    case 'list':

        $sql="SELECT * FROM productos LEFT JOIN marcas ON productoMarca=marcaId";
        if($id)
        {
            $sql.=" WHERE productoId={$id}";
        }


        if($res=$db->query($sql))
        {
            $res=$res->fetch_all(1);


            $result["success"]=true;
            $result["data"]=$res;
        }
        else
        {
            $result["error"]=$db->errno;
        }



        break;

    case 'add':

        $validateData=validateData($_POST);


        if($validateData===true) {
            $sqlProductos = "REPLACE INTO productos SET ";


            foreach ($_POST as $k=>$v)
            {
                if(!is_array($v)&&!empty($v))
                {
                    $sqlProductos.="{$k}='{$v}',";
                }
            }

            $sqlProductos=rtrim($sqlProductos,",");

            if($id)
            {
                $sqlProductos.=",productoId={$id}";
            }


            $error=0;
            $db->query($sqlProductos);
            $error+=$db->errno;
            $result["errors"][]=$db->error;

            $productoId=$db->insert_id;


            if($error>0)
            {
                $db->rollback();
                $result["error"]=true;

            }
            else
            {

                $result["success"]=$productoId;


            }

            $commitResult=$db->commit();


            if(!$commitResult)
            {
                $result["error"]=$db->errno;
            }


            $result["sql"][]=$sqlProductos;

            $db->close();

            
        }
        else
        {
            $result["error"]=$validateData;
        }

        break;

    case 'del':

        $sql ="DELETE FROM productos WHERE productoId={$id}";

        if($res = $db->query($sql))
        {
            $result["success"]=true;
        }
        else
        {
            $result["error"]=$db->errno;
        }

        break;
}


echo json_encode($result);


