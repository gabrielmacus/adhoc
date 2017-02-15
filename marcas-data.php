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

        $sql="SELECT c.*,t.*,d.* FROM clientes c LEFT JOIN direcciones d ON c.clienteId=d.direccionCliente LEFT JOIN telefonos t ON c.clienteId= t.telefonoCliente";
        if($id)
        {
            $sql.=" WHERE c.clienteId={$id}";
        }

        $clientes=array();

        if($res=$db->query($sql))
        {
            $res=$res->fetch_all(1);

            foreach ($res as $cliente)
            {
                $productoId=$cliente["clienteId"];

                $clientes[$productoId]["clienteNombre"]=$cliente["clienteNombre"];
                $clientes[$productoId]["clienteApellido"]=$cliente["clienteApellido"];
                $clientes[$productoId]["clienteNotas"]=$cliente["clienteNotas"];
                $clientes[$productoId]["clienteCreacion"]=$cliente["clienteCreacion"];
                $clientes[$productoId]["clienteModificacion"]=$cliente["clienteModificacion"];

                if($cliente["direccionId"])
                {
                    $direccion["id"]=$cliente["direccionId"];
                    $direccion["numero"]=$cliente["direccionNumero"];
                    $direccion["calle"]=$cliente["direccionCalle"];
                    $direccion["piso"]=$cliente["direccionPiso"];
                    $direccion["depto"]=$cliente["direccionDepto"];
                    $direccion["notas"]=$cliente["direccionNotas"];


                    $clientes[$productoId]["direcciones"][$cliente["direccionId"]]=$direccion;
                }
                if($cliente["telefonoId"])
                {
                    $telefono["id"]=$cliente["telefonoId"];
                    $telefono["numero"]=$cliente["telefonoNumero"];


                    $clientes[$productoId]["telefono"][$cliente["telefonoId"]]=$telefono;
                }

            }

            $clientes=  array_values($clientes);







            $result["success"]=true;
            $result["data"]=$clientes;
        }
        else
        {
            $result["error"]=$db->errno;
        }



        break;

    case 'add':

        $validateData=validateData($_POST);


        if($validateData===true) {
            $sqlMarcas = "REPLACE INTO marcas SET ";


            foreach ($_POST as $k=>$v)
            {
                if(!is_array($v)&&!empty($v))
                {
                    $sqlMarcas.="{$k}='{$v}',";
                }
            }

            $sqlMarcas=rtrim($sqlMarcas,",");

            if($id)
            {
                $sqlMarcas.=",marcaId={$id}";
            }


            $error=0;
            $db->query($sqlMarcas);
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


            $result["sql"][]=$sqlMarcas;

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
    case 'logo':

     $result= uploadFiles($_FILES,"images",  $config["ftp"]);


        break;
}


echo json_encode($result);


