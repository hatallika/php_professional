<?php

namespace app\engine;

class Session
{
    public static function addSession($name, $value){
        $_SESSION[$name] = $value;
    }
}