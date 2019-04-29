<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/25
 * Time: 17:37
 */

namespace core\lib;

class Loader
{
    // 类名映射
    protected static $map = [];
    //命名空间映射
    protected static $namespaces = [];

    public static function register()
    {
        spl_autoload_register('\\core\\lib\\Loader::autoload', true, true);
        //self::addNamespace('core', BASE_PATH . 'core/');
    }

    public static function autoload($class)
    {
        if ($file = self::find($class)) {
            include $file;
            return true;
        }
    }

    //查找文件，并映射到$map
    private static function find($class)
    {
        if (!empty(self::$map[$class])) {   //如果已存在就直接返回
            return self::$map[$class];
        }
        //下面就是找啊找。。
        $classes = array_filter(explode('\\', $class));

        $logicalPath = join(DIRECTORY_SEPARATOR, $classes) . '.php';

        $fileRealPath = BASE_PATH . $logicalPath;

        if (is_file($fileRealPath)) {  // 如果命名空间已注册，那就往下找。
            self::$map[$class] = $fileRealPath;
            return $fileRealPath;
        } else {
            echo "{$fileRealPath} 找啊找，找不到，你说气人不气人", PHP_EOL;
        }
        return false;
    }

    // 注册 类
    public static function addMap($class, $map = '')
    {
        self::$map[$class] = $map;
    }

    // 注册命名空间
    public static function addNamespace($namespace, $path = '')
    {
        self::$namespaces[$namespace] = rtrim($path, '/') . DIRECTORY_SEPARATOR;
    }
}