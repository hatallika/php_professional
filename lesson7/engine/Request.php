<?php

namespace app\engine;

class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;

    protected $session;

    protected $method; //имя метода get post delete
    protected $params=[];


    public function __construct()
    {
        $this->parseRequest();
    }

    protected function parseRequest()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];// строка запроса пользователя
        $this->method = $_SERVER['REQUEST_METHOD']; //get post

        $url = explode('/', $this->requestString);

        $this->controllerName = $url[1];
        $this->actionName = $url[2];

        $this->params = $_REQUEST;

        // для работы с POST в JS
        $data = json_decode(file_get_contents('php://input'));
        if (!is_null($data)){
            foreach ($data as $key => $value){
                $this->params[$key] = $value;
            }
        }

        $this->params['session_id'] = session_id();

        $this->session = $_SESSION;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }





}