<?php

namespace application\controllers;

use application\core\Controller;

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
    $config = $GLOBALS['config'];
    $this->view->render('Изменение настроек движка', ['sitename' => htmlspecialchars_decode($config['sitename']), 'domain' => htmlspecialchars_decode($config['domain']), 'about' => htmlspecialchars_decode($config['about']), 'keywords' => htmlspecialchars_decode($config['keywords'])]);
  }

  public function emailAction() {
    $e_confirm = file_get_contents("./application/config/mails/email_confirm.html") or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_confirm.php'", "error");
    $e_recovery = file_get_contents("./application/config/mails/email_recovery.html") or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_recovery.php'", "error");
    $e_request = file_get_contents("./application/config/mails/email_request.html") or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_request.php'", "error");
    $e_banned = file_get_contents("./application/config/mails/email_banned.html") or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_banned.php'", "error");
    $this->view->render('Изменение почтовых рассылок', ["e_confirm" => $e_confirm, "e_recovery" => $e_recovery, "e_request" => $e_request, "e_banned" => $e_banned]);
  }

  public function aclAction()
  {
    if (!empty($_POST)) {
      if ($_POST['action'] == 'getActions') {
        $json = file_get_contents('application/config/schema.json');
        $jsonArray = json_decode($json, true);
        die(json_encode($jsonArray[$_POST['controller'] . "Controller"]));
      }
    }
    $this->view->render('Изменение контроля доступа');
  }

  public function controllerAction()
  {
    $scheme = file_get_contents("./application/config/schema.json") or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_banned.php'", "error");
    $controllers = array_diff(scandir('application/controllers'), array('..', '.'));
    $this->view->render('Контроллеры', ["scheme" => json_decode($scheme, true), "controllers" => $controllers]);
  }

/* Получаем весь массив, а потом создаём его заново.
Например, чтобы удалить, мы получаем весь массив из файла и запписываем в отдельную переменную. 
Потом, ищем по ключу и очищаем его.
Чтобы создать, то получаем массив, записываем в переменную и добавляем новый ключ + значение.
*/
}
