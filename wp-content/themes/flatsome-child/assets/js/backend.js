var isuresTimeout = null;

jQuery(document).ready(function($) {


    // search input
    $('#search_keyword').keyup(function() {
        if ($('#search_keyword').val() != '') {

            $('#search_loading').show();

            if (isuresTimeout != null) {
                clearTimeout(isuresTimeout);
            }

            isuresTimeout = setTimeout(item_gift_ajax, 300);

            return false;
        }
    });

    // actions on search result items
    $('#product_gift').on('click', 'li', function() {
        $(this).children('span.remove').html('×');
        $('#product_selected ul').append($(this));
        $('#product_gift').hide();
        $('#search_keyword').val('');
        gift_get_ids();
        gift_arrange();

        return false;
    });

    // change qty of each item
    $('#product_selected').on('keyup change click', 'input', function() {
        gift_get_ids();

        return false;
    });

    // actions on selected items
    $('#product_selected').on('click', 'span.remove', function() {
        $(this).parent().remove();
        gift_get_ids();

        return false;
    });

    // hide search result box if click outside
    $(document).on('click', function(e) {
        if ($(e.target).closest($('#product_gift')).length == 0) {
            $('#product_gift').hide();
        }
    });


    $(document).on('isuresDragEndEvent', function() {
        gift_get_ids();
    });
});

function gift_settings() {
    // hide search result box by default
    jQuery('#product_gift').hide();
    jQuery('#search_loading').hide();
}


function gift_get_ids() {
    var product_id_gift = new Array();

    jQuery('#product_selected li').each(function() {
        if (!jQuery(this).hasClass('isures_default')) {
            product_id_gift.push(jQuery(this).attr('data-id'));
            jQuery('.isures_tr_space').show();
        }
    });

    if (product_id_gift.length > 0) {
        jQuery('#product_id_gift').val(product_id_gift.join(','));

    } else {
        jQuery('#product_id_gift').val('');
        jQuery('.isures_tr_space').hide();
    }
}

function item_gift_ajax() {
    // ajax search product
    isuresTimeout = null;

    var data = {
        action: 'item_gift_ajax',
        search_keyword: jQuery('#search_keyword').val(),
        product_id_current: jQuery('#product_id_current').val(),
        product_id_gift: jQuery('#product_id_gift').val(),
    };

    jQuery.post(ajaxurl, data, function(response) {
        jQuery('#product_gift').show();
        jQuery('#product_gift').html(response);
        jQuery('#search_loading').hide();
    });
}