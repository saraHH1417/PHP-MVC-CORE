<?php

namespace sarahh1417\phpmvc\exception;

class NotFoundException extends \Exception
{
    protected $message = 'Page not found.';
    protected $code = 404;
}