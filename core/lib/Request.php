<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/28
 * Time: 10:46
 */

namespace core\lib;


class Request
{
    use Single;

    private $server;
    private $header;
    private $request;
    private $post;
    private $get;
    private $cookie;
    private $files;
    private $tmpfiles;
    private $rawContent;
    private $getData;

    private $defaultAction = 'index';

    private $defaultController = 'index';

    private function __construct()
    {
    }

    //先拿到$request，然后挨个给它变身
    public function set($request)
    {
        $this->server = $request->server;
        $this->header = $request->header;
        $this->tmpfiles = $request->tmpfiles;
        $this->request = $request->request;
        $this->cookie = $request->cookie;
        $this->get = $request->get;
        $this->files = $request->files;
        $this->post = $request->post;
        $this->rawContent = $request->rawContent();
        $this->getData = $request->getData();
    }

    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * 判断当前请求方式是否为get
     * @Time 2019/4/28 11:16
     * @return bool
     */
    public function isGet()
    {
        return $this->server['request_method'] == 'GET';
    }

    /**
     * 判断当前请求方式是否为post
     * @Time 2019/4/28 11:16
     * @return bool
     */
    public function isPost()
    {
        return $this->server['request_method'] == 'POST';
    }

    /**
     * 判断当前请求方式是否为put
     * @Time 2019/4/28 11:16
     * @return bool
     */
    public function isPut()
    {
        return $this->server['request_method'] == 'PUT';
    }

    /**
     * 判断请求是否为ajax请求
     * @Time 2019/4/28 11:21
     * @return bool
     */
    public function isAjax()
    {
        return isset($this->server['HTTP_X_REQUESTED_WITH']) && $this->server['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * 根据request uri 获取程序运行的方法
     * @Time 2019/4/28 20:31
     * @return array
     */
    public function parse()
    {
        $map = explode('/', $this->server['request_uri']);

        if (empty($map)) {
            $controller = $this->defaultController;
            $action = $this->defaultAction;
        } elseif (count($map) == 3) {
            $controller = $this->parseString($map[1]);
            $action = $this->parseString($map[2]);
        } else {
            $controller = $this->parseString($map[1]);
            $action = $this->defaultAction;
        }

        return [
            'class' => "\\app\\controllers\\{$controller}Controller",
            'action' => ucfirst($action)
        ];
    }

    private function parseString($string)
    {
        $array = explode('-', $string);
        $output = '';
        foreach ($array as $value) {
            $output .= ucfirst($value);
        }
        return $output;
    }
}