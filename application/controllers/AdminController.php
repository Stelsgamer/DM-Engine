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
    $c_path = "./application/config/mails/email_confirm.html";
    $rec_path = "./application/config/mails/email_recovery.html";
    $req_path = "./application/config/mails/email_request.html";
    $b_path = "./application/config/mails/email_banned.html";
    if (!empty($_POST)) {

      file_put_contents($c_path, $_POST['email_confirm']) or $this->view->alert("Сообщение:", "Не удалось сохранить настройки подтверждения");
      file_put_contents($rec_path, $_POST['email_recovery']) or $this->view->alert("Сообщение:", "Не удалось сохранить настройки восстановления");
      file_put_contents($req_path, $_POST['email_request']) or $this->view->alert("Сообщение:", "Не удалось сохранить настройки ответа");
      file_put_contents($b_path, $_POST['email_banned']) or $this->view->alert("Сообщение:", "Не удалось сохранить настройки бана");
      $this->view->alert("Сообщение:", "Сохранено");
    }

    $e_confirm = file_get_contents($c_path) or "Не удалось получить данные";
    $e_recovery = file_get_contents($rec_path) or "Не удалось получить данные";
    $e_request = file_get_contents($req_path) or "Не удалось получить данные";
    $e_banned = file_get_contents($b_path) or "Не удалось получить данные";
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
