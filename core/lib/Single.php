<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/29
 * Time: 20:22
 */

namespace core\lib;


trait Single
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance(...$args)
    {
        if (is_null(self::$instance)) {
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }
}