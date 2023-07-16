<!-- Settings controllers acl-->


<div class="border-l-4 mt-3 border-blue pt-2 pb-3 pl-3 md:w-full lg:w-2/3 xl:w-1/2 rounded-r-sm shadow-md">
  <p class="mt-1 text-sm self-center leading-6 pr-1">Инструкция:<br>
  <ul class="text-sm list-disc list-inside ml-3">
    <li>Выберите контроллер, который вы хотите настроить из списка ниже</li>
    <li>Используйте мышь, перетаскивая блоки из одной группы доступа в другую</li>
    <li>Системные настройки контроллера admin доступны только для чтения.<br>Они не будут перезаписаны. Их возможно
      отредактировать только вручную</li>
    <li>Имеются расширенные настройки для опытных пользователей внизу страницы.<br>Изменяйте их на ствой страх и риск!
    </li>
  </ul>
  <br>Не забывайте сохранять свои изменения кнопкой внизу страницы!</p>
</div>
<div class="border-l-4 mt-3 border-yellow pt-2 pb-3 pl-3 sm:w-4/5 md:w-2/3 xl:w-1/2 rounded-r-sm shadow-md">
  <p class="mt-1 text-sm self-center leading-6 pr-1">Внимание, при изменении параметров через интерфейс панели возможна
    перезапись индивидуальных донастроек! Рекомндуется сделать резервную копию данных</p>
</div>
<div id="info">
  <div class="border-l-4 mt-3 border-red pt-2 pb-3 pl-3 sm:w-4/5 md:w-2/3 xl:w-1/2 rounded-r-sm shadow-md">
    <p class="mt-1 text-sm self-center leading-6 pr-1">Ошибка: произошла ошибка при обновлении конфигурации. Проверьте
      права доступа<br>на чтение/запись файлов конфигурации ACL 'application/acl/{controller}.acl.php'</p>
  </div>
</div>
<!-- end info -->

<div class="w-full lg:w-2/3 xl:w-1/2">
  <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-6">
    <div class="col-span-6 md:col-span-4">
      <!-- controller's list -->
      <label class="block text-sm font-medium leading-6 baseline" for="controllers">Контролер / Controller:</label>
      <select class="bg-input min-w-min border-blue focus:border-blue rounded-md" onchange="renderActions(this);"
        id="controllers_select">
        <option class="hidden" selected>Выберите / choose</option>
        <option value="main">main</option>
        <option value="admin">admin</option>
        <option value="account">account</option>
      </select>
    </div>

    <div class="list col-span-6 md:col-span-4 ">
      <label for="acl" class="block text-sm font-medium p-2 leading-6 baseline">Контроль доступа / ACL:</label>
      <div name="acl" class="space-y-4 px-3 py-2 rounded-sm">
        <div class="">
          <label for="acl_all" class="absolute ml-7 text-sm font-medium leading-6 text-text">Всем пользователи:</label>
          <div class="border-x pt-5 border-blue rounded-md py-3 px-6 space-y-2 select-none shadow-md" id="acl_all"
            ondragover="onDragOver(event);" ondrop="onDrop(event);">
            <!-- users -->
            <div class="border hidden only:block rounded-md p-1 border-[inherit] px-6 text-desc bg-gray-800">Поместите
              ваш action здесь...</div>
          </div>
        </div>

        <div class="">
          <label for="acl_authorize" class="absolute ml-7 text-sm font-medium leading-6 text-text">Авторизированные
            пользователи:</label>
          <div class="border-x pt-7 border-green rounded-md py-3 px-6 space-y-2 select-none shadow-md"
            id="acl_authorize" ondragover="onDragOver(event);" ondrop="onDrop(event);"
            ondragenter="onDragEnter(event);">
            <!-- auth -->
            <div class="border hidden only:block rounded-md p-1 border-[inherit] px-6 text-desc bg-gray-800">Поместите
              ваш action здесь...</div>
          </div>
        </div>

        <div class="">
          <label for="acl_guest" class="absolute ml-7 text-sm font-medium leading-6 text-text">Неавторизированные
            пользователи:</label>
          <div class="border-x pt-7 border-yellow rounded-md py-3 px-6 space-y-2 select-none shadow-md" id="acl_guest"
            ondragover="onDragOver(event);" ondrop="onDrop(event);" ondragenter="onDragEnter(event);">
            <!-- guests -->
            <div class="border hidden only:block rounded-md p-1 border-[inherit] px-6 text-desc bg-gray-800">Поместите
              ваш action здесь...</div>
          </div>
        </div>

        <div class="">
          <label for="acl_admin" class="absolute ml-7 text-sm font-medium leading-6 text-text">Администраторы
            сисемы:</label>
          <div class="border-x pt-7 border-red rounded-md py-3 px-6 space-y-2 select-none shadow-md" id="acl_admin"
            ondragover="onDragOver(event);" ondrop="onDrop(event);" ondragenter="onDragEnter(event);">
            <!-- admin -->
            <div class="border hidden only:block rounded-md p-1 border-[inherit] px-6 text-desc bg-gray-800">Поместите
              ваш action здесь...
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="list col-span-6 md:col-span-4">
      <details class="open:bg-input open:shadow-lg p-6 rounded-lg">
        <summary class="text-sm leading-6 text-gray-600 dark:text-white font-semibold select-none">
          Расширеный режим<br>(Изменяйте содержимое только тогда, когда <span class="text-blue underline">полностью
            уверены
            в своих действиях</span>)
        </summary>
        <div class="mt-3 text-sm leading-6">
          <textarea class="input w-full border-text bg-input" id="file_acl" rows="20"
            rows="1"><?php echo 123123 ?></textarea>
        </div>
      </details>
    </div>
    <div class="list col-span-6">
      <div class="flex justify-end gap-x-4">
        <button type="submit"
          class="text-sm font-normal leading-6 border bg-blue border-blue text-main rounded-sm p-2">Сохранить</button>
        <button type="button" id="clear"
          class="text-sm font-normal leading-6 border border-blue text-blue rounded-sm p-2 hover:bg-blue hover:text-main transition duration-200">Отменить
          изменения</button>
      </div>
    </div>
  </div>
</div>
<script src="/public/scripts/panel.acl.js" defer></script>
