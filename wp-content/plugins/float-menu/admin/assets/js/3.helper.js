'use strict'

jQuery(document).ready(function ($) {

    $.fn.wowFullEditor = function () {
        this.each(function (index, element) {
            const newId = 'wpie-fulleditor-' + (index + 1);
            $(element).attr('id', newId);
            $(element).css({'border': 'none', 'width': '100%'});
            wp.editor.initialize(
                newId,
                {
                    tinymce: {
                        wpautop: true,
                        plugins: 'textcolor colorpicker wplink wordpress',
                        toolbar1: 'bold italic underline blockquote | alignleft aligncenter alignright | bullist numlist outdent indent | link unlink | wp_more | fullscreen',
                        toolbar2: 'formatselect strikethrough hr forecolor pastetext removeformat charmap undo redo',
                    },
                    quicktags: {
                        buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,fullscreen"
                    },
                    mediaButtons: true,
                }
            );
        });
    };

    $.fn.wowTextEditor = function () {
        this.each(function (index, element) {
            const newId = 'wpie-shorteditor-' + (index + 1);
            $(element).attr('id', newId);
            $(element).css({'border-top': 'none', 'min-height': '2'});

            wp.editor.initialize(newId, {
                tinymce: false, // This disables Visual mode
                quicktags: {
                    buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,fullscreen"
                },
                mediaButtons: false,
            });
        });
    };

    $.fn.wowIconPicker = function () {
        this.fontIconPicker({
            theme: 'fip-darkgrey',
            emptyIcon: false,
            allCategoryText: 'Show all',
        });
    };


});

