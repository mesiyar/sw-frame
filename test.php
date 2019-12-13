<?php



    $swoole_mysql = new Swoole\Coroutine\MySQL();
    $swoole_mysql->connect([
        'host' => 'mysql',
        'port' => 3306,
        'user' => 'root',
        'password' => 'A123456',
        'database' => 'jizhangben',
    ]);
    $res = $swoole_mysql->query('select * from test');

    var_dump($res);

