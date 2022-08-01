<?php

if(!function_exists('addonify_floating_cart_coupon_settings')){
    function addonify_floating_cart_coupon_settings(){
        return array(
            'display_cart_coupon_section' => array(),
            'display_available_coupons' => array(),
            'display_applied_coupons' => array(),
            'cart_apply_coupon_button_label' => array(),
        );
    }
}


if(!function_exists('addonify_floating_cart_coupon_designs')){
    function addonify_floating_cart_coupon_designs(){
        return array(
            'cart_apply_coupon_button_background_color' => array(),
            'cart_apply_coupon_button_background_color_on_hover' => array(),
        );
    }
}