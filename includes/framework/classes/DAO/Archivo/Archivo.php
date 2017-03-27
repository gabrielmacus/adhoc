<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 06:01 PM
 */
class Archivo
{

    protected $size;
    protected $name;
    protected $extension;
    protected $mime;
    protected $path;

    /**
     * Archivo constructor.
     * @param $size
     * @param $name
     * @param $extension
     * @param $mime
     * @param $path
     */
    public function __construct($size, $name, $extension, $mime, $path)
    {
        $this->size = $size;
        $this->name = $name;
        $this->extension = $extension;
        $this->mime = $mime;
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
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
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return mixed
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @param mixed $mime
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
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