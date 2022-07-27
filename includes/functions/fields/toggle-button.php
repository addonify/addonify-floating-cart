<?php

if(!function_exists('addonify_floating_cart_toggle_cart_button_settings')){
    function addonify_floating_cart_toggle_cart_button_settings(){
        return array(
            'display_cart_modal_toggle_button' => array(
                'label'			  => __( 'Display Toggle-Cart Button', 'addonify-floating-cart' ),
                'description'     => 'Enable this to enable the show toggle-cart button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')
            ),
            'display_cart_items_number_badge' => array(
                'label'			  => __( 'Number of Items Badge', 'addonify-floating-cart' ),
                'description'     => 'Enable this to display number of items in cart on toggle button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_items_number_badge')
            ),

        );
    }
}

if(!function_exists('addonify_floating_cart_toggle_cart_button_settings_add')){
    function addonify_floating_cart_toggle_cart_button_settings_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_toggle_cart_button_settings());
    }
    apply_filters(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toggle_cart_button_settings_add' );
}


if(!function_exists('addonify_floating_cart_toggle_cart_button_designs')){
    function addonify_floating_cart_toggle_cart_button_designs(){
        return array(
            'cart_modal_toggle_button_display_position' => array(
                'label'			  => __( 'Button Display Position', 'addonify-floating-cart' ),
                'description'     => 'Display Position of toggle acrt button on screen.',
                'type'            => 'select',
                'choices' => array(
                    'top-right'     => __( 'Top Right', 'addonify-floating-cart' ),
                    'bottom-right'    => __( 'Bottom Right', 'addonify-floating-cart' ),
                    'top-left'     => __( 'Top Left', 'addonify-floating-cart' ),
                    'bottom-left'    => __( 'Bottom Left', 'addonify-floating-cart' ),
                ),
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_toggle_button_display_position')
            ),
            'cart_items_number_badge_position' => array(
                'label'			  => __( 'Item\'s number Batch position', 'addonify-floating-cart' ),
                'description'     => 'Item\'s number Batch position on the cart-toggle button.',
                'type'            => 'select',
                'choices' => array(
                    'top-right'     => __( 'Top Right', 'addonify-floating-cart' ),
                    'bottom-right'    => __( 'Bottom Right', 'addonify-floating-cart' ),
                    'top-left'     => __( 'Top Left', 'addonify-floating-cart' ),
                    'bottom-left'    => __( 'Bottom Left', 'addonify-floating-cart' ),
                ),
                'dependent'       => array('display_cart_items_number_badge'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_items_number_badge_position')
            ),
            'toggle_button_badge_background_color' => array(
                'label'			  => __( 'Button background color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button background color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_items_number_badge'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_badge_background_color')
            ),
            'toggle_button_label_color' => array(
                'label'			  => __( 'Button label color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button label color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_label_color')
            ),
            'toggle_button_badge_label_color' => array(
                'label'			  => __( 'Button badge label color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button badge label color.',
                'type'            => '',
                'dependent'       => array('display_cart_items_number_badge'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_badge_label_color')
            ),
            'toggle_button_background_color' => array(
                'label'			  => __( 'Button Background Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button background color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_background_color')
            ),
            'toggle_button_border_color' => array(
                'label'			  => __( 'Button Border Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button border color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_border_color')
            ),
            'toggle_button_on_hover_label_color' => array(
                'label'			  => __( 'Button Label Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button label color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_on_hover_label_color')
            ),
            'toggle_button_on_hover_background_color' => array(
                'label'			  => __( 'Button Background Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button background color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_on_hover_background_color')
            ),
            'toggle_button_on_hover_border_color' => array(
                'label'			  => __( 'Button Border Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button border color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toggle_button_on_hover_border_color')
            ),
            'cart_modal_toggle_button_padding' => array(
                'label'			  => __( 'Button Padding', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button padding.',
                'type'            => 'number',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_toggle_button_padding')
            ),
            'cart_modal_toggle_button_side_offset' => array(
                'label'			  => __( 'Button Side Offset', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button side offset.',
                'type'            => 'number',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_toggle_button_side_offset')
            ),
            'cart_modal_toggle_button_vertical_offset' => array(
                'label'			  => __( 'Button Vertical Offset', 'addonify-floating-cart' ),
                'description'     => 'Change this to change toggle-button vertical offset.',
                'type'            => 'number',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_toggle_button_vertical_offset')
            ),
        );
    }
}

if(!function_exists('addonify_floating_cart_toggle_cart_button_designs_add')){
    function addonify_floating_cart_toggle_cart_button_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_toggle_cart_button_designs());
    }
    apply_filters(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toggle_cart_button_designs_add' );
}