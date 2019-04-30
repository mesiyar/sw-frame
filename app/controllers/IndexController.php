<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/28
 * Time: 14:38
 */

namespace app\controllers;

use core\lib\Controller;
use core\lib\mysql\Mysql;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $query = Mysql::getInstance();
        $result = $query->query('select * from gm_user limit 1');

        //$res = $swoole_mysql->query('select * from gm_user limit 100');
//        $data = [
//            'code' => 0,
//            'msg' => 'index controller'
//        ];

        return $this->asJson($result);
    }
}
