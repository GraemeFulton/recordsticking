(function ($) {
    $(document).ready(function () {

        $(document).on('change', '.berocket_aapf_widget_admin_attribute_select', function () {
            if ($(this).val() == 'price') {
                $('.berocket_aapf_widget_admin_type_select').html('<option value="slider">Slider</option>');
                $('.berocket_aapf_widget_admin_operator_select').parent().parent().hide(0);
            } else {
                $('.berocket_aapf_widget_admin_type_select').html('<option value="checkbox">Checkbox</option><option value="radio">Radio</option><option value="select">Select</option><option value="slider">Slider</option>');
                $('.berocket_aapf_widget_admin_operator_select').parent().parent().show(0);
            }
        });

        $(document).on('click', '.berocket_aapf_advanced_settings_pointer', function (event) {
            event.preventDefault();
            $(this).parent().next().slideDown(300);
            $(this).parent().slideUp(200);
        });
    });
})(jQuery);