<?php

if(!function_exists('addonify_floating_cart_toggle_cart_button_settings')){
    function addonify_floating_cart_toggle_cart_button_settings(){
        return array(
            'display_cart_modal_toggle_button' => array(
                'label'			  => __( 'Display Toggle-Cart Button', 'addonify-floating-cart' ),
                'description'     => 'Enable this to enable the show toggle-cart button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
            'display_cart_items_number_badge' => array(
                'label'			  => __( 'Number of Items Badge', 'addonify-floating-cart' ),
                'description'     => 'Enable this to display number of items in cart on toggle button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_items_number_badge')
            ),

        );
    }
}

if(!function_exists('addonify_floating_cart_toggle_cart_button_settings_add')){
    function addonify_floating_cart_toggle_cart_button_settings_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_toggle_cart_button_settings());
    }
    apply_filters(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toggle_cart_button_settings_add' );
}