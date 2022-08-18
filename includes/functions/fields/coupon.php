<?php

if(!function_exists('addonify_floating_cart_coupon_settings')){
    function addonify_floating_cart_coupon_settings(){
        return array(
            'display_applied_coupons' => array(
                'label'			  => __( 'Display applied coupons', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this to display applied coupons.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_option('display_applied_coupons')
            ),
            'cart_apply_coupon_button_label' => array(
                'label'			  => __( 'Cart apply button label', 'addonify-floating-cart' ),
                'description'     => __( 'Label to display on Cart Apply Button.', 'addonify-floating-cart' ),
                'type'            => 'text',
                'placeholder'     => __( 'Apply coupon', 'addonify-floating-cart' ),
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_option('cart_apply_coupon_button_label')
            ),
        );
    }
}

if(!function_exists('addonify_floating_cart_coupon_settings_add')){
    function addonify_floating_cart_coupon_settings_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_coupon_settings());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_coupon_settings_add' );
}