<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\Cart;
use app\models\Products;
class CartController extends Controller
{

    public function actionIndex()
    {
        //$this->layout = 'basket';
        $session_id = $this->getGlobalParams()['session_id'];
        $cart = Cart::getCart($session_id);
        echo $this->render('cart',[
            'cart'=> $cart
        ]);
    }

    public function actionAdd()
    {
        //$product_id = $_POST['id'];
        $product_id = $this->getGlobalParams()['id']; // изменим в дальнейшем //подумать где хранить, как создать в едином экземпляре
        $session_id = $this->getGlobalParams()['session_id']; //id текущей сессии

        $fixed_price = Products::getOne($product_id)->price;
        $cartProduct = Cart::getCartProduct($session_id, $product_id);


        if($cartProduct){
            $cartProduct->quantity = $cartProduct->quantity + 1;
            $cartProduct->save();
        } else {
            (new Cart($product_id, $session_id, 1, $fixed_price))->save();
        }

        $response = [
            'status' => 'ok',
            //'count' => Cart::countCartItems($session_id) //не универсальная, так как считает еще количество товара
            'count' => Cart::getSumColumn('quantity',$session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {
        //$cart_id = $_POST['id'];
        $status = 'ok';
        $cart_id = $this->getGlobalParams()['id'];
        $session_id = (new Session())->getId();
        $cart = Cart::getOne($cart_id);
        if($cart->session_id == $session_id) {
            $cart->delete(); // есть deleteWhere($name, $value)
        } else {
            $status = "error";
        }


        $response = [
            'status' => $status,
            //'count' => $cart::countCartItems($session_id) //не универсальная, так как считает еще количество товара
            'count' => Cart::getSumColumn('quantity',$session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionAddqnt(){
        $cart_id = $this->getGlobalParams()['id'];
        $session_id = $this->getGlobalParams()['session_id'];
        $itemCart = Cart::getOne($cart_id);
        $itemCart->quantity = $itemCart->quantity + 1;
        $itemCart->save();
        $response = [
            'status' => 'ok',
            //'count' => Cart::countCartItems($session_id),
            'count' => Cart::getSumColumn('quantity',$session_id),
            'quantity' => $itemCart->quantity
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelqnt(){
        $cart_id = $this->getGlobalParams()['id'];
        $session_id = $this->getGlobalParams()['session_id'];
        $itemCart = Cart::getOne($cart_id);
        if ($itemCart->quantity > 1){
            $itemCart->quantity = $itemCart->quantity - 1;
            $itemCart->save();
            $quantity = $itemCart->quantity;
        } else {
            $itemCart->deleteWhere('session_id', $session_id);
            $quantity = null;
        }

        $response = [
            'status' => 'ok',
            'count' => Cart::getSumColumn('quantity',$session_id),
            'quantity' => $quantity
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

}