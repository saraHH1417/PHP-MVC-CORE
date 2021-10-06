<?php

namespace app\core\exception;


class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to visit this page';
    protected $code = 403;
}