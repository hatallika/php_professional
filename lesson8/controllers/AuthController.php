<?php

namespace app\controllers;

use app\engine\App;
use app\engine\Session;
use app\models\repositories\UserRepository;
use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin(){

         //form action='/auth/login/'
         $login = App::call()->request->getParams()['login']; //POST['login']
         //$pass = $this->getGlobalParams()['pass']; // //POST['pass']
         $pass = App::call()->request->getParams()['pass']; // //POST['pass']
         if (App::call()->userRepository->auth($login,$pass)) {
             if (isset(App::call()->request->getParams()['save'])) {
                 App::call()->userRepository->updateHash();
             }
         } else {
             //$_SESSION['message']['login'] = 'Не верный логин и пароль';
             App::call()->session->set('message', ['login'=>'Не верный логин и пароль']);

         }
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
    }

     public function actionLogout()
     {
         setcookie("hash", '', time() - 3600, '/');
         App::call()->session->regenerate();
         App::call()->session->destroy();
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
     }

}