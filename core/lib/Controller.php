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
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function run($actionName)
    {
        echo $actionName.PHP_EOL;
        $actionName = 'action' . $actionName;
        if(method_exists($this, $actionName)) {
            $content = $this->$actionName();
            include BASE_PATH.'/app/views/layouts/main.php';
        } else {
            throw new HttpException(404,'function not exists');
        }
        //return $result;
    }


}