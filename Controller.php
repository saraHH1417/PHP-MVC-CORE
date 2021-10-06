<?php

namespace sarahh1417\phpmvc;
use \sarahh1417\phpmvc\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var \sarahh1417\phpmvc\middlewares\BaseMiddleware[]
    */
    protected  array $middlewares = [];

    /**
     * @return middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
    public function setLayout($layout)
    {
        return $this->layout = $layout;
    }
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

}