<?php

if(!function_exists('addonify_floating_cart_coupon_settings')){
    function addonify_floating_cart_coupon_settings(){
        return array(
            'display_cart_coupon_section' => array(
                'label'			  => __( 'Display Cart Coupon Section', 'addonify-floating-cart' ),
                'description'     => 'Enable this to display coupon section.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_coupon_section')
            ),
            'display_available_coupons' => array(
                'label'			  => __( 'Display Available Coupons', 'addonify-floating-cart' ),
                'description'     => 'Enable this to display available coupons.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_cart_coupon_section'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_available_coupons')
            ),
            'display_applied_coupons' => array(
                'label'			  => __( 'Display Applied Coupons', 'addonify-floating-cart' ),
                'description'     => 'Enable this to display applied coupons.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_cart_coupon_section'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_applied_coupons')
            ),
            'cart_apply_coupon_button_label' => array(
                'label'			  => __( 'Cart Apply Button Label', 'addonify-floating-cart' ),
                'description'     => 'Label to display on Cart Apply Button.',
                'type'            => 'text',
                'badge'           => 'Optional',
                'badgeType'       => '',
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