<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 01:13 PM
 */


require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Usuario/IUser.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/Usuario/User.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/adhoc/includes/framework/classes/DAO/DataSource.php");


class UserDAO implements IUser
{

    protected $dataSource;
    protected $tableName;
    protected $users;
    private $insertSql;
    private $updateSql;

    /**
     * UserDAO constructor.
     * @param $dataSource
     * @param $tableName
     */
    public function __construct(DataSource $dataSource, $tableName="usuarios")
    {
        $this->dataSource = $dataSource;
        $this->tableName = $tableName;
        $this->insertSql="INSERT INTO  {$this->tableName} 
 (usuario_id, usuario_email, usuario_password, usuario_nickname, 
 usuario_age, usuario_name, usuario_surname, usuario_creation, 
 usuario_modification)
 VALUES (:usuario_id, :usuario_email, :usuario_password, 
 :usuario_nickname, :usuario_age, :usuario_name, 
 :usuario_surname, :usuario_creation, :usuario_modification)";

        $this->updateSql="UPDATE {$this->tableName}  SET usuario_id=:usuario_id,
usuario_email=:usuario_email,usuario_password=:usuario_password,usuario_nickname=:usuario_nickname
,usuario_age=:usuario_age,usuario_name=:usuario_name,
usuario_surname=:usuario_surname,usuario_creation=:usuario_creation,usuario_modification=:usuario_modification WHERE usuario_id=:usuario_id";

    }



    public function insertUsuario(User $u)
    {
        $this->validate($u);
        
        $sql = $this->insertSql;

        if(!$u->getCreation())
        {
            $u->setCreation(time());
        }
        if(!$u->getModification())
        {
            $u->setModification(time());
        }

        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($u));
        return $res;
    }

    private function getParamsArray($u)
    {
        return    array(
            ":usuario_id"=>$u->getId(),
            ":usuario_email"=>$u->getEmail(),
            ":usuario_password"=>$u->getPassword(),
            ":usuario_nickname"=>$u->getNickname(),
            ":usuario_age"=>$u->getAge(),
            ":usuario_name"=>$u->getName(),
            ":usuario_surname"=>$u->getSurname(),
            ":usuario_creation"=>$u->getCreation(),
            ":usuario_modification"=>$u->getModification()
        );
    }
    private function query($data)
    {
        $u = new User($data["usuario_name"],$data["usuario_surname"],$data["usuario_age"],$data["usuario_email"],
            $data["usuario_password"],$data["usuario_nickname"]
            ,$data["usuario_creation"],$data["usuario_modification"]);
        array_push($this->users, $u);

    }



    public function selectUsuarios()
    {
        $sql = "SELECT * FROM {$this->tableName}";

        $this->dataSource->runQuery($sql,array(),function($data){
            
            $this->query($data);

        });

        return $this->users[0];
    }

    public function selectUsuarioById($id)
    {

        $sql = "SELECT * FROM {$this->tableName} WHERE usuario_id=:usuario_id";

        $this->dataSource->runQuery($sql,array(":usuario_id"=>$id),function($data){
            $this->query($data);
        });

        return $this->users[0];
    }

    public function updateUsuario(User $u)
    {
        $this->validate($u);
        
        $sql = $this->updateSql;
        $res= $this->dataSource->runUpdate($sql,
            $this->getParamsArray($u));
        return $res;
    }

    public function deleteUsuarioById($id)
    {

        $sql = "DELETE FROM {$this->tableName} WHERE usuario_id= :usuario_id";

        $res= $this->dataSource->runUpdate($sql,
            array(
                ":usuario_id"=>$id
            ));
        return $res;
    }

    public function validate(User $u)
    {
        // TODO: Implement validate() method.
    }


}