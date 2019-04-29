<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/28
 * Time: 14:38
 */

namespace app\controllers;

use core\lib\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $data = [
            'code' => 0,
            'msg' => 'index controller'
        ];

        return $this->asJson($data);
    }
}
