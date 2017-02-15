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
                $clienteId=$cliente["clienteId"];

                $clientes[$clienteId]["clienteNombre"]=$cliente["clienteNombre"];
                $clientes[$clienteId]["clienteApellido"]=$cliente["clienteApellido"];
                $clientes[$clienteId]["clienteNotas"]=$cliente["clienteNotas"];
                $clientes[$clienteId]["clienteCreacion"]=$cliente["clienteCreacion"];
                $clientes[$clienteId]["clienteModificacion"]=$cliente["clienteModificacion"];

                if($cliente["direccionId"])
                {
                    $direccion["id"]=$cliente["direccionId"];
                    $direccion["numero"]=$cliente["direccionNumero"];
                    $direccion["calle"]=$cliente["direccionCalle"];
                    $direccion["piso"]=$cliente["direccionPiso"];
                    $direccion["depto"]=$cliente["direccionDepto"];
                    $direccion["notas"]=$cliente["direccionNotas"];


                    $clientes[$clienteId]["direcciones"][$cliente["direccionId"]]=$direccion;
                }
                if($cliente["telefonoId"])
                {
                    $telefono["id"]=$cliente["telefonoId"];
                    $telefono["numero"]=$cliente["telefonoNumero"];


                    $clientes[$clienteId]["telefono"][$cliente["telefonoId"]]=$telefono;
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
            $sqlClientes = "REPLACE INTO clientes SET ";


            foreach ($_POST as $k=>$v)
            {
                if(!is_array($v)&&!empty($v))
                {
                    $sqlClientes.="{$k}='{$v}',";
                }
            }

            $sqlClientes=rtrim($sqlClientes,",");

            if($id)
            {
                $sqlClientes.=",clienteId={$id}";
            }


            $error=0;
            $db->query($sqlClientes);
            $error+=$db->errno;
            $result["errors"][]=$db->error;



            $clienteId=$db->insert_id;


            if(count($_POST["direcciones"])>0) {


                foreach ($_POST["direcciones"] as $direccion) {



                        if(!$direccion["delete"])
                        {
                            $sqlDirecciones="REPLACE INTO direcciones SET ";

                            foreach ($direccion as $k => $v) {
                                if (!is_array($v)) {
                                    if (!empty($v)) {
                                        $sqlDirecciones .= "{$k}='{$v}',";
                                    }

                                }

                            }
                            $sqlDirecciones.="direccionCliente={$clienteId}";

                        }
                        else
                        {
                            $sqlDirecciones="DELETE FROM direcciones WHERE direccionId={$direccion["direccionId"]} ";


                        }

                        $db->query($sqlDirecciones);
                        $error+=$db->errno;
                        $result["errors"][]=$db->error;



                }



                $result["errors"][]=$db->error;

                $error+=$db->errno;

            }




            if(count($_POST["telefonos"])>0)
            {




                foreach ($_POST["telefonos"] as $telefono) {



                        if(!$telefono["delete"])
                        {
                            $sqlTelefonos="REPLACE INTO telefonos SET ";

                            foreach ($telefono as $k => $v) {
                                if (!is_array($v)) {
                                    if (!empty($v)) {
                                        $sqlTelefonos .= "{$k}='{$v}',";
                                    }

                                }

                            }


                            $sqlTelefonos .="telefonoCliente={$clienteId}";


                        }
                        else
                        {
                            $sqlTelefonos="DELETE FROM telefonos WHERE telefonoId={$telefono["telefonoId"]} ";

                        }



                        $db->query($sqlTelefonos);
                        $result["errors"][]=$db->error;

                        $error+=$db->errno;





                }


                  $result["errors"][]=$db->error;

                $error+=$db->errno;

            }




            if($error>0)
            {
                $db->rollback();
                $result["error"]=true;

            }
            else
            {

                $result["success"]=$clienteId;


            }

            $commitResult=$db->commit();


            if(!$commitResult)
            {
                $result["error"]=$db->errno;
            }


            $result["sql"][]=$sqlClientes;
            $result["sql"][]=$sqlDirecciones;
            $result["sql"][]=$sqlTelefonos;
           $db->close();












        }
        else
        {
            $result["error"]=$validateData;
        }

        break;

    case 'del':

        $sql ="DELETE FROM paradas WHERE paradaId={$id}";

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


