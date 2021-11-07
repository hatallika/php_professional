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

    static function getMessageException(){
        $message ="";
        $session = (new Session());


        if (isset($session->get('message')['exception'])) {
            $message = $session->get('message')['exception'];
            unset($_SESSION['message']['exception']);
        }
        return $message;
    }


}