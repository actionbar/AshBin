<?php
namespace C\AutoLoad;
/*  参考thrift的自动引入，包括对namespace的自动引入 
在官方 lib/Thrift/ClassLoader/ThriftClassLoader.php

*/



abstract class FileDefinitionAb{
    protected $definitions = array();
    abstract function registerDefinition($namespace, $paths);
    abstract function findFile($namespace, $class);
}


class AutoLoad{
    /**
     * Namespaces path
     * @var array
     */
    protected $namespaces = array();

    /*
      自定义类文件，通常用于一个文件下放置多个类，如 FileDefinitionThrift.php 中
    就是自动引入 Thrift自动生成的 Types.php 和 xxx.php 【包含类 xxxClient  xxxIf 等】
    比如 Thrift 的 Tf/ 下面的所有生成的php ，
    $FileDefinitionThrift = new FileDefinitionThrift();
    $FileDefinitionThrift->registerDefinition('Tf', __DIR__);
    // 用 array 防止出现多个 namespace 以 Tf 开头的，
    'Tf' => array($FileDefinitionThrift)


    */
    protected $fileDefinitions = array();

    /**
     * Do we use APC cache ?
     * @var boolean
     */
    protected $apc = false;

    /**
     * APC Cache prefix
     * @var string
     */
    protected $apc_prefix;

    /**
     * Set autoloader to use APC cache
     * @param boolean $apc
     * @param string $apc_prefix
     */
    public function __construct($apc = false, $apc_prefix = null)
    {
        $this->apc = $apc;
        $this->apc_prefix = $apc_prefix;
    }

    /**
     * Registers a namespace.
     *
     * @param string       $namespace The namespace
     * @param array|string $paths     The location(s) of the namespace
     */
    public function registerNamespace($namespace, $paths)
    {
        $this->namespaces[$namespace] = (array) $paths;
    }

    public function registerDefinitionClass($namespace, $paths, $class){

        $class->registerDefinition($namespace, $paths);
        $this->fileDefinitions[$namespace][] = $class;
    }


    /**
     * Registers this instance as an autoloader.
     *
     * @param Boolean $prepend Whether to prepend the autoloader or not
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    /**
     * Loads the given class, definition or interface.
     *
     * @param string $class The name of the class
     */
    public function loadClass($class)
    {
        if (
            (true === $this->apc && ($file = $this->findFileInApc($class))) or
            ($file = $this->findFile($class))
        )
        {
            require_once $file;
        }
    }

    /**
     * Loads the given class or interface in APC.
     * @param string $class The name of the class
     * @return string
     */
    protected function findFileInApc($class)
    {
        if (false === $file = apc_fetch($this->apc_prefix.$class)) {
            apc_store($this->apc_prefix.$class, $file = $this->findFile($class));
        }

        return $file;
    }

    /**
     * Find class in namespaces or definitions directories
     * @param string $class
     * @return string
     */
    public function findFile($class)
    {
        // Remove first backslash
        if ('\\' == $class[0])
        {
            $class = substr($class, 1);
        }

        if (false !== $pos = strrpos($class, '\\'))
        {
            // Namespaced class name
            $namespace = substr($class, 0, $pos);

            // Iterate in normal namespaces
            foreach ($this->namespaces as $ns => $dirs)
            {
                //Don't interfere with other autoloaders
                if (0 !== strpos($namespace, $ns))
                {
                    continue;
                }

                foreach ($dirs as $dir)
                {
                    $className = substr($class, $pos + 1);

                    $file = $dir.DIRECTORY_SEPARATOR.
                                 str_replace('\\', DIRECTORY_SEPARATOR, $namespace).
                                 DIRECTORY_SEPARATOR.
                                 $className.'.php';

                    if (file_exists($file))
                    {
                        return $file;
                    }
                }
            }
            return $this->findFileInDef($class);
        }
    }


    /* 从自定义文件夹查找文件，如DefinitionThrift*/
    public function findFileInDef($class){
        // Remove first part of namespace
        $m = explode('\\', $class);
        // Ignore wrong call
        if(count($m) <= 1)
        {
            return;
        }
        $class = array_pop($m);
        $namespace = implode('\\', $m);
        //echo $namespace;



        foreach ($this->fileDefinitions as $ns => $definitionClassArr){
            if (0 !== strpos($namespace, $ns))
            {
                continue;
            }


            // 防止出现namespace 相同，但是目录不同的class
        foreach($definitionClassArr as $definitionClass){

            $file = $definitionClass->findFile($namespace, $class);
            if($file){
                return $file;
            }
        }
        }

    }



}