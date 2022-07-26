<?php

if(!function_exists('addonify_add_floating_cart_toggle_cart_button_settings')){
    function addonify_add_floating_cart_toggle_cart_button_settings(){
        return array(
            'display_cart_modal_toggle_button' => array(
                'label'			  => __( 'Display Toggle-Cart Button', 'addonify-floating-cart' ),
                'description'     => 'Enable this to enable the show toggle-cart button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
            ),
            'display_cart_items_number_badge' => array(
                'label'			  => __( 'Display cart Items Number Badge on Toggle Button', 'addonify-floating-cart' ),
                'description'     => 'Enable this to display number of items in cart on toggle button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
            ),

        );
    }
}