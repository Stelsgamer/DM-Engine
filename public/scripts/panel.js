    const sidebar = $('.sidebar');
    $('#openSidebar').on('click', function(){
      if (sidebar.is(":hidden")) {
        sidebar.slideDown("medium");
      } else {
        sidebar.slideUp("medium");
      }
    })

    function auto_grow(element) {
      element.style.height = "40.7px";
      element.style.height = (element.scrollHeight) + "px";
    }

    function onDragStart(event) {
      event.dataTransfer.clearData();
      event
        .dataTransfer
        .setData('text/plain', event.target.id);
  
    }

    function onDragEnter(event) {
      event.preventDefault();
  }
    
    function onDragOver(event) {
      event.preventDefault();
    }

    function onDrop(event) {
      const id = event
        .dataTransfer
        .getData('text');

        const draggableElement = document.getElementById(id);
        const dropzone = event.target;
        
        if(dropzone.id == 'acl_all' || dropzone.id == 'acl_authorize' || dropzone.id == 'acl_admin' || dropzone.id == 'acl_guest'){
          dropzone.appendChild(draggableElement);
        }else{
          dropzone.parentNode.appendChild(draggableElement);
        }
    }
    