<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 29/03/2017
 * Time: 1:30
 */
class Imagen extends Archivo
{
    protected $ancho;
    protected $alto;
    public function __construct($size, $name, $mime, $version = null, $realName = null, $tmpPath = null, Repositorio $repositorio, $path = null, $creation = null, $modification = null, $id = null, $versionName = null,$ancho=null,$alto=null)
    {
        $this->ancho=$ancho;
        $this->alto=$alto;
        parent::__construct($size, $name, $mime, $version, $realName, $tmpPath, $repositorio, $path, $creation, $modification, $id, $versionName,1);
    }

    /**
     * @return mixed
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * @param mixed $ancho
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    }

    /**
     * @return mixed
     */
    public function getAlto()
    {
        return $this->alto;
    }

    /**
     * @param mixed $alto
     */
    public function setAlto($alto)
    {
        $this->alto = $alto;
    }


}