<?php

namespace app\controllers;

use app\engine\App;
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
        $session_id = App::call()->session->getId();
        $cart = App::call()->cartRepository->getCart($session_id);
        echo $this->render('cart',[
            'cart'=> $cart,
            'order_message' =>App::call()->message->getMessage('order')
        ]);
    }

    public function actionAdd()
    {

        //$product_id = $_POST['id'];
        $product_id = App::call()->request->getParams()['id']; // изменим в дальнейшем //подумать где хранить, как создать в едином экземпляре
        $session_id = App::call()->session->getId(); //id текущей сессии


        $fixed_price = App::call()->productRepository->getOne($product_id)->price;

        //проверим есть ли такой продукт уже в корзине
        $cartProduct = App::call()->cartRepository->getCartProduct($session_id, $product_id);


        if($cartProduct){

            $cartProduct->quantity = $cartProduct->quantity + 1;
            //$cartProduct->save();
            App::call()->cartRepository->save($cartProduct);
        } else {

           // (new Cart($product_id, $session_id, 1, $fixed_price))->save();
            $cartProduct = new Cart($product_id, $session_id, 1, $fixed_price);
            App::call()->cartRepository->save($cartProduct);

        }

        $response = [
            'status' => 'ok',
            //'count' => Cart::countCartItems($session_id) //не универсальная, так как считает еще количество товара
            'count' => App::call()->cartRepository->getSumColumn('quantity',$session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {
        //$cart_id = $_POST['id'];
        $status = 'ok';
        $cart_id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getId();
        $cart = App::call()->cartRepository->getOne($cart_id);
        if($cart->session_id == $session_id) {
            App::call()->cartRepository->delete($cart); // есть deleteWhere($name, $value)
        } else {
            $status = "error";
        }


        $response = [
            'status' => $status,
            //'count' => $cart::countCartItems($session_id) //не универсальная, так как считает еще количество товара
            'count' => App::call()->cartRepository->getSumColumn('quantity',$session_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionAddqnt(){
        $cart_id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getId();
        $itemCart = App::call()->cartRepository->getOne($cart_id);
        $itemCart->quantity = $itemCart->quantity + 1;
        //$itemCart->save();
        App::call()->cartRepository->save($itemCart);
        $response = [
            'status' => 'ok',
            //'count' => Cart::countCartItems($session_id),
            'count' => App::call()->cartRepository->getSumColumn('quantity',$session_id),
            'quantity' => $itemCart->quantity
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelqnt(){
        $cart_id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getId();
        $itemCart = App::call()->cartRepository->getOne($cart_id);
        if ($itemCart->quantity > 1){
            $itemCart->quantity = $itemCart->quantity - 1;
            App::call()->cartRepository->save($itemCart);
            $quantity = $itemCart->quantity;
        } else {
            App::call()->cartRepository->deleteWhere($itemCart, 'session_id', $session_id );
            //$itemCart->deleteWhere('session_id', $session_id);
            $quantity = null;
        }

        $response = [
            'status' => 'ok',
            'count' => App::call()->cartRepository->getSumColumn('quantity',$session_id),
            'quantity' => $quantity
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

}