<?php

namespace app\controllers;

use app\engine\Session;
use app\models\repositories\UserRepository;
use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin(){

         //form action='/auth/login/'
         $login = $this->getGlobalParams()['login']; //POST['login']
         $pass = $this->getGlobalParams()['pass']; // //POST['pass']
         if ((new UserRepository())->auth($login,$pass)) {
             if (isset($this->getGlobalParams()['save'])) {
                 (new UserRepository())->updateHash();
             }
         } else {
             //$_SESSION['message']['login'] = 'Не верный логин и пароль';
             (new Session)->set('message', ['login'=>'Не верный логин и пароль']);

         }
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
    }

     public function actionLogout()
     {
         setcookie("hash", '', time() - 3600, '/');
         (new Session())->regenerate();
         (new Session())->destroy();
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
     }

}