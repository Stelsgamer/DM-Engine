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

/* Получаем весь массив, а потом создаём его заново.
Например, чтобы удалить, мы получаем весь массив из файла и запписываем в отдельную переменную. 
Потом, ищем по ключу и очищаем его.
Чтобы создать, то получаем массив, записываем в переменную и добавляем новый ключ + значение.
*/
}
