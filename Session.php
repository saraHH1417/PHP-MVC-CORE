<?php

namespace sarahh1417\phpmvc;

class Session
{
    protected const FLASH_KEY = 'flash_messages';
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
                'remove' => false,
                'value' => $message
            ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? $_SESSION[self::FLASH_KEY][0]['value'] ?? false ;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] =  $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
//         Iterate over marked to be removed

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key=> &$flashMessage) {
            if($flashMessage['remove']) {
                unset($flashMessages[0]);
            }
        }

        $flashMessages = array_values($flashMessages);
        $_SESSION[self::FLASH_KEY] = $flashMessages;

    }

}