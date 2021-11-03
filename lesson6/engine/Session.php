<?php

namespace app\engine;

class Session
{
    public function set($name, $value){
        $_SESSION[$name] = $value;
    }

// доделать
}