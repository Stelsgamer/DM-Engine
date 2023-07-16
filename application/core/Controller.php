<?php


namespace application\core;

use application\core\View;



abstract class Controller {

  public $route;
  public $view;
  public $model;
  public $acl;
  public $config;


  public function __construct($route)
  {
    $this->route = $route;
    if (!$this->checkAcl()){
      if(isset($_SESSION['authorize']['id'])){
        View::errorCode(403);
      }
      $_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
      View::redirect('/login/');// -- редирект на страницу авторизации
    }

    $this->config = $config = $GLOBALS['config'];// -- подключаем конфиг сайта

    if ($config['dev']==1){// -- если включён режим разработки, то обычные пользователи и гости сайта не смогут зайти на него, а увидят страницу DEV
      if(isset($_SESSION['authorize']['id'])){
        if($_SESSION['authorize']['role'] == "user"){// -- если пользователь, то редирект на заглушку 
          View::errorCode(500);
        }
      }else{
        View::errorCode(500);
      }
    }  
    $this->view = new View($route, $config);
    $this->model = $this->loadModel($route['controller']);
  }


  public function loadModel($name) {
    $path = 'application\models\\'.ucfirst($name);
    if(class_exists($path)){
      return new $path;
    }
  }


  public function checkAcl() {
    $path = 'application/acl/'.$this->route['controller'].'.acl.php';
    if(file_exists($path)){
      $this->acl = require $path;
      if ($this->isAcl('all')){
        return true;
      }
      elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')){
        if($this->route['action']!='confirm' && $this->route['action'] != 'logout'){
          if (($_SESSION['user']['confirmed'] == 0)) {
            $_SESSION['last_page'] = $_SERVER['REQUEST_URI']; // -- устанавливаем сессию с прошлой урл с которой нас забрал скрип для авторизации
            return View::redirect('/confirm/'); // -- редирект на страницу потверждения регистрации
          }
        }

        return true;
      }
      elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')){
        return true;
      }
      elseif (isset($_SESSION['admin']) and $this->isAcl('admin')){
        return true;
      }
      return false;
    } else {
      echo "Отсутствует файл контроля доступа: /".$path;
    }
  }

  
  public function isAcl($key) {
    return in_array($this->route['action'], $this->acl[$key]);
  }
}