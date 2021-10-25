<?php

namespace app\controllers;

class CartController extends Controller
{
    private $action;
    protected $defaultAction = 'cart';
    private $layout ='main';
    private $useLayout = true; //использовать ли шаблон по умолчанию.


    public function actionCart()
    {
        echo $this->render('cart');
    }



}