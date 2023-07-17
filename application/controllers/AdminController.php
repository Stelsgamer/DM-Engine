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
    if (!empty($_POST)) {
      $edit = array_merge($config, $_POST);

      $config_data = "<?php return [";
      foreach ($edit as $key => $val) {
        $config_data .= '"' . $key . '" => "' . $val . '",';
      }
      $config_data .= "];";
      if (file_put_contents("application/config/config.php", $config_data)) {
        $this->view->alert("Успешно! Данные были обновлены и сохранены", "success");
      } else {
        $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/config.php'", "error");
      }
    }
    $this->view->render('Изменение настроек движка', ['sitename' => $config['sitename'], 'domain' => $config['domain'], 'about' => $config['about'], 'keywords' => $config['keywords']]);
  }

  public function emailAction() {
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
    }

    $e_confirm = file_get_contents($c_path) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_confirm.php'", "error");
    $e_recovery = file_get_contents($rec_path) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_recovery.php'", "error");
    $e_request = file_get_contents($req_path) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_request.php'", "error");
    $e_banned = file_get_contents($b_path) or $this->view->alert("Ошибка: произошла ошибка при обновлении конфигурации. Проверьте права доступа < br > на чтение / запись файлов конфигурации 'application/config/mails/email_banned.php'", "error");
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
