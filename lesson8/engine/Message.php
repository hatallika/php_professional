<?php

namespace app\engine;

use app\models\repositories\FeedbackRepository;

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
// универсальные
    public function setMessage ($name, $value){
        $_SESSION['message'] = [$name => $value];
    }

    public function getMessage ($name){
        $session = App::call()->session;
        if (isset($session->get('message')[$name])) {
            $message = $session->get('message')[$name];
            unset($_SESSION['message'][$name]);
        }
        return $message;
    }


}