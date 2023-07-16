const data = {
	"all": ["index", "login", "logout", "settings"],
	"authorize": [],
	"guest": [],
	"admin": []
}


const acl_all = $('#acl_all');
const acl_authorize = $('#acl_authorize');
const acl_guest = $('#acl_guest');
const acl_admin = $('#acl_admin');
const select = $('#controllers_select');
const defMessage = `<div class="border hidden only:block rounded-md p-1 border-[inherit] px-6 text-desc bg-gray-800">Поместите ваш action здесь...</div>`;

function renderActions(element){
  acl_all.html(defMessage);
  acl_authorize.html(defMessage);
  acl_all.html(defMessage);
  acl_all.html(defMessage);

  if(data.all.length >0){
    data.all.forEach(element => {
      acl_all.append(`<div draggable="true" ondragstart="onDragStart(event);" id="${element}"class="border rounded-md p-1 border-[inherit] px-6">${element}</div>`);
    });
  }

  if(data.authorize.length >0){
    data.authorize.forEach(element => {
      acl_all.append(`<div draggable="true" ondragstart="onDragStart(event);" id="${element}"class="border rounded-md p-1 border-[inherit] px-6">${element}</div>`);
    });
  }

  if(data.guest.length >0){
    data.guest.forEach(element => {
      acl_all.append(`<div draggable="true" ondragstart="onDragStart(event);" id="${element}"class="border rounded-md p-1 border-[inherit] px-6">${element}</div>`);
    });
  }

  if(data.admin.length >0){
    data.admin.forEach(element => {
      acl_all.append(`<div draggable="true" ondragstart="onDragStart(event);" id="${element}"class="border rounded-md p-1 border-[inherit] px-6">${element}</div>`);
    });
  }
  $('.list').removeClass('list')
  
}