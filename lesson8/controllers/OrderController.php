<?php

namespace app\controllers;

use app\engine\App;
use app\engine\Message;
use app\models\entities\Orders;

class OrderController extends Controller
{
    //Все заказы авторизованных пользователей
    public function actionIndex()
    {
        if(App::call()->userRepository->get_user()){
            $login = App::call()->userRepository->get_user();
            $user_id = App::call()->userRepository->getOneWhere('login', $login)->id;
            $orders = App::call()->orderRepository->getAllWhere('user_id', $user_id);
            } else {
            $message = "Вы не авторизованы, пожалуйста авторизуйтесь";
            }
        echo $this->render('orders',[
            'orders'=> $orders,
            'message' => $message
            ]);

    }

    public function actionAdd(){
        $name = App::call()->request->getParams()['order_name'];
        $phone = App::call()->request->getParams()['phone'];
        $session = App::call()->session->getId();
        if(App::call()->userRepository->get_user()){
            $login = App::call()->userRepository->get_user();

            $user_id = App::call()->userRepository->getOneWhere('login', $login)->id;
        } else {
            $user_id = null;
        }
        $order = new Orders($session, $name, $phone, $user_id, 'waiting');
        App::call()->orderRepository->save($order);
        $number = App::call()->orderRepository->getLastInsertId();
        session_regenerate_id();
        App::call()->message->setMessage('order', 'Заказ ' . $number . ' отправлен.');
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }

    public function actionOne(){
        $id = App::call()->request->getParams()['id'];

        if(App::call()->userRepository->get_user()){
            $login = App::call()->userRepository->get_user();
            $user_id = App::call()->userRepository->getOneWhere('login', $login)->id;
            $order = App::call()->orderRepository->getOneOrder($id, $user_id);
        } else {
            $message = "Вы не авторизованы, пожалуйста авторизуйтесь";
        }
        //отрисовка
        echo $this->render('order',[
            'order'=> $order,
            'order_message'=>App::call()->message->getMessage('order_message')
        ]);
    }

    public function actionChange(){
        $name = App::call()->request->getParams()['order_name'];
        $phone = App::call()->request->getParams()['phone'];
        $id = App::call()->request->getParams()['order_id'];

        $login = App::call()->userRepository->get_user();
        $user_id = App::call()->userRepository->getOneWhere('login', $login)->id;

        $order = App::call()->orderRepository->getOne($id);

        if($order){
            $order->name = $name;
            $order->phone = $phone;
        }

        //разрешить изменять только свои заказы проверить по user_id
        if($user_id == $order->user_id){
            App::call()->orderRepository->save($order);
            App::call()->message->setMessage('order_message', 'Контактные данные изменены');
        } else {
            App::call()->message->setMessage('order_message', 'Нет такого заказа');
        }


        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }


}