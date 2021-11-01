<?php

namespace app\engine;

class Session
{
    protected $params=[];
    public function __construct()
    {
        $this->parseSession();
    }


    protected function parseSession()
    {
        $this->params = $_SESSION;
        $this->params['session_id'] = session_id();
    }

    public static function addSession($name, $value){
        $_SESSION[$name] = $value;
    }


    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

}