<?php

namespace sarahh1417\phpmvc;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function response(string $url)
    {
        header("Location:". $url);
    }

    public function redirect(string $url)
    {
        header("Location:" . $url);
    }
}