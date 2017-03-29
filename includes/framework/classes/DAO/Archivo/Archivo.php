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
    protected $creation;
    protected $tmpPath;
    protected $modification;
    protected $id;
    protected $config;
    protected $repositorio;
    protected  $path;
    protected $realName;
    protected $version;
    protected $versionName;
    protected $type;
    /**
     * Archivo constructor.
     * @param $size
     * @param $name
     * @param $mime
     * @param $tmpPath
     * @param $creation
     * @param $modification
     * @param $repositorio
     * @param $id
     */
    
    public function __construct($size, $name, $mime,$version=null,$realName=null, $tmpPath=null,Repositorio $repositorio,$path=null,$creation=null, $modification=null,$id=null,$versionName=null,$type=0)
    {

        $this->size = $size;
        $this->name = $name;
        $ext = explode(".",$name);
        $this->extension  = $ext[count($ext)-1];
        $this->mime = $mime;
        $this->tmpPath=$tmpPath;
        $this->creation = $creation;
        $this->modification = $modification;
        $this->id = $id;
        $this->repositorio=$repositorio;
        $this->path=$path;
        $this->version=$version;
        $this->realName=$realName;
        $this->versionName=$versionName;
        $this->type=$type;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    
    /**
     * @return null
     */
    public function getVersionName()
    {
        return $this->versionName;
    }

    /**
     * @param null $versionName
     */
    public function setVersionName($versionName)
    {
        $this->versionName = $versionName;
    }




    /**
     * @return bool
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * @param bool $realName
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
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



    /**
     * @return Repositorio
     */
    public function getRepositorio()
    {
        return $this->repositorio;
    }

    /**
     * @param Repositorio $repositorio
     */
    public function setRepositorio($repositorio)
    {
        $this->repositorio = $repositorio;
    }


    
    /**
     * @return mixed
     */
    public function getTmpPath()
    {
        return $this->tmpPath;
    }

    /**
     * @param mixed $tmpPath
     */
    public function setTmpPath($tmpPath)
    {
        $this->tmpPath = $tmpPath;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }




    /**
     * @return bool
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param bool $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getCreation()
    {
        return $this->creation;
    }

    /**
     * @param mixed $creation
     */
    public function setCreation($creation)
    {
        $this->creation = $creation;
    }

    /**
     * @return mixed
     */
    public function getModification()
    {
        return $this->modification;
    }

    /**
     * @param mixed $modification
     */
    public function setModification($modification)
    {
        $this->modification = $modification;
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


   
    
}