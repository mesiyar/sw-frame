<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/28
 * Time: 14:45
 */

namespace core\lib;


use core\exception\HttpException;

class Controller
{
    use ViewTrait;

    private $response = '';

    /**
     * 格式化成json格式
     * @Time 2019/4/28 14:53
     * @param $data
     */
    public function asJson($data)
    {
        App::$response->header("Content-Type", "application/json");
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        return $this;
    }

    public function run($actionName)
    {
        $actionName = 'action' . $actionName;
        if (method_exists($this, $actionName)) {
            $ref = new \ReflectionClass($this);
            Log::log($ref->name . '/' . $actionName, Log::INFO);
            $this->$actionName();
        } else {
            Log::log('function not exists', Log::ERROR);
            echo 404, 'function not exists';
        }
    }




}