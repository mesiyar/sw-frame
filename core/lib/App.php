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
     * @var Request
     */
    public static $request = null;

    public static $response = null;
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

        App::$request = Request::getInstance();
        App::$request->set($request);

        App::$response = $response;

        try {
            if (!empty(ob_get_contents())) ob_end_clean();
            ob_start();
            $map = App::$request->parse();
            /**
             * @var $controller Controller
             */
            if (class_exists($map['class'])) {
                if (!isset(self::$classMap[$map['class']])) {
                    $controller                    = new $map['class'];
                    self::$classMap[$map['class']] = $controller;
                } else {
                    $controller = self::$classMap[$map['class']];
                }
                $controller->run($map['action']);
            } else {
                Log::log("class {$map['class']} not found!", Log::ERROR);
            }

            $content = ob_get_contents();
            ob_end_clean();

            $response->end($content);
        } catch (\Exception $e) {
            $response->header("Content-Type", "text/html");
            $response->end(json_encode(['code' => $e->getCode(), 'message' => $e->getMessage()] . JSON_UNESCAPED_UNICODE));
        }
    }

}