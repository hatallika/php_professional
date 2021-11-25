<?php

namespace app\engine;

use app\models\entities\Feedback;
use app\models\repositories\CartRepository;
use app\models\repositories\FeedbackRepository;
use app\models\repositories\ImageRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingleton;
use ReflectionClass;


/**
 * Class App
 * @property Request $request
 * @property CartRepository $cartRepository
 * @property UserRepository $userRepository
 * @property ProductRepository $productRepository
 * @property FeedbackRepository $feedbackRepository
 * @property ImageRepository $imageRepository
 * @property OrderRepository $orderRepository
 * @property Session $session
 * @property Db $db *
 * @property Message $message
 * @property TwigRender $twigRender
 */
class App
{
    use TSingleton;

    public $config;
    private $components;

    private $controller;
    private $action;

    //сократим вызов экземпляра приложения

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function runController(){

        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controller_namespace'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            //$controller = new $controllerClass(new Render());
            $controller = new $controllerClass(App::call()->twigRender);
            $controller->runAction($this->action);

        } else {
            die("404");
        }


    }

    public function run($config){
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    public function createComponent($name){
        if(isset($this->config['components'][$name])){
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if(class_exists($class)){
                unset($params['class']);
                $reflection = new ReflectionClass($class);

                return $reflection->newInstanceArgs($params);
            }
        }
        die("Компонента {$name} не существует в конфигурации системы");
        //Можно Exception
    }

    public function __get($name) {
        return $this->components->get($name);
    }

}