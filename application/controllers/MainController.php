<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
  public function indexAction()
  {
    // Встраивание инфы из вне во view
    /*
    $vars = [
      'name' => 'Вася',
      'age' => 88,
    ];
    
  $db = new Db;



  $params = [
    'id' => 3,
  ];
    
  $data = $db->column('SELECT name FROM users WHERE id = :id', $params);
  debug($data);
    */

  $this->view->render('Главная страница');
  }

  public function privacyAction()
  {

    $this->view->render('Политика конфиденциальности');
  }

  public function rulesAction()
  {

    $this->view->render('Правила пользования сайта');
  }

}