$(document).ready(function(event){
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
            success: function(result){
                json = jQuery.parseJSON(result);
                if (json.url) {
                    window.location.href = json.url;
                } else if(json.reload){
                    window.location.reload();
                } else {
                    if (json[0] == "message") {
                        alert(json.text); 
                    } else {
                        let colors = { "error": "red", "success": "green", "warn": "yellow" };
                        $('#info').html(`<div class="border-l-4 mt-3 border-${colors[json[0]]} pt-2 pb-3 pl-3 sm:w-4/5 md:w-2/3 xl:w-1/2 rounded-r-sm shadow-md">
                        <p class="mt-1 text-sm self-center leading-6 pr-1">${json.text}</p></div>
                        `);
                        window.scrollTo({
                            top: 0,
                            left: 0,
                            behavior: 'smooth'
                        });
                    }
                }
            },
        });
    });




});


