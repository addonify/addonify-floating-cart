<?php

if(!function_exists('addonify_floating_cart_cart_options_settings')){
    function addonify_floating_cart_cart_options_settings(){
        return array(
            'enable_floating_cart' => array(
                'label'			  => __( 'Enable floating cart', 'addonify-floating-cart' ),
                'description'     => __( 'Once enabled, floating cart will be displayed on the front-end.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array(),
                'value'           => addonify_floating_cart_get_setting_field_value('enable_floating_cart')
            ),
            'open_cart_modal_immediately_after_add_to_cart' => array(
                'label'			  => __( 'Open floating cart after adding item to cart', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this option to immediately toggle floating cart when an item is added to cart.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'open_cart_modal_immediately_after_add_to_cart' )
            ),
            'open_cart_modal_after_click_on_view_cart' => array(
                'label'			  => __( 'Open floating cart on click on view cart', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this to enable opening the floating cart when view cart button is clicked.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'open_cart_modal_after_click_on_view_cart' )
            ),
        );
    }
}

if(!function_exists('addonify_floating_cart_cart_options_add_to_settings_field')){
    function addonify_floating_cart_cart_options_add_to_settings_field($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_options_settings());
    }
    apply_filters( 'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_options_add_to_settings_field' );
}


