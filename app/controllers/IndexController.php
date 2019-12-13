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
        $result = Mysql::query("select * from t_pocket where user_id = xxx");

//        $data = [
//            'code' => 0,
//            'msg' => 'index controller'
//        ];
        return $this->asJson($result);
    }

    public function actionAdd()
    {
        $sql = "insert into t_pocket(user_id,zb_type,amount,create_time,remark) values (1,1,10.2,now(),'ces')";
        $result = Mysql::query($sql);
        return $this->asJson($result);
    }
}
