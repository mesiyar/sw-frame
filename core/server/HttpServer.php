<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/25
 * Time: 17:17
 */

namespace core\server;

use core\lib\App;
use \Swoole\Http\Server;

class HttpServer
{
    private $host = '0.0.0.0';

    private $port = 9501;

    public function __construct()
    {
        $server = new Server($this->host, $this->port);
        $server->set([
            'daemonize' => 0,
            'enable_static_handler' => TRUE,
            'document_root' => BASE_PATH . '/static/',
            'worker_num' => 4,
            'max_request' => 10000,
            //'task_worker_num' => 4,
        ]);

        $server->on("start", [$this, 'onStart']);

        $server->on("request", [$this, 'onRequest']);

        $server->start();
    }

    public function onStart()
    {
        echo "Swoole http server is started at http://{$this->host}:{$this->port}\n";
    }

    public function onRequest($request, $response)
    {
        App::get_instance()->http($request, $response);
    }
}