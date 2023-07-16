<?php

namespace application\controllers;
use application\core\Controller;
$config = require 'application/config/config.php';

class AccountController extends Controller
{

  public function indexAction() {
    $this->view->render('Профиль');
  }

  public function loginAction() {
    if (!empty($_POST)){

      if (!$this->model->emailValidate($_POST)) {
        $this->view->alert("error", $this->model->error);
      } elseif(!$this->model->passwordValidate($_POST)) {
        $this->view->alert("error", $this->model->error);
      }

      $user = json_decode($this->model->auth($_POST), true);

      if(isset($user['statuse']) and $user['statuse'] == 'OK'){
        $_SESSION['user'] = $user['user'];
        if (isset($_SESSION['last_page'])) {
          $this->view->location($_SESSION['last_page']);
        }
        $this->view->location('/');
      }else{
        $this->view->alert("error", $user['error']);
      }
    }

    $this->view->render('Вход в систему');
  }

  public function registrationAction() {
    if (!empty($_POST)){
      if (!$this->model->emailValidate($_POST)) {
        $this->view->alert("error", $this->model->error);
      } elseif(!$this->model->passwordValidate($_POST, 'register')) {
        $this->view->alert("error", $this->model->error);
      } elseif(!isset($_POST['politic'])){
        $this->view->alert("Ошибка", "Для продолжения, выдолжны принять все соглашения");
      }
      

      $new_user = json_decode($this->model->register($_POST), true);


      if(isset($new_user['statuse']) and $new_user['statuse'] == 'OK'){
        $user = json_decode($this->model->auth($_POST), true);

        if(isset($user['statuse']) and $user['statuse'] == 'OK'){
          $_SESSION['user'] = $user['user'];
          $_SESSION['confirm_token'] = $this->model->setCode();


          $message = '
            <p>Для подтверждения регистрации в системе - нажмите на ссылку ниже</p>
            <a href="https://'.$_SERVER['SERVER_NAME'].'/confirm/' . md5($_SESSION['confirm_token']) . '">Подтвердить регистрацию</a>
            <p> Или введите код - ' . $_SESSION['confirm_token'] .'</p>
          ';
          $this->model->send_mail($_SESSION['user']['email'], "Подтверждение регистрации на ".$_SERVER['SERVER_NAME'], $message);
          $this->view->location('/confirm');
        }else{
          $this->view->location('/login');
        }
      }else{
        $this->view->alert("error", $new_user['error']);
      }
    }
    $this->view->render('Регистрация в системе');
  }

  public function confirmAction() 
  {
    if(!empty($_POST)){
      if(isset($_POST['confirm_token']) && isset($_SESSION['confirm_token'])){
        if($_POST['confirm_token'] == $_SESSION['confirm_token']){
          unset($_SESSION['confirm_token']);

          $this->model->edit(["id" => $_SESSION['user']['id'], "confirmed" => "1"]);
          $_SESSION['user']['confirmed'] = 1;
          if (isset($_SESSION['last_page'])) {
            $this->view->location($_SESSION['last_page']);
          }
        }else{
          $this->view->alert("error", "Неверный код");
        }
      }else {
        $this->view->alert("error", "Заполните поле confirm");
      }
    }

    if(isset($this->route['token'])){
      if($this->route['token'] == md5($_SESSION['confirm_token'])){
        unset($_SESSION['confirm_token']);
        $this->model->edit(["id" => $_SESSION['user']['id'], "confirmed" => "1"]);
        $_SESSION['user']['confirmed'] = 1;
        $this->view->redirect('/');
      }

    }elseif(isset($_SESSION['user']) && !isset($_SESSION['confirm_token'])){
      $_SESSION['confirm_token'] = $this->model->setCode();
      
      $message = '
            <p>Для подтверждения регистрации в системе - нажмите на ссылку ниже</p>
            <a href="https://'.$_SERVER['SERVER_NAME'].'/confirm/' . md5($_SESSION['confirm_token']) . '">Подтвердить регистрацию</a>
            <p> Или введите код - ' . $_SESSION['confirm_token'] . '</p>
          ';
      $this->model->send_mail($_SESSION['user']['email'], "Подтверждение регистрации на ".$_SERVER['SERVER_NAME'], $message);

    }
    if($_SESSION['user']['confirmed'] == 1){
      $this->view->redirect('/');
    }
    $this->view->render('Подтверждение регистрации');
  }

  public function logoutAction() 
  {
    session_unset();
    $this->view->redirect('/');
  }
}
