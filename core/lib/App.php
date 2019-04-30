<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 2019/4/25
 * Time: 18:00
 */

namespace core\lib;



class App
{
    use Single;

    /**
     * @var array
     */
    private static $classMap;

    private function __construct()
    {
    }

    public function http($request, $response)
    {
        if ($request->server['request_uri'] == '/favicon.ico') return;

        $req = Request::getInstance();
        $req->set($request);

        try {
            if (!empty(ob_get_contents())) ob_end_clean();
            ob_start();
            $map = $req->parse();
            /**
             * @var $controller Controller
             */
            if (!isset(self::$classMap[$map['class']])) {
                $controller = new $map['class'];
                self::$classMap[$map['class']] = $controller;
            } else {
                $controller = self::$classMap[$map['class']];
            }

            $controller->run($map['action']);

            $content = ob_get_contents();
            ob_end_clean();
            echo "aaa".PHP_EOL;
            $response->header("Content-Type", "text/html");
            //$response->header("Charset", "UTF-8");
            $response->end($content);
        } catch (\Exception $e) {
            $response->header("Content-Type", "text/html");
            $response->end(json_encode(['code' => $e->getCode(), 'message' => $e->getMessage()] . JSON_UNESCAPED_UNICODE));
        }
    }

}