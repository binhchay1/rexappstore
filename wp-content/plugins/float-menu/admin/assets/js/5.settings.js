'use strict';

jQuery(document).ready(function ($) {

    const selectors = {
        settings: '.wpie-settings__main',
        items_list: '.wpie-items__list',
        full_editor: '.wpie-fulleditor',
        text_editor: '.wpie-texteditor',
        color_picker: '.wpie-color',
        icon_picker: '[data-field="menu_1-item_icon"]',
        item_type: '[data-field="menu_1-item_type"]',
        checkbox: '.wpie-field input[type="checkbox"]',
        add_item: '.wpie-add-button',
        custom_icon: '[data-field="menu_1-item_custom"]',
        text_icon: '[data-field="menu_1-item_custom_text_check"]',
        enable_tracking: '[data-field="menu_1-enable_tracking"]',
        item: '.wpie-item',
        item_remove: '.wpie-item_heading .dashicons-trash',
        item_heading: '.wpie-item .wpie-item_heading',
        delete_link: '.wpie-link-delete, .delete a',
    };

    $(selectors.full_editor).wowFullEditor();

    function set_up() {

        $(selectors.text_editor).wowTextEditor();
        $(selectors.icon_picker).wowIconPicker();
        $(selectors.color_picker).wpColorPicker({
            change: function(event, ui){ $(selectors.item).wowFloatMenuLiveBuilder(); },
        });
        $(selectors.item).wowFloatMenuLiveBuilder();
        $(selectors.items_list).sortable({
            items: '> .wpie-item',
            placeholder: "wpie-item ui-state-highlight",
        });
        $(selectors.items_list).disableSelection();

        $(selectors.checkbox).each(set_checkbox);
        $(selectors.item_type).each(item_type);

        $(selectors.custom_icon).each(custom_icon);
        $(selectors.text_icon).each(custom_icon);
        $(selectors.enable_tracking).each(enable_tracking);
    }

    function initialize_events() {
        $(selectors.settings).on('change', selectors.checkbox, set_checkbox);
        $(selectors.settings).on('click', selectors.add_item, clone_button);
        $(selectors.settings).on('change', selectors.item_type, item_type);
        $(selectors.settings).on('change', selectors.custom_icon, custom_icon);
        $(selectors.settings).on('change', selectors.text_icon, custom_icon);
        $(selectors.settings).on('change', selectors.enable_tracking, enable_tracking);
        $(selectors.settings).on('click', selectors.item_remove, item_remove);
        $(selectors.settings).on('click', selectors.item_heading, item_toggle);
        $(document).on('click', selectors.delete_link, delete_menu);

        $(selectors.settings).on('change click keyup', selectors.item, function (){
            $(selectors.item).wowFloatMenuLiveBuilder();
        });
    }

    function initialize() {
        set_up();
        initialize_events();
    }

    // Set the checkboxes
    function set_checkbox() {
        const next = $(this).next('input[type="hidden"]');
        if ($(this).is(':checked')) {
            next.val('1');
        } else {
            next.val('0');
        }
    }

    // Clone menu item
    function clone_button(e) {
        e.preventDefault();
        const parent = get_parent_fields($(this), '.wpie-items__list');
        const selector = $(parent).find('.wpie-buttons__hr');
        const template = $('#template-button').clone().html();

        $(template).insertBefore($(selector));

        set_up();
    }

    // Change the button Type
    function item_type() {
        const parent = get_parent_fields($(this));
        const box = get_field_box($(this));
        const type = $(this).val();
        const fields = parent.find('[data-field-box]').not(box);
        const parentTab = get_parent_fields($(this), '.wpie-tabs-wrapper');

        parentTab.find('.wpie-tab__type-menu').addClass('is-hidden');
        fields.addClass('is-hidden');

        const linkText = parent.find('[data-field-box="menu_1-item_link"] .wpie-field__title');
        linkText.text('Link');

        // Mapping menu types to the respective field boxes.
        const typeFieldMapping = {
            link: ['menu_1-item_link', 'menu_1-new_tab'],
            share: ['menu_1-item_share'],
            translate: ['menu_1-gtranslate'],
            smoothscroll: ['menu_1-item_link'],
            login: ['menu_1-item_link'],
            logout: ['menu_1-item_link'],
            lostpassword: ['menu_1-item_link'],
            email: ['menu_1-item_link'],
            telephone: ['menu_1-item_link'],
            id: ['menu_1-item_modal'],
            class: ['menu_1-item_modal'],
            text: []  // Empty array here because text case has specific behavior.
        };

        // Customize the link text for certain types
        const linkTextMapping = {
            login: 'Redirect URL',
            logout: 'Redirect URL',
            lostpassword: 'Redirect URL',
            email: 'Email',
            telephone: 'Telephone'
        };

        if (type === 'text')
            parentTab.find('.wpie-tab__type-menu').removeClass('is-hidden');

        else if (typeFieldMapping[type]) {
            const fieldsToShow = typeFieldMapping[type];
            fieldsToShow.forEach(field => {
                parent.find(`[data-field-box="${field}"]`).removeClass('is-hidden');
            });

            if (linkTextMapping[type])
                linkText.text(linkTextMapping[type]);
        }
    }

    function custom_icon() {
        const fieldset = get_parent_fields($(this), '.wpie-fieldset');
        const parent_fields = get_parent_fields($(this));
        const neighborhood = fieldset.find('.wpie-fields').not(parent_fields).find('input[type="checkbox"]');
        const box = get_field_box($(this));
        const fields = parent_fields.find('[data-field-box]').not(box);
        fields.addClass('is-hidden');
        if ($(this).is(':checked')) {
            fields.removeClass('is-hidden');
            $(neighborhood).attr('disabled', 'disabled');
        } else {
            $(neighborhood).removeAttr('disabled');
        }
    }

    // Enable Event Tracking
    function enable_tracking() {
        const fieldset = get_parent_fields($(this), '.wpie-fieldset');
        const tracking_field = fieldset.find('.wpie-event-tracking');
        tracking_field.addClass('is-hidden');
        if ($(this).is(':checked')) {
            tracking_field.removeClass('is-hidden');
        }
    }

    function item_remove() {
        const userConfirmed = confirm("Are you sure you want to remove this element?");
        if (userConfirmed) {
            const parent = $(this).closest('.wpie-item');
            $(parent).remove();
        }
    }

    function item_toggle() {
        const parent = get_parent_fields($(this), '.wpie-item');
        const val = $(parent).attr('open') ? '0' : '1';
        $(parent).find('.wpie-item__toggle').val(val);
    }

    function delete_menu(e) {
        const proceed = confirm("Are you sure want to Delete Menu?");
        if(!proceed) {
            e.preventDefault();
        }
    }

    function get_parent_fields($el, $class = '.wpie-fields') {
        return $el.closest($class);
    }

    function get_field_box($el, $class = '.wpie-field') {
        return $el.closest($class);
    }

    initialize();
});