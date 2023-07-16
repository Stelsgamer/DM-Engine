 <!-- Почтовые заготовки будут храниться в отдельных файлах -->
 <form action="/admin/email/" spellcheck="false" method="post" class="">
    <!-- end info -->
    <div class="border-l-4 mt-3 border-blue pt-2 pb-3 pl-3 md:w-full lg:w-2/3 xl:w-1/2 rounded-r-sm shadow-md">
      <p class="mt-1 text-sm self-center leading-6 pr-1">Вы можете использовать html разметку и следующие теги для подстановки данных в письма:<ul class="text-sm"><li>{content} - важный тег с данными (должен использоваться для каждого письма)</li><li>{email-to} - email получателя</li><li>{email-reply} - email для обратной связи</li><li>{time} - время отправления</li><li>{site} - имя сайта отправителя</li></ul><br>Если вы оставите поля пустыми, то будут отправляться сообщения по умолчанию</p>
    </div>
    <div class="w-full lg:w-2/3 xl:w-1/2">
      <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-6">

        <div class="col-span-6">
          <label for="email_confirm" class="block text-sm font-medium leading-6 ">Подтверждение регистрации / Registration confirm:</label>
          <div class="mt-2">
            <textarea id="email_confirm" name="email_confirm" rows="5" class="input w-full border-text bg-input"><?php echo $e_confirm ?></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 font-thin text-desc">Это письмо получит пользователь при регистрации на сайте</p>
        </div>
  
        <div class="col-span-6">
          <label for="email_recovery" class="block text-sm font-medium leading-6 ">Восстановление пароля / Password recovery:</label>
          <div class="mt-2">
            <textarea id="email_recovery" name="email_recovery" rows="5" class="input w-full border-text bg-input"><?php echo $e_recovery ?></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 font-thin text-desc">Это письмо получит пользователь при восстановлении пароля от учётной записи на сайте</p>
        </div>

        <div class="col-span-6">
          <label for="email_request" class="block text-sm font-medium leading-6 ">Ответ администрации / Administration request:</label>
          <div class="mt-2">
            <textarea id="email_request" name="email_request" rows="5" class="input w-full border-text bg-input"><?php echo $e_request ?></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 font-thin text-desc">Это письмо получит пользователь, если им придёт личное сообщение от администрации сайта</p>
        </div>

        <div class="col-span-6">
          <label for="email_banned" class="block text-sm font-medium leading-6">Блокировка / Banned:</label>
          <div class="mt-2">
            <textarea id="email_banned" name="email_banned" rows="5" class="input w-full border-text bg-input"><?php echo $e_banned ?></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 font-thin text-desc">Это письмо получит пользователь, если его заблокируют в системе</p>
        </div>
  
        <div class="col-span-6">
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
  </form> 

  