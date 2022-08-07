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
                'label'			  => __( 'Open floating cart once product is added to cart', 'addonify-floating-cart' ),
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
            'display_floating_cart_in_checkout_and_cart_page' => array(
                'label'			  => __( 'Dispay floating cart in checkout and cart page', 'addonify-floating-cart' ),
                'description'     => '',
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'display_floating_cart_in_checkout_and_cart_page' )
            ),
            'enable_shopping_meter' => array(
                'label'			  => __( 'Enable shopping meter threshold', 'addonify-floating-cart' ),
                'description'     => __( '', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'enable_shopping_meter' )
            ),
            'customer_shopping_meter_threshold' => array(
                'label'			  => __( 'Customer shopping meter threshold', 'addonify-floating-cart' ),
                'description'     => __( 'Cart total after which certain discount/freebies are applied.', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'min'             => 0,
                'dependent'       => array('enable_floating_cart','enable_shopping_meter'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'customer_shopping_meter_threshold' )
            ),
            'customer_shopping_meter_pre_threshold_label' => array(
                'label'			  => __( 'Label for Cart items does not meet threshold', 'addonify-floating-cart' ),
                'description'     => '',
                'type'            => 'text',
                'dependent'       => array('enable_floating_cart','enable_shopping_meter'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'customer_shopping_meter_pre_threshold_label' )
            ),
            'customer_shopping_meter_post_threshold_label' => array(
                'label'			  => __( 'Label for Cart items meets threshold', 'addonify-floating-cart' ),
                'description'     => __( '', 'addonify-floating-cart' ),
                'type'            => 'text',
                'dependent'       => array('enable_floating_cart','enable_shopping_meter'),
                'value'           => addonify_floating_cart_get_setting_field_value( 'customer_shopping_meter_post_threshold_label' )
            ),
        );
    }
}

if(!function_exists('addonify_floating_cart_cart_options_add_to_settings_field')){
    function addonify_floating_cart_cart_options_add_to_settings_field($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_options_settings());
    }
    add_filter( 'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_options_add_to_settings_field' );
}


if ( ! function_exists( 'addonify_floating_cart_cart_styles_settings_fields' ) ) {

    function addonify_floating_cart_cart_styles_settings_fields() {

        return array(
            'load_styles_from_plugin' => array(
                'type'              => 'switch',
                'className'         => '',
                'label'             => __( 'Enable Styles from Plugin', 'addonify-floating-cart' ),
                'description'       => __( 'Enable to apply styles and colors from the plugin.', 'addonify-floating-cart' ),
                'value'             => addonify_floating_cart_get_setting_field_value( 'load_styles_from_plugin' )
            )
        );
    }
}

if ( ! function_exists( 'addonify_floating_cart_general_styles_add_to_settings_fields' ) ) {

    function addonify_floating_cart_general_styles_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_floating_cart_cart_styles_settings_fields() );
    }
    
    add_filter( 'addonify_floating_cart/settings_fields', 'addonify_floating_cart_general_styles_add_to_settings_fields' );
}