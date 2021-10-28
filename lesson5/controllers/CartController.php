<?php

namespace app\controllers;

class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = [];
        echo $this->render('cart',[
            'cart'=> $cart
        ]);
    }
}