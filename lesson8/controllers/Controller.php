<?php

namespace app\controllers;


use app\engine\App;
use app\engine\Message;
use app\engine\Render;
use app\engine\Request;
use app\interfaces\IRenderer;
use app\models\repositories\CartRepository;
use app\models\repositories\UserRepository;


abstract class Controller
{
    private $action;
    protected string $defaultAction = 'index';
    private string $layout ='main';
    private bool $useLayout = true; //использовать ли шаблон по умолчанию.
    protected Request $globalParams;

    protected IRenderer $render;

    public function __construct(IRenderer $render)
    {
        $this->render = $render;
        $this->globalParams = new Request();
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
        $session_id = session_id();
        if($this->useLayout){

            return $this->renderTemplate('layouts/'.$this->layout, [
                'menu' => $this->renderTemplate('menu',
                    ['count' => App::call()->cartRepository->getSumColumn('quantity', $session_id),
                     'isAdmin' => App::call()->userRepository->is_admin()]),
                'content' => $this->renderTemplate($template, $params), //либо index, либо catalog, либо card
                'auth' => $this->renderTemplate('auth', [
                    'auth' => App::call()->userRepository->isAuth(),
                    'username'=> App::call()->userRepository->get_user(),
                    'message_auth' => App::call()->message->getMessageAuth()])
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params=[])
    {
        return $this->render->renderTemplate($template, $params);
    }

    /*protected function getGlobalParams(){
        return $this->globalParams->getParams();
    }*/

    /*protected function getGlobalSession(){
        return $this->globalParams->getSession();
    }*/
}