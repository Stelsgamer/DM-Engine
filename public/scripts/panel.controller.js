
  

  const table = $('#table');
  const container = $('#container');
  const def = `<tr>
  <td class="border-b-2 border-stroke"><p class="md:whitespace-nowrap">Имя контроллера</p></td>
  <td class="border-b-2 border-stroke hidden lg:table-cell">Описание</td>
  <td class="border-b-2 border-stroke hidden sm:table-cell">Категория</td>
  <td></td></tr>`;

  
  function getOneController(name){
    $.ajax({
        type: 'post',
        url: '/api/controller/',
        data: {"action": "getOneController", "name": name },
        cache: false,
        success: function (result) {
        const data = jQuery.parseJSON(result);
          if (data) {
            container.html(`
                <div class="py-3 px-6">
                <h2 class="text-3xl">Контроллер ${name}</h2>
                <span class="block text-md font-medium leading-6 mt-6">Название контроллера / Controller name:</span>
                <div class="input px-3 border-2 mt-2 bg-input border-text">${name}</div>
                <span class="block text-md font-medium leading-6 mt-6">Описание контроллера / Controller description:</span>
                <div class="input mt-2 px-3 border-text border-2 w-full bg-input overflow-hidden">${data.description}</div>
                <span class="block text-md font-medium leading-6 mt-6">Тип контроллера / Controller type:</span>
                <div class="bg-input rounded-md px-4 py-3 mt-3 border-2 border-text">
                <span class="select-none">${data.category}</span>
                </div>
    
                <div class="pt-6 pb-3 flex justify-end space-x-6">
                <button type="button" onclick="actionController('${name}')"
                    class="text-sm font-normal leading-6 border border-blue text-blue rounded-sm px-6 p-2 hover:bg-blue hover:text-input transition duration-200">Внести правки</button>
                </div>
            </div>`);
        }else{
            table.html('У вас нет ни одного контроллера');
        }
        }
    })
  }

  function getControllers(){
      $.ajax({
        type: 'post',
        url: '/api/controller/',
        data: {"action": "getControllers" },
        cache: false,
        success: function (result) {
          const data = jQuery.parseJSON(result);
          if (data) {
            $.each(data, function(index, val){
              table.append(`<tr>
              <td>${index}</td>
              <td class="hidden lg:table-cell">${val.description}</td>
              <td class="hidden sm:table-cell">${val.category}</td>
              <td><button onclick="getOneController('${index}')" class="getinfobutton text-sm font-normal leading-6 px-8 bg-indigo text-text rounded-lg p-2 hover:bg-indigo/50 transition duration-200 hover:text-white" >Выбрать</button></td>
              </tr>`);
            })
          }else{
            table.html('У вас нет ни одного контроллера');
          }
        }
      })
    }

    function actionController(name = false) {
      if(name){

        $.ajax({
          type: 'post',
          url: '/api/controller/',
          data: {"action": "getOneController", "name": name },
          cache: false,
          success: function (result) {
            const data = jQuery.parseJSON(result);
            container.html(`<div class="py-3 px-6">
            <h2 class="text-3xl">Редактирование контроллера ${name}</h2>
            <span class="font-thin text-sm">
              Для вашего удобства, успользуйте короткие и запоминающиеся имена
            </span>

            <form action="#" method="post" class="mt-5">
              <label for="c_name" class="block text-md font-medium leading-6 mt-6">
                Название контроллера / Controller name:
              </label>
              <input type="text" name="c_name" id="c_name" autocomplete="none"
                class="input border-2 bg-input border-text mt-2" value="${name}" placeholder="Custom">


              <label for="c_description" class="block text-md font-medium leading-6 mt-6">Описание контроллера / Controller description:</label>
              <textarea id="c_description" name="c_description" rows="1" class="input mt-2 border-text border-2 w-full bg-input overflow-hidden" oninput="auto_grow(this)">${data.description}</textarea>
              <p class=" text-sm leading-6 font-thin text-desc">Данная информация не повлияет на работу контроллера</p>

              <span class="block text-md font-medium leading-6 mt-6">Тип контроллера / Controller type:</span>
              
              <div class="bg-input rounded-md px-4 mt-3 border-2 border-text">
                <div class="py-3">
                  <div>
                    <input type="radio" id="c_admin"
                    name="category" value="Admin - контроллеры, частично или полностью предназначенные для администраторов">
                    <label for="c_admin" class="select-none ml-2">Admin - контроллеры, частично или полностью предназначенные для администраторов</label>
                  </div>

                  <div class="pt-3">
                    <input type="radio" id="c_client"
                    name="category" value="Client - контроллеры, предназначенные для пользователей (выдача основного контента)">
                    <label for="c_client" class="select-none ml-2">Client - контроллеры, предназначенные для пользователей (выдача основного контента)</label>
                  </div>

                  <div class="pt-3">
                    <input type="radio" id="c_service"
                    name="category" value="Service - контроллеры, предназначенные для сервисов (отдельное API сервисов)">
                    <label for="c_service" class="select-none ml-2">Service - контроллеры, предназначенные для сервисов (отдельное API сервисов)</label>
                  </div>

                  <div class="pt-3">
                    <input type="radio" id="c_custom"
                    name="category" checked value="Custom - контроллеры, которые не подходят под остальные категории">
                    <label for="c_custom" class="select-none ml-2">Custom - контроллеры, которые не подходят под остальные категории</label>
                  </div>
                </div>
              </div>
              <p class=" text-sm leading-6 font-thin text-desc">Данная информация не повлияет на работу контроллера</p>
              <div class="pt-3 flex justify-end space-x-6">

                <button type="submit" 
                  class="text-sm font-normal leading-6 border border-blue text-blue rounded-sm p-2 hover:bg-blue px-6 hover:text-input transition duration-200">Сохранить</button>
                  <button type="button" onclick="getOneController('${name}')"
                  class="text-sm font-normal leading-6 border bg-gray-500 border-gray-500 px-3 hover:bg-input hover:text-gray-500 text-main transition duration-200 rounded-sm p-2">Отмена</button>
              </div>
            </form>
          </div> `)
          }
        })
      }else{
        container.html(`<div class="py-3 px-6">
        <h2 class="text-3xl">Добавление нового контролера</h2>
        <span class="font-thin text-sm">
          Для вашего удобства, успользуйте короткие и запоминающиеся имена
        </span>
  
        <form action="#" method="post" class="mt-5">
          <label for="c_name" class="block text-md font-medium leading-6 mt-6">
            Название контроллера / Controller name:
          </label>
          <input type="text" name="c_name" id="c_name" autocomplete="none"
            class="input border-2 bg-input border-text mt-2" placeholder="Custom">
  
  
          <label for="c_description" class="block text-md font-medium leading-6 mt-6">Описание контроллера / Controller description:</label>
          <textarea id="c_description" name="c_description" rows="1" class="input mt-2 border-text border-2 w-full bg-input overflow-hidden" oninput="auto_grow(this)"></textarea>
          <p class=" text-sm leading-6 font-thin text-desc">Данная информация не повлияет на работу контроллера</p>
  
          <span class="block text-md font-medium leading-6 mt-6">Тип контроллера / Controller type:</span>
          
          <div class="bg-input rounded-md px-4 mt-3 border-2 border-text">
            <div class="py-3">
              <div>
                <input type="radio" id="c_admin"
                name="category" value="admin">
                <label for="c_admin" class="select-none ml-2">Admin - контроллеры, частично или полностью предназначенные для администраторов</label>
              </div>
  
              <div class="pt-3">
                <input type="radio" id="c_client"
                name="category" value="client">
                <label for="c_client" class="select-none ml-2">Client - контроллеры, предназначенные для пользователей (выдача основного контента)</label>
              </div>
  
              <div class="pt-3">
                <input type="radio" id="c_service"
                name="category" value="service">
                <label for="c_service" class="select-none ml-2">Service - контроллеры, предназначенные для сервисов (отдельное API сервисов)</label>
              </div>
  
              <div class="pt-3">
                <input type="radio" id="c_custom"
                name="category" checked value="custom">
                <label for="c_custom" class="select-none ml-2">Custom - контроллеры, которые не подходят под остальные категории</label>
              </div>
            </div>
          </div>
          <p class=" text-sm leading-6 font-thin text-desc">Данная информация не повлияет на работу контроллера</p>
          <div class="pt-3 flex justify-end space-x-6">
  
            <button type="submit" 
              class="text-sm font-normal leading-6 border border-blue text-blue rounded-sm p-2 hover:bg-blue px-6 hover:text-input transition duration-200">Сохранить</button>
              <button type="button" onclick="setDefault()"
              class="text-sm font-normal leading-6 border bg-gray-500 border-gray-500 px-3 hover:bg-input hover:text-gray-500 text-main transition duration-200 rounded-sm p-2">Отмена</button>
          </div>
        </form>
      </div> `)
      }
    }

    function setDefault() {
      container.html(`<div class="hidden only:block text-2xl mx-auto text-center font-bold py-48">Выберите контроллер,<br> чтобы посмотреть или отредактировать его данные</div>`);  
    }
    







