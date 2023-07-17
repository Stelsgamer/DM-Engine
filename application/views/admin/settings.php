<form action="#" method="post" spellcheck="false" class="">
  <div class="w-full lg:w-2/3 xl:w-1/2">
    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-6">

      <div class="col-span-6 md:col-span-4">
        <label for="sitename"
          class="block text-sm font-medium leading-6">Название
          сайта / Site name:</label>
        <div class="mt-2">
          <div class="flex md:max-w-md">
            <input type="text" name="sitename" id="sitename" autocomplete="none"
              class="input bg-input border-text invalid:border-red" value="<?php echo $sitename ?>" placeholder="Your greate site name here" required>
          </div>
        </div>
      </div>
      
      <div class="col-span-6 md:col-span-4">
        <label for="domain" class="block text-sm font-medium leading-6">Домен
          сайта
          / Site domain:</label>
        <div class="mt-2">
          <div class="flex md:max-w-md">
            <input type="text" name="domain" id="domain" autocomplete="none"
              class="input order-last pl-0 border-l-0 border-text peer bg-input rounded-l-none invalid:border-red"
              value="<?php echo $domain ?>" placeholder="example.com" required>
            <span
              class="flex  rounded-l-md select-none items-center border-y border-text border-l peer-valid:peer-focus:border-indigo peer-invalid:border-red pl-3 bg-input sm:text-sm">https://</span>
          </div>
        </div>
      </div>
      
      <div class="col-span-6">
        <label for="about" class="block text-sm font-medium leading-6 ">Описание / Description:</label>
        <div class="mt-2">
          <textarea id="about" name="about" rows="4" class="input w-full border-text bg-input overflow-hidden"><?php echo $about ?></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 font-thin text-desc">* Напишите о чём будет ваш сайт. Это будет
            использовано в индексации роботами поисковых систем</p>
          </div>
          
          <div class="col-span-6">
            <label for="keywords" class="block text-sm font-medium leading-6 ">Теги / Keywords:</label>
            <div class="mt-2">
          <textarea id="keywords" name="keywords" rows="4" class="input w-full border-text bg-input overflow-hidden"><?php echo $keywords ?></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 font-thin text-desc">* Перечислите через запятую теги/ключевые слова, с
            помощью которых ваш сайт будет индексироваться в поисковых сервисах</p>
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