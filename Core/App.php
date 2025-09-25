<?php
namespace Core;
class App
{
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
        
    }

     public static function container()
    {
        return static::$container ;
        
    }

    public static function bind($key,$resolver)
    {
      static::$container->bind($key,$resolver);
    }
    
    public static function resolve($key)
    {
     if (!static::$container) {
            throw new \Exception('Container not initialized.');
        }
        return static::$container->resolve($key);
    }
    
}

?>