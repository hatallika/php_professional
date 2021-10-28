<?php

namespace app\controllers;

abstract class Controller
{
    private $action;
    protected $defaultAction = 'index';
    private $layout ='main';
    private $useLayout = true; //использовать ли шаблон по умолчанию.

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
                'content' => $this->renderTemplate($template, $params) //либо index, либо catalog, либо card
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params=[])
    {//layout||catalog
        ob_start();
        extract($params);
        $templatePath = VIEWS_DIR . $template . ".php";
        include $templatePath;
        return  ob_get_clean();
    }
}