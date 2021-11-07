<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\entities\Cart;
use app\models\entities\Products;
use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;

class CartController extends Controller
{

    public function actionIndex()
    {
        //$this->layout = 'basket';
        $session_id = $this->getGlobalParams()['session_id'];
        $cart = (new CartRepository())->getCart($session_id);
        echo $this->render('cart',[
            'cart'=> $cart
        ]);
    }

    public function actionAdd()
    {

        //$product_id = $_POST['id'];
        $product_id = $this->getGlobalParams()['id']; // изменим в дальнейшем //подумать где хранить, как создать в едином экземпляре
        $session_id = $this->getGlobalParams()['session_id']; //id текущей сессии


        $fixed_price = (new ProductRepository())->getOne($product_id)->price;

        //проверим есть ли такой продукт уже в корзине
        $cartProduct = (new CartRepository())->getCartProduct($session_id, $product_id);


        if($cartProduct){

            $cartProduct->quantity = $cartProduct->quantity + 1;
            //$cartProduct->save();
            (new CartRepository())->save($cartProduct);
        } else {

           // (new Cart($product_id, $session_id, 1, $fixed_price))->save();
            $cartProduct = new Cart($product_id, $session_id, 1, $fixed_price);
            (new CartRepository())->save($cartProduct);

        }

        $response = [
            'status' => 'ok',
            //'count' => Cart::countCartItems($session_id) //не универсальная, так как считает еще количество товара
            'count' => (new CartRepository())->getSumColumn('quantity',$session_id)
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
        $cart = (new CartRepository())->getOne($cart_id);
        if($cart->session_id == $session_id) {
            (new CartRepository())->delete($cart); // есть deleteWhere($name, $value)
        } else {
            $status = "error";
        }


        $response = [
            'status' => $status,
            //'count' => $cart::countCartItems($session_id) //не универсальная, так как считает еще количество товара
            'count' => (new CartRepository())->getSumColumn('quantity',$session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionAddqnt(){
        $cart_id = $this->getGlobalParams()['id'];
        $session_id = $this->getGlobalParams()['session_id'];
        $itemCart = (new CartRepository())->getOne($cart_id);
        $itemCart->quantity = $itemCart->quantity + 1;
        //$itemCart->save();
        (new CartRepository())->save($itemCart);
        $response = [
            'status' => 'ok',
            //'count' => Cart::countCartItems($session_id),
            'count' => (new CartRepository())->getSumColumn('quantity',$session_id),
            'quantity' => $itemCart->quantity
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelqnt(){
        $cart_id = $this->getGlobalParams()['id'];
        $session_id = $this->getGlobalParams()['session_id'];
        $itemCart = (new CartRepository())->getOne($cart_id);
        if ($itemCart->quantity > 1){
            $itemCart->quantity = $itemCart->quantity - 1;
            (new CartRepository())->save($itemCart);
            $quantity = $itemCart->quantity;
        } else {
            (new CartRepository())->deleteWhere($itemCart, 'session_id', $session_id );
            //$itemCart->deleteWhere('session_id', $session_id);
            $quantity = null;
        }

        $response = [
            'status' => 'ok',
            'count' => (new CartRepository())->getSumColumn('quantity',$session_id),
            'quantity' => $quantity
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

}