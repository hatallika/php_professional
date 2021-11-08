<?php

namespace app\engine;

class Message
{
    public function getMessageAuth(){

        $session = (new Session());
        if (isset($session->get('message')['login'])) {
            $message = $session->get('message')['login'];
            unset($_SESSION['message']['login']);
        }
        return $message;
    }

    public function getMessageException(){
        $message ="";
        $session = (new Session());


        if (isset($session->get('message')['exception'])) {
            $message = $session->get('message')['exception'];
            unset($_SESSION['message']['exception']);
        }
        return $message;
    }


}