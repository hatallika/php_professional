<?php

namespace app\controllers;

class CartController extends Controller
{


    public function actionIndex()
    {
        echo $this->render('cart');
    }



}