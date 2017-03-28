<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 28/03/2017
 * Time: 2:58
 */
class Repositorio
{
    protected $id;
    protected $name;
    protected $path;

    /**
     * Repositorio constructor.
     * @param $id
     * @param $name
     * @param $path
     */
    public function __construct($id, $name, $path)
    {
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }



}