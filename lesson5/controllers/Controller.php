<?php

namespace app\controllers;

use app\engine\Auth;
use app\engine\Message;
use app\engine\Render;
use app\interfaces\IRenderer;
use app\models\Users;

abstract class Controller
{
    private $action;
    protected $defaultAction = 'index';
    private $layout ='main';
    private $useLayout = true; //использовать ли шаблон по умолчанию.


    protected $render;

    public function __construct(IRenderer $render)
    {
        $this->render = $render;
    }

    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction; //if null take catalog
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method)){
            $this->$method();
        };
    }

    public function render($template, $params=[])
    {
        if($this->useLayout){

            return $this->renderTemplate('layouts/'.$this->layout, [
                'menu' => $this->renderTemplate('menu', $params),
                'content' => $this->renderTemplate($template, $params), //либо index, либо catalog, либо card
                'auth' => $this->renderTemplate('auth', [
                    'auth' => Users::isAuth(),
                    'username'=> Users::get_user(),
                    'message_auth' =>Message::getMessageAuth()])
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params=[])
    {
        return $this->render->renderTemplate($template, $params);
    }

}