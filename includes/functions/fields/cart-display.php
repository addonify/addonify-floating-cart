<?php

if(!function_exists('addonify_floating_cart_cart_display_settings')){
    function addonify_floating_cart_cart_display_settings(){
        return array(

        );
    }
}

if(!function_exists('addonify_floating_cart_cart_display_settings_add')){
    function addonify_floating_cart_cart_display_settings_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_display_settings());
    }
    apply_filters(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_display_settings_add' );
}