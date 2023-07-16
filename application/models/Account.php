<?php

namespace application\models;

use application\core\Model;



class Account extends Model
{

  public $error;

  public function emailValidate($post)
  {
    if(empty($post['email'])){
      $this->error = 'Заполните поле email';
      return false;
    } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
      $this->error = 'Неверный формат email';
      return false;
    }
    
    return true;
  }

  public function passwordValidate($post, $action='login')
  {
    if (empty($post['password'])) {
      $this->error = 'Заполните поле password';
      return false;
    }

    if($action == 'register'){
      if (empty($post['repassword'])) {
        $this->error = 'Заполните поле repeat password';
        return false;

      } elseif ($post['password'] !== $post['repassword']) {
        $this->error = 'Пароли не совпадают';
        return false;

      } elseif (strlen($post['password']) < 6) {
        $this->error = "Пароль должен быть не менее 6 символов";
        return false;
      }
    }
    if (!preg_match("/^[ЁА-яA-z0-9]+$/", $post['password'])) {
      $this->error = "Пароль должен состоять только из цифр и букв латинского алфавита";
      return false;
    }
    return true;
  }


  public function setCode(){
    //$permitted_chars = '123456789ABCDEFGHIK';
    $permitted_chars = '0123456789';
    return substr(str_shuffle($permitted_chars), 0, 6);
  }

  public function send_mail($to, $subject, $message)
  {
    $to = "<$to>, ";
    $headers = "Content-type: text/html; charset=UTF-8 \r\n";
    $headers .= "From: QRCS | DEEPMIND.studio <noreply@".$_SERVER['SERVER_NAME'].">\r\n";
    $headers .= "Reply-To: admin@".$_SERVER['SERVER_NAME']."\r\n";

    mail($to, $subject, $message, $headers);
    // Для отправки HTML-письма должен быть установлен заголовок Content-type
  }

  

}