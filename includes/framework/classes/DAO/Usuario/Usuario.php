<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 06:01 PM
 */
class Usuario extends Persona
{
    protected $email;
    protected $password;
    protected $nickname;

    public function __construct($name, $surname, $age, $id,$email,$password,$nickname)
    {
        $this->email=$email;
        $this->password=hash("md5",$password);
        $this->nickname=$nickname;
        parent::__construct($name, $surname, $age, $id);
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getId()
    {
        return parent::getId(); // TODO: Change the autogenerated stub
    }

    public function setId($id)
    {
        parent::setId($id); // TODO: Change the autogenerated stub
    }

    public function getName()
    {
        return parent::getName(); // TODO: Change the autogenerated stub
    }

    public function setName($name)
    {
        parent::setName($name); // TODO: Change the autogenerated stub
    }

    public function getSurname()
    {
        return parent::getSurname(); // TODO: Change the autogenerated stub
    }

    public function setSurname($surname)
    {
        parent::setSurname($surname); // TODO: Change the autogenerated stub
    }

    public function getAge()
    {
        return parent::getAge(); // TODO: Change the autogenerated stub
    }

    public function setAge($age)
    {
        parent::setAge($age); // TODO: Change the autogenerated stub
    }


}