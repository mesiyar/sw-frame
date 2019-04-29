<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/28
 * Time: 15:52
 */

namespace core\lib;


use core\exception\HttpException;

Trait ViewTrait
{
    public function render($file, $params)
    {
        $class = get_called_class();

        $class = explode('\\', $class);
        $realFile = BASE_PATH . '/' . $class[0];
        //$action = App::get_instance()->

    }

    private function rederFile($file)
    {
        if (is_file($file)) {
            include_once $file;
        } else {
            throw new HttpException(404, 'view file not found');
        }
    }
}