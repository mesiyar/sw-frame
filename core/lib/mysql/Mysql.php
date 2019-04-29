<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/29
 * Time: 15:40
 */
namespace core\lib\mysql;

class Mysql
{
    /**
     * @var Mysql
     */
    private static $instance = null;

    private function __construct()
    {
    }

    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            self::$instance->generatePoll();
        }
        return self::$instance;
    }

    private function generatePoll()
    {

    }


}