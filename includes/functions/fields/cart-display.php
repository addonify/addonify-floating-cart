<?php

if(!function_exists('addonify_floating_cart_cart_display_settings')){
    function addonify_floating_cart_cart_display_settings(){
        return array(
            'cart_title' => array(
                'label'			  => __( 'Cart Title', 'addonify-floating-cart' ),
                'description'     => 'Title of floating cart displayed at top.',
                'type'            => 'text',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
            'display_cart_items_number' => array(
                'label'			  => __( 'Display Cart Items Count', 'addonify-floating-cart' ),
                'description'     => 'Cart Items Count displayed at top.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
            'close_cart_modal_on_overlay_click' => array(
                'label'			  => __( 'Close cart on overlay click', 'addonify-floating-cart' ),
                'description'     => 'Close cart on overlay click.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
            'display_continue_shopping_button' => array(
                'label'			  => __( 'Display Continue Shopping Button', 'addonify-floating-cart' ),
                'description'     => 'Check if continue shopping button should be displayed.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
            'continue_shopping_button_label' => array(
                'label'			  => __( 'Continue Shopping Button Label', 'addonify-floating-cart' ),
                'description'     => 'Label for Continue Shopping button.',
                'type'            => 'text',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('display_continue_shopping_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
            'checkout_button_label' => array(
                'label'			  => __( 'Checkout Button Label', 'addonify-floating-cart' ),
                'description'     => 'Label of checkout button.',
                'type'            => 'text',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
        );
    }
}

if(!function_exists('addonify_floating_cart_cart_display_settings_add')){
    function addonify_floating_cart_cart_display_settings_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_display_settings());
    }
    apply_filters(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_display_settings_add' );
}