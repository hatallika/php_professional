<?php

namespace app\engine;

class Message
{
    static function getMessageAuth(){

        $session = (new Session());
        if (isset($session->get('message')['login'])) {
            $message = $session->get('message')['login'];
            unset($session->get('message')['login']);
        }
        return $message;
    }
}