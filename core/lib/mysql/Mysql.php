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

    /**
     * @return \Swoole\Coroutine\MySQL
     */
    public function getConnection()
    {
        $instance = static::getInstance();
        if (empty($this->pools)) {
            $instance->generatePool();
        }
        return $instance->getActive();
    }

    /**
     *
     * 产生mysql连接池
     * @Time 2019/4/30 9:38
     */
    private function generatePool()
    {
        for ($i = 0; $i <= 5; $i++) {
            $client = new swMysql();

            $client->connect([
                'host'     => 'mysql',
                'port'     => 3306,
                'user'     => 'root',
                'password' => 'A123456',
                'database' => 'jizhangben',
            ]);

            $this->pools[] = $client;
        }
    }

    private function getActive()
    {
        return $this->pools[mt_rand(0, 5)];
    }

    public static function query($sql)
    {
        $connected = self::getInstance()->getConnection();
        $stmt      = $connected->prepare($sql);
        if ($stmt == false) {
            var_dump($connected->errno, $connected->error);
        } else {
            return $stmt->execute();
        }
    }


}