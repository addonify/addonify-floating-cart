<?php

if ( ! function_exists( 'addonify_floating_cart_custom_css_settings_fields' ) ) {

    function addonify_floating_cart_custom_css_settings_fields() {

        return array(
            'custom_css' => array(
                'type'              => 'textarea',
                'className'         => 'custom-css-box fullwidth',
                'inputClassName'    => 'custom-css-textarea',
                'label'             => __( 'Custom CSS', 'addonify-floating-cart' ),
                'description'       => __( 'If required, add your custom CSS code here.', 'addonify-floating-cart' ),
                'placeholder'       => '#app { color: blue; }',
                'dependent'         => array('load_styles_from_plugin'),
                'value'             => addonify_floating_cart_get_option( 'custom_css' )
            )
        );
    }
}


if ( ! function_exists( 'addonify_floating_cart_custom_css_add_to_settings_fields' ) ) {

    function addonify_floating_cart_custom_css_add_to_settings_fields( $settings_fields ) {

        return array_merge( $settings_fields, addonify_compare_products_custom_css_settings_fields() );
    }
    
    add_filter( 'addonify_floating_cart/settings_fields', 'addonify_floating_cart_custom_css_add_to_settings_fields' );
}