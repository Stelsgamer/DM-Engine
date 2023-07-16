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
                    alert(json.text);
                }
            },
        });
    });




});


