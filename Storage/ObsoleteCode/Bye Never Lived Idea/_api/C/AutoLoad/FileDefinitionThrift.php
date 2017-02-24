<?php
namespace C\AutoLoad;
/* 
引入 Thrift 生成的php代码，代码位置在 Tf 目录下 */


class FileDefinitionThrift extends \C\AutoLoad\FileDefinitionAb{
     /**
     * Thrift definition paths
     * @var type
     */
    protected $definitions = array();
        /**
     * Registers a Thrift definition namespace.
     *
     * @param string       $namespace The definition namespace
     * @param array|string $paths     The location(s) of the definition namespace
     */
    public function registerDefinition($namespace, $paths)
    {
        $this->definitions[$namespace] = (array) $paths;
    }
    
    
    public function findFile($namespace, $class){
        foreach ($this->definitions as $ns => $dirs)
        {
            //Don't interfere with other autoloaders
            if (0 !== strpos($namespace, $ns))
            {
                continue;
            }

            foreach ($dirs as $dir)
            {
                /**
                 * Available in service: Interface, Client, Processor, Rest
                 * And every service methods (_.+)
                 */
                if(
                    0 === preg_match('#(.+)(if|client|processor|rest)$#i', $class, $n) and
                    0 === preg_match('#(.+)_[a-z0-9]+_(args|result)$#i', $class, $n)
                )
                {
                    $className = 'Types';
                }
                else
                {
                    $className = $n[1];
                }

                $file = $dir.DIRECTORY_SEPARATOR .
                    str_replace('\\', DIRECTORY_SEPARATOR, $namespace) .
                    DIRECTORY_SEPARATOR .
                    $className . '.php';

                if (file_exists($file))
                {
                    return $file;
                }
            }
        }
    }
    

}