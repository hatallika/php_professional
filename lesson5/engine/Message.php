<?php

namespace app\engine;

class Message
{
    static function getMessageAuth(){

        if (isset($_SESSION['message']['login'])) {
            $message = $_SESSION['message']['login'];
            unset($_SESSION['message']['login']);
        }
        return $message;
    }
}