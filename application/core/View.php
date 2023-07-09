<?php

namespace application\core;

class View
{

  public $path;
  public $route;
  public $layout = 'default';

  public $config;
  
  
  public function __construct($route, $config) {
    $this->config = $config;
    $this->route = $route;
    $this->path = $route['controller'].'/'.$route['action'];
  }

  public function render($title, $vars = []) {
    extract($vars);
    $path = 'application/views/'.$this->path.'.php';
    if(file_exists($path)){
      ob_start();
      require $path;
      $content = ob_get_clean();
      require 'application/views/layouts/'.$this->layout.'.php';
    } else {
      echo 'views не найден:'. $this->path;
    }
  }

  public static function redirect($url) {
    header('location: '.$url);
    exit;
  }

  public static function errorCode($code) {
    http_response_code($code);
    $path = 'application/views/errors/'.$code.'.php';
    if(file_exists($path)){
      require $path;
      exit;
    } else {
      echo 'Ошибка '. $code;
      exit;
    }
  }

  public function message($type, $text,  $delay = 3) {
    exit(json_encode(['type'=> $type, 'text' => $text, 'delay' => $delay]));
  }

  public function error($text, $field, $delay = 3)
  {
    exit(json_encode(['error'=>true, 'text' => $text, 'field' => $field, 'delay' => $delay]));
  }

  public function alert($type='message', $text)
  {
    exit(json_encode([$type, 'text' => $text]));
  }

  public function location($url) {
    exit(json_encode(['url'=> $url]));
  }

  public function reload()
  {
    exit(json_encode(['reload' => true]));
  }


}