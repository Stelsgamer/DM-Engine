$(window). on("load", function() { 
    $('#clear').on("click", function() {
        inputs = $('input');
        textarea = $('textarea')
        for (let index = 0; index < inputs.length; index++) {
            inputs[index].value = '';
        }

        for (let index = 0; index < textarea.length; index++) {
            textarea[index].value = '';
        }        
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
        
    });

    $('form').submit(function(event) {
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
                const info = $('#info');
                json = jQuery.parseJSON(result);
                info.html(`<div class="border-l-4 border-${json.color} py-3 px-3 rounded-r-sm shadow-md">
                    <p class="text-white text-xl">${json.message}</p>
                  </div>`);
                window.scrollTo({ 
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                  });
                setTimeout(function () {
                    info.slideUp("slow", function () {
                        info.html("")
                    });
                }, 3000);
			},
		});
	});

})