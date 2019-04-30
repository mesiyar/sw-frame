<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/29
 * Time: 15:40
 */

namespace core\lib\mysql;

use core\lib\Single;
use \Swoole\Coroutine\MySQL as swMysql;

class Mysql
{
    use Single;

    private $pools = [];

    /**
     * @var int 默认连接池的最小数是1
     */
    private $min = 1;

    /**
     * @var int 默认连接池的最大数是10
     */
    private $max = 10;

    private $host = '127.0.0.1';

    private $port = 3306;

    private $user = 'root';

    private $password = 'root';

    private $database = '';

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            self::$instance->generatePool();
        }
        return self::$instance->getActive();
    }

    /**
     *
     * 产生mysql连接池
     * @Time 2019/4/30 9:38
     */
    private function generatePool()
    {
        for ($i = 0; $i < 5; $i++) {
            $client = new swMysql();

            $client->connect([
                'host' => '192.168.1.21',
                'port' => 3306,
                'user' => 'gm',
                'password' => 'gm@GM123',
                'database' => 'hefu',
            ]);

            $this->pools[] = $client;
        }
    }

    private function getActive()
    {
        return $this->pools[mt_rand(0, 5)];
    }


}