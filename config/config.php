<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/29
 * Time: 16:06
 */

return [
    'server' => [
        'host'    => '0.0.0.0',
        'port'    => 9501,
        'setting' => [
            'daemonize'             => 0,
            'enable_static_handler' => TRUE,
            #'document_root' => BASE_PATH . '/static/',
            'worker_num'            => 4,
            'max_request'           => 10000,
            //'task_worker_num' => 4,  // 如果需要开启任务 才需要配置改参数
        ],
    ],
    'mysql'  => [
        'dsn'              => [
            'host'     => '127.0.0.1',
            'port'     => 3306,
            'user'     => 'root',
            'password' => 'A123456',
            'database' => 'dw',
        ],
        'poll_max_numbers' => 5
    ],
];