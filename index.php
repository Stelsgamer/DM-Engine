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
$router->run();<?php
ini_set('display_errors', '0');


if (!empty($_POST)) {
  // конфигурация mysql
  $row = $_POST;
  $data = [];

  foreach ($row as $k => $v) {
    $data[$k] = htmlspecialchars($v);
  }

  // Проверка прав доступа на каталоги

  if ($data['password'] !== $data['repassword']) {
    die(json_encode(["color" => "red", "message" => "Пароли для авторизации администратора должны совпадать!"]));
  }

  $config_data = "<?php return [";
  foreach ($data as $key => $val) {
    if ($key != "repassword" and $key != "password" && $key != "first-name" && $key != "language" && $key != "last-name") {
      $config_data .= '"' . $key . '" => "' . $val . '",';
    }
  }
  $config_data .= "'dev'=>0, ];";

  if (file_put_contents("application/config/config.php", $config_data)) { //Если смогли записать настройки в конфигурационный файл

    $conn = mysqli_connect($data['dbhost'], $data['dbuser'], $data['dbpass'], $data['dbname']);

    if (!$conn) {
      die(json_encode(["color" => "red", "message" => "Ошибка в подключении к БД. Проверьте корректность данных"]));
    }
    $tablename = $data['dbpref'] . "_" . "users";
    $sql = "CREATE TABLE `" . $data['dbpref'] . "_" . "users` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(60) NOT NULL,
            `password` VARCHAR(60) NOT NULL,
            `role_id` INT NOT NULL DEFAULT '1',
            `firstname` VARCHAR(30) NOT NULL DEFAULT '',
            `lastname` VARCHAR(30) NOT NULL DEFAULT '',
            `language` VARCHAR(2) NOT NULL DEFAULT 'ru',
            `avatar` VARCHAR(255) NOT NULL DEFAULT '/public/images/avatar/default.svg',
            `added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `edited` TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`));

            CREATE TABLE `" . $data['dbpref'] . "_" . "roles` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `prefix` VARCHAR(255) NOT NULL,
            `description` TEXT NULL,
            PRIMARY KEY (`id`));
          )";

    if (mysqli_multi_query($conn, $sql)) {
      while (mysqli_next_result($conn)) { // Очистка буфера
        mysqli_store_result($conn);
      }

      $sql = "INSERT INTO `" . $data['dbpref'] . "_" . "users` 
            (`email`, `password`, `firstname`, `lastname`, `role_id`, `language`)
            VALUES ('" . $data['admin_email'] . "', '" . password_hash($data['password'], PASSWORD_DEFAULT) . "', '" . $data['first-name'] . "', '" . $data['last-name'] . "', '3', '" . $data['language'] . "');
            
            INSERT INTO `" . $data['dbpref'] . "_" . "roles` 
            (`name`, `prefix`, `description`)
            VALUES ('user', 'U', 'User of this site'), ('moderator', 'M', 'Subadmin of this site'), ('admin', 'A', 'Administrator of this site');
            ";
      if (mysqli_multi_query($conn, $sql)) {
        $index =
          '<?php
require "application/lib/Dev.php";
$config = require "application/config/config.php";

use application\core\Router;

spl_autoload_register(function ($class){
  $path = str_replace("\\\", "/", $class.".php");
  if (file_exists($path)) {
    include $path;
  }
});
session_start();

$router = new Router;
$router->run();';
        file_put_contents("index.php", $index);
      } else {
        mysqli_close($conn);
        die(json_encode(["color" => "red", "message" => "Ошибка конфигурации записей в БД. Проверьте целостность данных скрипта!"]));

      }
    } else {
      mysqli_close($conn);
      die(json_encode(["color" => "red", "message" => "Ошибка создании таблиц БД. Возможно наложение таблиц! Отчистите БД или смените префикс и повторите попытку"]));
    }

    mysqli_close($conn);
    die(json_encode(["color" => "green", "message" => "Успешно! Всё готово для использования DM Engine.<br>Вы можете обновить страницу или перейти в <a class='text-blue' href='/admin'>панель управления</a>"]));

  } else {
    die(json_encode(["color" => "red", "message" => "Ошибка сохранения конфигурационного файла. Проверьте и установите chmod 760"]));

  }
}

?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/public/styles/main.css" rel="stylesheet">
  <link rel="shortcut icon" href="/public/images/logo.svg" type="image/x-icon">
  <title>Установка DM Engine</title>
  <link rel="prefetch prerender" href="/public/images/logo.svg" />
</head>

<body class="h-full bg-main text-text">
  <div class="flex min-h-full justify-center">
    <div class="w-full sm:w-3/4 md:w-1/2 p-4">
      <div class="mx-auto w-1/4">
        <img src="/public/images/logo.svg" alt="LOGO">
      </div>
      <div class="mt-6 mb-12 text-center">
        <h1 class="font-semibold text-5xl text-blue">DEEPMIND Engine</h1>
      </div>
      <form action="index.php" method="post">
        <div class="space-y-12">
          <h1 class="text-2xl font-semibold leading-7">Установка и конфигурация движка</h1>

          <div id="info"></div>

          <div class="border-b border-desc pb-12">
            <h2 class="text-xl font-semibold leading-7 ">Данные администратора / Admin contacts</h2>
            <div class="border-l-4 mt-3 border-green pt-2 pb-3 pl-3 rounded-r-sm shadow-md">
              <p class="mt-1 text-sm leading-6 ">Используйте корректные данные при заполнении формы, это потребуется для
                дальнейшего входа в админ панель</p>
            </div>
            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 ">Имя / First name:</label>
                <div class="mt-2">
                  <input type="text" name="first-name" id="first-name" pattern="^[A-Za-zА-Яа-яЁё]+$"
                    autocomplete="given-firstname" placeholder="Даниил"
                    class="input bg-input w-full border-text invalid:border-red">
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium leading-6 ">Фамилия / Last name:</label>
                <div class="mt-2">
                  <input type="text" name="last-name" id="last-name" pattern="^[A-Za-zА-Яа-яЁё]+$"
                    autocomplete="given-lastname" placeholder="Борисов"
                    class="input bg-input w-full border-text invalid:border-red">
                </div>
              </div>

              <div class="sm:col-span-4">
                <label for="admin_email"
                  class="block text-sm font-medium leading-6  after:content-['*'] after:text-red after:ml-1">Почта /
                  Email address:</label>
                <div class="mt-2">
                  <input id="admin_email" name="admin_email" type="email" autocomplete="admin_email"
                    placeholder="example@gmail.com" class="input bg-input w-full border-text invalid:border-red"
                    required>
                </div>
              </div>

              <div class="sm:col-span-4">
                <label for="password"
                  class="block text-sm font-medium leading-6  after:content-['*'] after:text-red after:ml-1">Пароль /
                  Password:</label>
                <div class="mt-2">
                  <input id="password" name="password" type="password" autocomplete="password" pattern="^[a-zA-Z0-9]+$"
                    minlength="6" placeholder="******" class="input bg-input w-full border-text invalid:border-red"
                    required>
                  <p class="mt-1 text-sm leading-6 font-thin text-desc">* Пароль должен состоять из 6-ти и более
                    символов</p>
                  <p class="text-sm leading-6 font-thin text-desc">* Пароль может содержать только латинские буквы и
                    цифры</p>
                </div>
                <label for="repassword"
                  class="block text-sm font-medium leading-6 mt-2  after:content-['*'] after:text-red after:ml-1">Повторите
                  пароль / Repassword:</label>
                <div class="mt-2">
                  <input id="repassword" name="repassword" type="password" autocomplete="repassword"
                    pattern="^[a-zA-Z0-9]+$" minlength="6" placeholder="******"
                    class="input bg-input w-full border-text invalid:border-red" required>
                </div>
              </div>

              <div class="sm:col-span-4">
                <label for="language" class="block text-sm font-medium leading-6 ">Язык / Language:</label>
                <div class="mt-2">
                  <select id="language" name="language" autocomplete="language"
                    class="input bg-input w-full border-text">
                    <option value="ru" selected>🇷🇺 Русский</option>
                    <option value="rb">🇧🇾 Белорусский</option>
                    <option value="en">🇺🇸 English</option>
                  </select>
                </div>
              </div>
            </div>
          </div>


          <div class="border-b border-desc pb-12">
            <h2 class="mt-10 text-base font-semibold leading-7 ">Данные о сайте / Site info:</h2>
            <div class="border-l-4 mt-3 border-green pt-2 pb-3 pl-3 rounded-r-sm shadow-md">
              <p class="mt-1 text-sm leading-6 ">Данная информация будет видна всем, в том числе и роботам поисковых
                гигантов, таких как </p><span class="text-sm italic text-des">google.com, yandex.ru, mail.ru</span>
            </div>
            <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="col-span-6 sm:col-span-4">
                <label for="sitename"
                  class="block text-sm font-medium leading-6  after:content-['*'] after:text-red after:ml-1">Название
                  сайта / Site name:</label>
                <div class="mt-2">
                  <div class="flex sm:max-w-md">
                    <input type="text" name="sitename" id="sitename" autocomplete="none"
                      class="input bg-input border-text invalid:border-red" placeholder="Your greate site name here"
                      required>
                  </div>
                </div>
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label for="domain"
                  class="block text-sm font-medium leading-6  after:content-['*'] after:text-red after:ml-1">Домен сайта
                  / Site domain:</label>
                <div class="mt-2">
                  <div class="flex sm:max-w-md">
                    <input type="text" name="domain" id="domain" autocomplete="none"
                      class="input order-last pl-0 border-l-0 border-text peer bg-input rounded-l-none invalid:border-red"
                      placeholder="example.com" required>
                    <span
                      class="flex  rounded-l-md select-none items-center border-y border-l peer-valid:peer-focus:border-indigo peer-invalid:border-red pl-3 bg-input sm:text-sm">https://</span>
                  </div>
                </div>
              </div>

              <div class="col-span-6">
                <label for="about" class="block text-sm font-medium leading-6 ">Описание / Description:</label>
                <div class="mt-2">
                  <textarea id="about" name="about" rows="4" class="input w-full border-text bg-input"></textarea>
                </div>
                <p class="mt-3 text-sm leading-6 font-thin text-desc">* Напишите о чём будет ваш сайт. Это будет
                  использовано в индексации роботами поисковых систем</p>
              </div>

              <div class="col-span-6">
                <label for="keywords" class="block text-sm font-medium leading-6 ">Теги / Keywords:</label>
                <div class="mt-2">
                  <textarea id="keywords" name="keywords" rows="2" class="input w-full border-text bg-input"></textarea>
                </div>
                <p class="mt-3 text-sm leading-6 font-thin text-desc">* Перечислите через запятую теги/ключевые слова, с
                  помощью которых ваш сайт будет индексироваться в поисковых сервисах</p>
              </div>
            </div>
          </div>

          <div class="border-b border-desc pb-12">
            <h2 class="text-xl font-semibold leading-7 ">Подключение БД / DB connection:</h2>
            <div class="border-l-4 mt-3 border-yellow pt-2 pb-3 pl-3 rounded-r-sm shadow-md">
              <p class="mt-1 text-sm leading-6 ">Внимание!!! Рекомендуется использовать пустую базу данных: без
                сторонних таблиц и триггеров.<br> В противном случае, при установке, ваши данные могут быть <span
                  class="text-white border-b border-white">повреждены</span> или <span
                  class="text-white border-b border-white">безвозвратно удалены</span></p>
            </div>
            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-5">
                <label for="dbhost"
                  class="block text-sm font-medium leading-6 mt-2  after:content-['*'] after:text-red after:ml-1">Хост /
                  Host:</label>
                <div class="mt-2">
                  <input type="text" name="dbhost" id="dbhost" autocomplete="given-name" placeholder="localhost"
                    class="input bg-input w-full border-text invalid:border-red" required>
                </div>

                <label for="dbuser"
                  class="block text-sm font-medium leading-6 mt-2  after:content-['*'] after:text-red after:ml-1">Пользователь
                  / Username:</label>
                <div class="mt-2">
                  <input id="dbuser" name="dbuser" type="text" autocomplete="dbuser" placeholder="admin123"
                    class="input bg-input w-full border-text invalid:border-red" required>
                </div>

                <label for="dbpass"
                  class="block text-sm font-medium leading-6 mt-2  after:content-['*'] after:text-red after:ml-1">Пароль
                  / Password:</label>
                <div class="mt-2">
                  <input id="dbpass" name="dbpass" type="password" autocomplete="dbpass" placeholder="******"
                    class="input bg-input w-full border-text invalid:border-red" required>
                </div>

                <label for="dbname"
                  class="block text-sm font-medium leading-6 mt-2  after:content-['*'] after:text-red after:ml-1">Имя
                  базы / DB name:</label>
                <div class="mt-2">
                  <input id="dbname" name="dbname" type="text" autocomplete="dbname" placeholder="database"
                    class="input bg-input w-full border-text invalid:border-red" required>
                </div>
              </div>
              <div class="sm:col-span-2 flex-nowrap">
                <label for="dbpref"
                  class="block text-sm font-medium leading-6 mt-2  after:content-['*'] after:text-red after:ml-1">Префикс
                  таблиц / Table prefix:</label>
                <div class="mt-2">
                  <input id="dbpref" name="dbpref" type="text" autocomplete="dbpref" placeholder="dme" value="dme"
                    class="input bg-input w-full border-text invalid:border-red" required>
                </div>
              </div>
            </div>
          </div>

          <div class="border-b border-desc pb-5">
            <h2 class="text-xl font-semibold leading-7 ">Почтовый сервис / Email service:</h2>
            <div class="border-l-4 mt-3 border-green pt-2 pb-3 pl-3 rounded-r-sm shadow-md">
              <p class="mt-1 text-sm self-center leading-6 ">Функции отправления электронного письма с сайта </p>
            </div>
            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-5">
                <fieldset>
                  <div class="">

                    <input id="noemail" class="peer/noemail bg-main" type="radio" name="email-method" checked />
                    <label for="noemail" class="ml-0.5">Нет</label>

                    <input id="phpmail" class="peer/phpmail bg-main ml-4" type="radio" name="email-method" />
                    <label for="phpmail" class="ml-0.5">PHP mail()</label>

                    <input id="smpt" class="peer/smpt bg-main ml-4" type="radio" name="email-method" />
                    <label for="smpt" class="ml-0.5">SMTP</label>

                    <div class="hidden peer-checked/noemail:block py-3">
                      <div class="border-l-4 mt-3 border-blue pt-2 pb-3 pl-3 rounded-r-sm shadow-md">
                        <p class="mt-1 text-sm self-center leading-6 ">Email отправления не будут обрабатываться и
                          вставать в очередь SMTP сервера</p>
                      </div>
                    </div>

                    <div class="hidden peer-checked/phpmail:block">
                      <div class="mt-3 text-sm leading-6">
                        <label for="send-email"
                          class="block text-sm font-medium leading-6 mt-2 after:content-['*'] after:text-red after:ml-1">Email
                          отправитель / Email sender:</label>
                        <div class="mt-2">
                          <input type="email" name="send-email" id="send-email" autocomplete="send-email"
                            placeholder="noreply@example.com"
                            class="input bg-input w-full border-text invalid:border-red">
                        </div>
                        <label for="reply-email"
                          class="block text-sm font-medium leading-6 mt-2 after:content-['*'] after:text-red after:ml-1">Email
                          ответчик / Email reply-to:</label>
                        <div class="mt-2">
                          <input id="reply-email" name="reply-email" type="email" autocomplete="reply-email"
                            placeholder="contact@example.com"
                            class="input bg-input w-full border-text invalid:border-red">
                        </div>
                      </div>
                      <div class="border-l-4 mt-3 border-yellow pt-2 pb-3 pl-3 rounded-r-sm shadow-md">
                        <p class="mt-1 text-sm self-center leading-6 ">Для корректной работы требуются правильно
                          настроенные mx записи домена</p>
                      </div>
                    </div>

                    <div class="hidden peer-checked/smpt:block">
                      <div class="mt-3 text-sm leading-6">
                        <label for="smtp-host"
                          class="block text-sm font-medium leading-6 mt-2 after:content-['*'] after:text-red after:ml-1">SMTP
                          хост / SMTP host:</label>
                        <div class="mt-2">
                          <input type="text" name="smtp-host" id="smtp-host" autocomplete="smtp-host"
                            placeholder="ssl://smtp.yandex.ru"
                            class="input bg-input w-full border-text invalid:border-red">
                        </div>

                        <label for="smtp-port"
                          class="block text-sm font-medium leading-6 mt-2 after:content-['*'] after:text-red after:ml-1">SMTP
                          порт / SMTP port:</label>
                        <div class="mt-2">
                          <input type="text" name="smtp-port" id="smtp-port" autocomplete="smtp-port" placeholder="465"
                            class="input bg-input w-full border-text invalid:border-red">
                        </div>

                        <label for="send-email"
                          class="block text-sm font-medium leading-6 mt-2 after:content-['*'] after:text-red after:ml-1">SMTP
                          логин / SMTP login:</label>
                        <div class="mt-2">
                          <input type="email" name="send-email" id="send-email" autocomplete="send-email"
                            placeholder="admin@example.com"
                            class="input bg-input w-full border-text invalid:border-red">
                        </div>

                        <label for="smtp-pass"
                          class="block text-sm font-medium leading-6 mt-2 after:content-['*'] after:text-red after:ml-1">SMTP
                          пароль / SMTP password:</label>
                        <div class="mt-2">
                          <input type="password" name="smtp-pass" id="smtp-pass" autocomplete="smtp-pass"
                            placeholder="******" class="input bg-input w-full border-text invalid:border-red">
                        </div>

                        <label for="reply-email"
                          class="block text-sm font-medium leading-6 mt-2 after:content-['*'] after:text-red after:ml-1">Email
                          ответчик / Email reply-to:</label>
                        <div class="mt-2">
                          <input id="reply-email" name="reply-email" type="email" autocomplete="reply-email"
                            placeholder="contact@example.com"
                            class="input bg-input w-full border-text invalid:border-red">
                        </div>
                      </div>

                      <div class="border-l-4 mt-3 border-yellow pt-2 pb-3 pl-3 rounded-r-sm shadow-md">
                        <p class="mt-1 text-sm self-center leading-6 ">Для корректной работы требуются правильно
                          настроенные mx записи домена</p>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <div class="pt-4 pb-12 flex items-center justify-center gap-x-6">
            <button type="button" id="clear"
              class="text-sm font-normal leading-6 border border-blue text-blue rounded-sm p-2 hover:bg-blue hover:text-main transition duration-200">Очистить
              поля</button>
            <button type="submit"
              class="text-sm font-normal leading-6 border bg-blue border-blue text-main rounded-sm p-2">Продолжить</button>
          </div>
      </form>
    </div>
  </div>
  <script src="/public/scripts/jquery.js"></script>
  <script src="/public/scripts/install.js"></script>
</body>

</html>