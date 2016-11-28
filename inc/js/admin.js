(function($) {
    'use strict';

    var $fields = $("div[data-name='ad_image']");

    $fields.each(function() {
        var ad_box,
            ad_id = $(this).find('.acf-hidden input')[0].value,
            values;

        $(this).append('<div class="ad-stats">');
        ad_box = $(this).children('.ad-stats');

        if (!ad_id) {
            console.log('no id');
            return;
        }

        values = get_values(ad_id);

        $.when(values).done(function(data) {
            ad_box[0].innerHTML += data;
        });
    });

    function get_values(id) {
        return $.ajax({
            method : "POST",
            url : ajaxurl,
            data : {
                action : 'get_values',
                post_id : id,
            },
            dataType : 'html',
            success : function(data, status, jqXHR) {
                //console.log(data);
            },
            error : function(jqXHR, status, error) {
                console.log('jqXHR: '+jqXHR);
                console.log('Status: '+status);
                console.log('Error: '+error);
            }
        });
    }

})(jQuery);