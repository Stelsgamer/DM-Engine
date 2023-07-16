<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title?></title>
  <link rel="stylesheet" href="/public/styles/output.css">
  <link rel="shortcut icon" href="/public/images/logo.svg" type="image/x-icon">
</head>
<body class="min-h-screen w-full bg-main text-text md:flex">

<!-- start sidebar -->

  <section class="px-5 py-3 w-full md:max-w-[280px] fixed bg-gray-800 md:min-h-screen md:shadow-lg md:shadow-gray-700 text-sm font-semibold">
    <nav class="flex py-3 justify-between items-center"><a href="/admin/" class="w-full md:justify-normal"><div class="flex py-2 justify-center rounded-md w-full items-center text-blue hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-lg hover:shadow-gray-900 transition"><img src="/public/images/logo.svg" class="w-12" alt="Deepmind logo"><span class="pl-3 font-semibold text-3xl">DME l Panel</span></div></a>
      <button id="openSidebar" class="p-3 md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="" width="34" height="34" viewBox="0 0 24 24" fill="currentColor">
        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
        </svg>
      </button>
    </nav>
      <div class="sidebar hidden md:block space-y-4 mt-6">
        <nav class="flex">
          <a class="flex items-center" href="#profile">
            Главная
          </a>
        </nav>
        <nav class="flex justify-between">
          <a class="nav-link flex items-center <?php if ($this->route['action'] == 'index')echo 'active' ?>" href="/admin/">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
              </path>
            </svg>
            Главная
          </a>
        </nav>
        <nav class="flex justify-between">
          <a class="nav-link flex items-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M3 5v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2zm16.001 14H5V5h14l.001 14z">
              </path>
              <path d="M11 7h2v10h-2zm4 3h2v7h-2zm-8 2h2v5H7z"></path>
            </svg>
            Статистика
          </a>
        </nav> 
        <nav class="flex justify-between">
          <a class="nav-link flex items-center <?php if ($this->route['action'] == 'email')echo 'active' ?>" href="/admin/email/">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z">
              </path>
            </svg>
            Почта
          </a>
          <div class="navlink-add">
            8 / 22
          </div>
        </nav>  
        <nav class="flex justify-between">
          <a class="nav-link flex items-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M5.122 21c.378.378.88.586 1.414.586S7.572 21.378 7.95 21l4.336-4.336a7.495 7.495 0 0 0 2.217.333 7.446 7.446 0 0 0 5.302-2.195 7.484 7.484 0 0 0 1.632-8.158l-.57-1.388-4.244 4.243-2.121-2.122 4.243-4.243-1.389-.571A7.478 7.478 0 0 0 14.499 2c-2.003 0-3.886.78-5.301 2.196a7.479 7.479 0 0 0-1.862 7.518L3 16.05a2.001 2.001 0 0 0 0 2.828L5.122 21zm4.548-8.791-.254-.616a5.486 5.486 0 0 1 1.196-5.983 5.46 5.46 0 0 1 4.413-1.585l-3.353 3.353 4.949 4.95 3.355-3.355a5.49 5.49 0 0 1-1.587 4.416c-1.55 1.55-3.964 2.027-5.984 1.196l-.615-.255-5.254 5.256h.001l-.001 1v-1l-2.122-2.122 5.256-5.255z">
              </path>
            </svg>
            Контроллеры
          </a>
          <div class="navlink-add">
            12
          </div>
        </nav>
        <nav class="flex justify-between">
          <a class="nav-link flex items-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M21 15a9.11 9.11 0 0 0-.18-1.81 8.53 8.53 0 0 0-.53-1.69 8.08 8.08 0 0 0-.83-1.5 8.73 8.73 0 0 0-1.1-1.33A8.27 8.27 0 0 0 17 7.54a8.08 8.08 0 0 0-1.53-.83L15 6.52V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1.52l-.5.19a8.08 8.08 0 0 0-1.5.83 8.27 8.27 0 0 0-1.33 1.1A8.27 8.27 0 0 0 4.54 10a8.08 8.08 0 0 0-.83 1.53 9 9 0 0 0-.53 1.69A9.11 9.11 0 0 0 3 15v3H2v2h20v-2h-1zM5 15a7.33 7.33 0 0 1 .14-1.41 6.64 6.64 0 0 1 .41-1.31 7.15 7.15 0 0 1 .64-1.19 7.15 7.15 0 0 1 1.9-1.9A7.33 7.33 0 0 1 9 8.68V15h2V6h2v9h2V8.68a8.13 8.13 0 0 1 .91.51 7.09 7.09 0 0 1 1 .86 6.44 6.44 0 0 1 .85 1 6 6 0 0 1 .65 1.19 7.13 7.13 0 0 1 .41 1.31A7.33 7.33 0 0 1 19 15v3H5z">
              </path>
            </svg>
            Экшены
          </a>
          <div class="navlink-add">
            43
          </div>
        </nav>
        <nav class="flex justify-between">
          <a class="nav-link flex items-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M17.5 4C15.57 4 14 5.57 14 7.5c0 1.554 1.025 2.859 2.43 3.315-.146.932-.547 1.7-1.23 2.323-1.946 1.773-5.527 1.935-7.2 1.907V8.837c1.44-.434 2.5-1.757 2.5-3.337C10.5 3.57 8.93 2 7 2S3.5 3.57 3.5 5.5c0 1.58 1.06 2.903 2.5 3.337v6.326c-1.44.434-2.5 1.757-2.5 3.337C3.5 20.43 5.07 22 7 22s3.5-1.57 3.5-3.5c0-.551-.14-1.065-.367-1.529 2.06-.186 4.657-.757 6.409-2.35 1.097-.997 1.731-2.264 1.904-3.768C19.915 10.438 21 9.1 21 7.5 21 5.57 19.43 4 17.5 4zm-12 1.5C5.5 4.673 6.173 4 7 4s1.5.673 1.5 1.5S7.827 7 7 7s-1.5-.673-1.5-1.5zM7 20c-.827 0-1.5-.673-1.5-1.5a1.5 1.5 0 0 1 1.482-1.498l.13.01A1.495 1.495 0 0 1 7 20zM17.5 9c-.827 0-1.5-.673-1.5-1.5S16.673 6 17.5 6s1.5.673 1.5 1.5S18.327 9 17.5 9z">
              </path>
            </svg>
            Роутер
          </a>
        </nav>
        <nav class="flex justify-between">
          <a class="nav-link flex items-center <?php if ($this->route['action'] == 'acl')
            echo 'active' ?>" href="/admin/acl/">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897V12H5.51a15.473 15.473 0 0 1-.544-4.365L12 4.118V12h6.46c-.759 2.74-2.498 5.979-6.46 7.897z"></path></svg>
            Контроль доступа
          </a>
        </nav>
        <nav class="flex justify-between">
          <a class="nav-link flex items-center <?php if ($this->route['action'] == 'settings')echo 'active' ?>" href="/admin/settings/">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z">
              </path>
              <path
                d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z">
              </path>
            </svg>
            Настройки
          </a>
        </nav>
        <nav class="flex justify-between pb-12">
          <a class="nav-link flex items-center text-red" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M10.385 21.788a.997.997 0 0 0 .857.182l8-2A.999.999 0 0 0 20 19V5a1 1 0 0 0-.758-.97l-8-2A1.003 1.003 0 0 0 10 3v1H6a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h4v1c0 .308.142.599.385.788zM12 4.281l6 1.5v12.438l-6 1.5V4.281zM7 18V6h3v12H7z">
              </path>
              <path d="M14.242 13.159c.446-.112.758-.512.758-.971v-.377a1 1 0 1 0-2 .001v.377a1 1 0 0 0 1.242.97z"></path>
            </svg>
            Выйти
          </a>
        </nav>
      </div>
      <div class="flex justify-center px-8 border-t border-gray-700">
        <ul class="w-52 md:w-full flex items-center justify-between bg-gray-800">
          <li class="group cursor-pointer text-white mt-5">
            <button class="before:content-[''] before:absolute before:w-2 before:h-2 before:bg-blue before:rounded-full before:animate-ping">
              <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:stroke-blue" width="20" height="20"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"></path>
                <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
              </svg>
            </button>
          </li>
          <li class="group cursor-pointer text-white mt-5">
            <button>
            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-blue" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z">
              </path>
            </svg>
            </button>
          </li>
          <li class="group cursor-pointer text-white mt-5">
            <button>
              <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:stroke-blue" width="20" height="20"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"></path>
                <path
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </li>
          <li class="group cursor-pointer text-white mt-5">
            <button >
              <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:stroke-blue" width="20" height="20"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"></path>
                <rect x="3" y="4" width="18" height="4" rx="2"></rect>
                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                <line x1="10" y1="12" x2="14" y2="12"></line>
              </svg>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- end Sidebar -->
  <!-- main section -->
  <section role="main" class="w-full md:ml-80 pt-12 md:pt-6 min-h-screen px-3 sm:px-10">
    <header class="font-semibold text-3xl mt-36 md:mt-0 py-3"> <!-- Title -->
      <p><?php echo $title?></p>
    </header>
    <!-- info -->
    <div id="info">
    </div>
    <?php echo $content ?>

    <!-- footer(Да, нарушили вёрстку, но да пофиг(типо находимся в section)) -->
    <!--Footer container-->
    <footer class="text-center border-t border-gray-500 mt-36 lg:text-left">
      <div class="container p-3 mx-auto md:p-6">
        <div class="grid gap-4 md:grid-cols-2">
          <div class="mb-6 md:mb-0">
            <h5 class="mb-2 font-medium uppercase text-blue">Выпуск Alfa 0.3</h5>

            <p class="mb-4 max-w-lg">
              В данном обновлении добавлена админпанель, системы авторизации и регистрации.
              В скоре появиться свой облачный диск, использующий серверное локальное хранилеще или сторонний сервис хранения данных (FTP, AWS)
            </p>
          </div>

          <div class="mb-6 md:mb-0">
            <h5 class="mb-2 font-medium uppercase text-blue">DEEPMIND Engine</h5>

            <p class="mb-4 max-w-lg">
              Высокоскоростной движок для сайтов коммерции, бизнесса и портфолио, позволяющий тонко настраивать различные функции сайта. Регистрация,
              системы авторизации и хранения данных - уже всё продумано за вас, осталось только воспользоваться всеми возможностями DME!
            </p>
          </div>
        </div>
      </div>

      <!--Copyright section-->
      <div class="p-4 text-center">
        © 2023 Copyright:
        <a class="text-blue" href="https://deepmind.studio/">deepmind.studio</a>
      </div>
    </footer>


  </section>
<!-- end main section -->
  <script src="/public/scripts/jquery.js"></script>
  <script src="/public/scripts/panel.js"></script>
  <script src="/public/scripts/form.js" defer></script>
</body>
</html>