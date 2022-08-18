<?php

if(!function_exists('addonify_floating_cart_toggle_cart_button_settings')){
    function addonify_floating_cart_toggle_cart_button_settings(){
        return array(
            'cart_modal_toggle_button_display_position' => array(
                'label'			  => __( 'Button Display Position', 'addonify-floating-cart' ),
                'description'     => __( 'Display Position of toggle acrt button on screen.', 'addonify-floating-cart' ),
                'type'            => 'select',
                'choices' => array(
                    'top-right'         => __( 'Top Right', 'addonify-floating-cart' ),
                    'bottom-right'      => __( 'Bottom Right', 'addonify-floating-cart' ),
                    'top-left'          => __( 'Top Left', 'addonify-floating-cart' ),
                    'bottom-left'       => __( 'Bottom Left', 'addonify-floating-cart' ),
                ),
                'dependent'       => array('enable_floating_cart', 'display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('cart_modal_toggle_button_display_position')
            ),
            'cart_items_number_badge_position' => array(
                'label'			  => __( 'Item &apos; s number Batch position', 'addonify-floating-cart' ),
                'description'     => __( 'Item &apos; s number Batch position on the cart-toggle button.', 'addonify-foating-cart' ),
                'type'            => 'select',
                'choices' => array(
                    'top-right'       => __( 'Top Right', 'addonify-floating-cart' ),
                    'bottom-right'    => __( 'Bottom Right', 'addonify-floating-cart' ),
                    'top-left'        => __( 'Top Left', 'addonify-floating-cart' ),
                    'bottom-left'     => __( 'Bottom Left', 'addonify-floating-cart' ),
                ),
                'dependent'       => array('enable_floating_cart', 'display_cart_items_number_badge'),
                'value'           => addonify_floating_cart_get_option('cart_items_number_badge_position')
            ),
            'display_cart_modal_toggle_button' => array(
                'label'			  => __( 'Display toggle cart button', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this option to display the floating cart toggle button.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_option('display_cart_modal_toggle_button')
            ),
            'display_cart_items_number_badge' => array(
                'label'			  => __( 'Number of items badge', 'addonify-floating-cart' ),
                'description'     => __( 'Display number of items on cart badge in toggle button', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart', 'display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('display_cart_items_number_badge')
            ),

        );
    }
}

if(!function_exists('addonify_floating_cart_toggle_cart_button_settings_add')){
    function addonify_floating_cart_toggle_cart_button_settings_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_toggle_cart_button_settings());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toggle_cart_button_settings_add' );
}


if(!function_exists('addonify_floating_cart_toggle_cart_button_designs')){
    function addonify_floating_cart_toggle_cart_button_designs(){
        return array(
            'toggle_button_badge_width' => array(
                'label'			  => __( 'Badge Width', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right', // right or remove this prop.  
                'min'             => 40,
                'max'             => 200,
                'step'            => 5,
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('toggle_button_badge_width')
            ),
            'toggle_button_badge_font_size' => array(
                'label'			  => __( 'Badge font size', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right',
                'min'             => 13,
                'max'             => 20,
                'value'           => addonify_floating_cart_get_option('toggle_button_badge_font_size')
            ),
            'toggle_button_badge_background_color' => array(
                'label'			  => __( 'Item count badge background color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_items_number_badge'),
                'value'           => addonify_floating_cart_get_option('toggle_button_badge_background_color')
            ),
            'toggle_button_badge_label_color' => array(
                'label'			  => __( 'Item count badge label color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_items_number_badge'),
                'value'           => addonify_floating_cart_get_option('toggle_button_badge_label_color')
            ),
             'toggle_button_label_color' => array(
                'label'			  => __( 'Button label/icon color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('toggle_button_label_color')
            ),
            'toggle_button_background_color' => array(
                'label'			  => __( 'Button background color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('toggle_button_background_color')
            ),
            'toggle_button_border_color' => array(
                'label'			  => __( 'Button border color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('toggle_button_border_color')
            ),
            'toggle_button_on_hover_label_color' => array(
                'label'			  => __( 'Button label color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('toggle_button_on_hover_label_color')
            ),
            'toggle_button_on_hover_background_color' => array(
                'label'			  => __( 'Button background color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('toggle_button_on_hover_background_color')
            ),
            'toggle_button_on_hover_border_color' => array(
                'label'			  => __( 'Button border color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('toggle_button_on_hover_border_color')
            ),
            'cart_modal_toggle_button_width' => array(
                'label'			  => __( 'Button size', 'addonify-floating-cart' ),
                'description'     => __( 'Min 40 & max 200 px', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right', // right or remove this prop.  
                'min'             => 40,
                'max'             => 200,
                'step'            => 5,
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('cart_modal_toggle_button_width')
            ),
            'cart_modal_toggle_button_border_radius' => array(
                'label'			  => __( 'Border radius', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right',
                'min'             => 0,
                'max'             => 60,
                'value'           => addonify_floating_cart_get_option('cart_modal_toggle_button_border_radius')
            ),
            'cart_modal_toggle_button_icon_font_size' => array(
                'label'			  => __( 'Button cart icon font size', 'addonify-floating-cart' ),
                'description'     => __( 'Min 14 & max 80 px', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right', // right or remove this prop.  
                'min'             => 14,
                'max'             => 80,
                'step'            => 2,
                'dependent'       => array('cart_modal_toggle_button_icon_font_size'),
                'value'           => addonify_floating_cart_get_option('cart_modal_toggle_button_width')
            ),
            'cart_modal_toggle_button_horizontal_offset' => array(
                'label'			  => __( 'Button horizontal offset', 'addonify-floating-cart' ),
                'description'     => __( 'Horizontal offset from left or right side of the screen. Value applied in px.', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right', // right or remove this prop.  
                'min'             => -500,
                'max'             => 500,
                'step'            => 10,
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('cart_modal_toggle_button_horizontal_offset')
            ),
            'cart_modal_toggle_button_vertical_offset' => array(
                'label'			  => __( 'Button vertical offset', 'addonify-floating-cart' ),
                'description'     => __( 'Vertical offset from top or bottom of the screen. Value applied in px.', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right', // right or remove this prop.  
                'min'             => -500,
                'max'             => 500,
                'step'            => 10,
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_option('cart_modal_toggle_button_vertical_offset')
            ),
        );
    }
}

if(!function_exists('addonify_floating_cart_toggle_cart_button_designs_add')){
    function addonify_floating_cart_toggle_cart_button_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_toggle_cart_button_designs());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toggle_cart_button_designs_add' );
}