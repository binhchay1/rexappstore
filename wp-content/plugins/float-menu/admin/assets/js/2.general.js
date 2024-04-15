'use strict'

jQuery(document).ready(function($) {

    $('.wpie-tabs').on('click', '.wpie-tab-label', function() {
        $('.wpie-tabs .wpie-tab-label').removeClass('selected');
        $(this).addClass('selected');
    });

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('notice')) {
        const notice = $('.wpie-notice');
        $(notice).addClass('is-active');
        setTimeout(function (){
            $(notice).removeClass('is-active');
        }, 5000);
    }

    $('.wpie-settings__main').on('click', '.wpie-tab__link', function (){
        const parent = $(this).closest('.wpie-tabs-wrapper');
        const links = $(parent).find('.wpie-tab__link');
        const settings = $(parent).find('.wpie-tab-settings');
        const index = $(links).index(this);

        $(links).removeClass('is-active');
        $(this).addClass('is-active');
        $(settings).removeClass('is-active');
        $(settings).eq(index).addClass('is-active');
    });

});