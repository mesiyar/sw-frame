<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/25
 * Time: 17:15
 */
define('BASE_PATH', __DIR__ . '/');

require BASE_PATH . 'vendor/autoload.php';

new core\server\HttpServer();