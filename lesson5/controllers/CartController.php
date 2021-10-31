<?php

namespace app\controllers;

class CartController extends Controller
{

    public function actionIndex()
    {
        //$this->layout = 'basket';
        $cart = [];
        echo $this->render('cart',[
            'cart'=> $cart
        ]);
    }
}