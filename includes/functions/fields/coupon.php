<?php

if(!function_exists('addonify_floating_cart_coupon_settings')){
    function addonify_floating_cart_coupon_settings(){
        return array(
            'display_cart_coupon_section' => array(
                'label'			  => __( 'Display cart coupon section', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this to display coupon section.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_coupon_section')
            ),
            'display_available_coupons' => array(
                'label'			  => __( 'Display available coupons', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this to display available coupons.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('display_cart_coupon_section'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_available_coupons')
            ),
            'display_applied_coupons' => array(
                'label'			  => __( 'Display applied coupons', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this to display applied coupons.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('display_cart_coupon_section'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_applied_coupons')
            ),
            'cart_apply_coupon_button_label' => array(
                'label'			  => __( 'Cart apply button label', 'addonify-floating-cart' ),
                'description'     => __( 'Label to display on Cart Apply Button.', 'addonify-floating-cart' ),
                'type'            => 'text',
                'placeholder'     => __( 'Apply coupon', 'addonify-floating-cart' ),
                'dependent'       => array('display_cart_coupon_section'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_apply_coupon_button_label')
            ),
        );
    }
}


if(!function_exists('addonify_floating_cart_coupon_designs')){
    function addonify_floating_cart_coupon_designs(){
        return array(
            'cart_apply_coupon_button_background_color' => array(
                'label'			  => __( 'Apply Coupon Button Background Color', 'addonify-floating-cart' ),
                'description'     => 'For Changing the Apply Coupon Button background color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_coupon_section'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_background_color')
            ),
            'cart_apply_coupon_button_background_color_on_hover' => array(
                'label'			  => __( 'Apply Coupon Button Background Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'For Changing the Apply Coupon Button background color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_coupon_section'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_background_color')
            ),
        );
    }
}