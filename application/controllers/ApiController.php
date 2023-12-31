<?php

namespace application\controllers;

use application\core\Controller;

class apiController extends Controller
{

  public function __construct($route)
  {
    parent::__construct($route);
    $this->view->layout = 'admin';
  }

  public function indexAction()
  {
    $this->view->render('API deepmind ENGINE');
  }

  public function settingsAction()
  {
    $config = $GLOBALS['config'];
    if (!empty($_POST)) {
      $edit = array_merge($config, $_POST);

      $config_data = "<?php return [";
      foreach ($edit as $key => $val) {
        $config_data .= '"' . $key . '" => "' . htmlspecialchars($val, ENT_QUOTES) . '",';
      }
      $config_data .= "];";
      if (file_put_contents("application/config/config.php", $config_data)) {
        $this->view->alert("Успешно! Данные были обновлены и сохранены", "success");
      } else {
        $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/config.php'", "error");
      }
    } else {
      $this->view->errorCode(403);
    }
  }

  public function emailAction()
  {
    $c_path = "./application/config/mails/email_confirm.html";
    $rec_path = "./application/config/mails/email_recovery.html";
    $req_path = "./application/config/mails/email_request.html";
    $b_path = "./application/config/mails/email_banned.html";
    if (!empty($_POST)) {
      file_put_contents($c_path, $_POST['email_confirm']) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_confirm.php'", "error");
      file_put_contents($rec_path, $_POST['email_recovery']) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_recovery.php'", "error");
      file_put_contents($req_path, $_POST['email_request']) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_request.php'", "error");
      file_put_contents($b_path, $_POST['email_banned']) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_banned.php'", "error");
      $this->view->alert("Успешно! Данные были обновлены и сохранены", "success");
    } else {
      $this->view->errorCode(403);
    }
  }

  public function aclAction()
  {
    if (!empty($_POST)) {
      if ($_POST['action'] == 'getActions') {
        $json = file_get_contents('application/config/schema.json');
        $jsonArray = json_decode($json, true);
        die(json_encode($jsonArray[$_POST['controller'] . "Controller"]));
      }
      if ($_POST['action'] == 'getControllers') {
        $json = file_get_contents('application/config/schema.json');
        $jsonArray = json_decode($json, true);
        die(json_encode(array_keys($jsonArray)));
      }
    } else {
      $this->view->errorCode(403);
    }
  }

  public function controllerAction()
  {
    if (!empty($_POST)) {
      if ($_POST['action'] == 'getControllers') {
        $json = file_get_contents('application/config/schema.json');
        $jsonArray = json_decode($json, true);
        die(json_encode($jsonArray));
      } elseif ($_POST['action'] == 'getOneController') {
        $json = file_get_contents('application/config/schema.json');
        $jsonArray = json_decode($json, true);
        die(json_encode($jsonArray[$_POST['name']]));
      }
    } else {
      $this->view->errorCode(403);
    }
  }

  /* Получаем весь массив, а потом создаём его заново.
  Например, чтобы удалить, мы получаем весь массив из файла и запписываем в отдельную переменную. 
  Потом, ищем по ключу и очищаем его.
  Чтобы создать, то получаем массив, записываем в переменную и добавляем новый ключ + значение.
  */
}