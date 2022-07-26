<?php

if(!function_exists('addonify_floating_cart_cart_options_settings')){
    function addonify_floating_cart_cart_options_settings(){
        return array(
            'enable_floating_cart' => array(
                'label'			  => __( 'Enable Floating Cart', 'addonify-floating-cart' ),
                'description'     => 'Enable this to enable the floating cart in frontend.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array(),
                'value'           => addonify_floating_cart_get_setting_field_value('enable_floating_cart')
            ),
            'open_cart_modal_immediately_after_add_to_cart' => array(
                'label'			  => __( 'Open Floating Cart After Adding Item to Cart', 'addonify-floating-cart' ),
                'description'     => 'Enable this to enable immediately opening floating cart when an item is added to cart.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'open_cart_modal_immediately_after_add_to_cart' )
            ),
            'open_cart_modal_after_click_on_view_cart' => array(
                'label'			  => __( 'Open Floating Cart On click on View Cart', 'addonify-floating-cart' ),
                'description'     => 'Enable this to enable opening the floating cart when view cart button is clicked.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
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


