<?php

namespace app\controllers;

use app\engine\App;

class adminController extends Controller
{
    public function actionIndex(){
        if(App::call()->userRepository->is_admin()){

            $orders = App::call()->orderRepository->getAll();
        } else {
            $message = "Вы не авторизованы, пожалуйста авторизуйтесь под Админом";
        }
        echo $this->render('admin',[
            'orders'=> $orders,
            'session' => $_SESSION
        ]);
    }

    public function actionChange(){
        $status = App::call()->request->getParams()['status'];
        $id = App::call()->request->getParams()['order_id'];
        if (App::call()->userRepository->is_admin()){
            $order = App::call()->orderRepository->getOne($id);
            $order->status = $status;
            App::call()->orderRepository->save($order);
            App::call()->message->setMessage('message_status' . $id, 'Статус заказа изменен');
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }

}