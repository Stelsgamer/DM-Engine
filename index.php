<?php
require "application/lib/Dev.php";
$config = require "application/config/config.php";

use application\core\Router;

spl_autoload_register(function ($class){
  $path = str_replace("\\", "/", $class.".php");
  if (file_exists($path)) {
    include $path;
  }
});
session_start();

$router = new Router;
$router->run();