<?php

namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }


    public function execute()
    {
        if(Application::isGuest()) {
            if(empty($this->actions) || in_array(Application::$app->controller->action , $this->actions)){
                /* actions array includes the pages which we want to protect with auth middleware , if it is empty,
                it means all pages should be protected with this class */
                throw new ForbiddenException();
            }
        }
    }
}