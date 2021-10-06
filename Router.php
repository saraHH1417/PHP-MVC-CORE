<?php

namespace app\core;

use app\core\exception\NotFoundException;
use http\Params;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(\app\core\Request $request , Response $response)
        // we can both put the name space or remove it in the cunstroctor parentheses because namespaces are the same here
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
//        echo "<pre>";
//        echo gettype($_SERVER);
//        echo var_dump($_SERVER);
//        echo "</pre>";
//        exit;

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if(is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }
        if(is_array($callback)) {
            /** @var \app\core\Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach($controller->getMiddlewares() as $middleware)
            {
                $middleware->execute();
            }
        }
        return call_user_func($callback , $this->request , $this->response);
    }



}
