<?php

namespace app\controllers;

use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin(){

         //form action='/auth/login/'
         $login = $_POST['login'];
         $pass = $_POST['pass'];
         if (Users::auth($login,$pass)) {
             if (isset($_POST['save'])) {
                 Users::updateHash();
             }
         } else {
             $_SESSION['message']['login'] = 'Не верный логин и пароль';
         }
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
    }

     public function actionLogout()
     {
         setcookie("hash", '', time() - 3600, '/');
         session_regenerate_id();
         session_destroy();
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
     }




}