<?php

namespace sarahh1417\phpmvc\exception;


class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to visit this page';
    protected $code = 403;
}