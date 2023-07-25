<div class="w-full">
      <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-12">
        <div class="col-span-12 lg:col-span-10 xl:col-span-7 md:mt-8">


          <div class="flex bg-input relative border-stroke border-2 rounded-md md:max-w-sm md:min-w-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="absolute left-3 top-[22%] placeholder:ml-3"
              viewBox="0 0 24 24">
              <path fill="currentColor" d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16
                                                9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854
                                                1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757
                                                0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z">
              </path>
            </svg>
            <input type="text" name="searchControllers" id="searchControllers" autocomplete="none"
              class="block shadow-sm flex-1 py-1.5 w-full sm:text-sm focus:ring-0 sm:leading-6 bg-input md:min-w-sm border-none rounded-md pl-11"
              placeholder="Поиск">
            <select name="asd" id="asd" class="rounded-r-md bg-input border-none focus:ring-0 text-center items-center border-stroke">
              <option value="" class="hidden" selected>Категория</option>
              <option value="">system</option>
              <option value="">allusers</option>
            </select>
          </div>


          <table id="table" class="border-spacing-y-8 mt-8 border-spacing-x-4 text-center border-separate border-2 border-stroke rounded-2xl w-full">
            <tr>
              <td class="border-b-2 border-stroke"><p class="md:whitespace-nowrap">Имя контроллера</p></td>
              <td class="border-b-2 border-stroke hidden lg:table-cell">Описание</td>
              <td class="border-b-2 border-stroke hidden sm:table-cell">Категория</td>
              <td></td>
            </tr>
          </table>
          <script>
  
          </script>
        </div>





        <div class="col-span-12 lg:col-span-10 xl:col-span-5 mt-8">
          <a href="#" onclick="actionController()" class="text-sm font-semibold leading-6 px-8 bg-green rounded-2xl py-2.5 flex justify-center hover:bg-green/50 transition duration-200 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
            </svg>
            Добавить контроллер</a>
          <div id="container" class="border-2 bg-[url('/public/images/wrench.svg')] mt-8 px-3 bg-no-repeat bg-cover bg-center bg-main border-stroke rounded-2xl">
            <div class="hidden only:block text-2xl mx-auto text-center font-bold py-48">Выберите контроллер,<br> чтобы посмотреть или отредактировать его данные</div>



              
          </div>
        </div>

        
      </div>
    </div>
<script src="/public/scripts/panel.controller.js" defer></script>
