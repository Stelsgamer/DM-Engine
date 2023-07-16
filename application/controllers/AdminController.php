<?php

namespace application\controllers;
use application\core\Controller;
$config = require 'application/config/config.php';

class AdminController extends Controller
{

  public function __construct($route)
  {
    parent::__construct($route);
    $this->view->layout = 'admin';
  }

  public function indexAction() {
    $this->view->render('Панель администрирования');
  }

  public function settingsAction() {
    $this->view->render('Изменение настроек движка');
  }

  public function emailAction() {
    if (!empty($_POST)) {
      $this->view->alert("Сообщение:", "сохранено");
    }

    $e_confirm = file_get_contents("./application/config/mails/email_confirm.html") or "Не удалось получить данные";
    $e_recovery = file_get_contents("./application/config/mails/email_recovery.html") or "Не удалось получить данные";
    $e_request = file_get_contents("./application/config/mails/email_request.html") or "Не удалось получить данные";
    $e_banned = file_get_contents("./application/config/mails/email_banned.html") or "Не удалось получить данные";
    $this->view->render('Изменение почтовых рассылок', ["e_confirm" => $e_confirm, "e_recovery" => $e_recovery, "e_request" => $e_request, "e_banned" => $e_banned]);

  }
  public function aclAction()
  {
    $this->view->render('Изменение почтовых рассылок');
  }

/* Получаем весь массив, а потом создаём его заново.
Например, чтобы удалить, мы получаем весь массив из файла и запписываем в отдельную переменную. 
Потом, ищем по ключу и очищаем его.
Чтобы создать, то получаем массив, записываем в переменную и добавляем новый ключ + значение.
*/
}
