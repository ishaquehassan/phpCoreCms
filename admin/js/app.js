/**
 * Created by Ishaq Hassan on 10/20/2016.
 */
$(document).ready(function (e) {
    $(".login_form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serializeArray();
        $.ajax({
            url:form.attr("action"),
            type:form.attr("method"),
            data:formData,
            dataType:'json',
            success: function (response) {
                $(".response_text").text(response.msg);
                if(!response.error){
                    setTimeout(function () {
                        window.location = response.url;
                    },1000);
                }
            },error:function (error) {
                console.log(error.responseText);
            },complete:function () {

            }
        });
    });

    $('.image-popup').magnificPopup(
        {
            type:'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-with-zoom', // this class is for CSS animation below

            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it

                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function

                // The "opener" function should return the element from which popup will be zoomed in
                // and to which popup will be scaled down
                // By defailt it looks for an image tag:
                opener: function(openerElement) {
                    // openerElement is the element on which popup was initialized, in this case its <a> tag
                    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        }
    );

    $('.image-popup-simple').magnificPopup(
        {
            type: 'image',
            gallery: {
                enabled: true
            }
        }
    );
});

function notify(msg,type) {
    // Get the snackbar DIV
    if(type == null || typeof type == 'undefined'){
        type = "info";
    }

    var notification = $('<div class="snackbar '+type+'">'+msg+'</div>');
    $("body").append(notification);

    // Add the "show" class to DIV
    notification.addClass("show");

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){
        notification.removeClass("show");
        notification.remove();
    }, 6000);
}