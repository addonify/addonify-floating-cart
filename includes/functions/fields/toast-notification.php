<?php

if(!function_exists('addonify_floating_cart_toast_notification_settings')){
    function addonify_floating_cart_toast_notification_settings(){
        return array(
            'display_toast_notification' => array(
                'label'			  => __( 'Display toast notification', 'addonify-floating-cart' ),
                'description'     => __( 'Enable this to enable added-to-cart notification.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_toast_notification')
            ),
            'toast_notification_display_position' => array(
                'label'			  => __( 'Notification Display Position', 'addonify-floating-cart' ),
                'description'     => '.',
                'type'            => 'select',
                'choices' => array(
                    'top-right'       => __( 'Top Right', 'addonify-floating-cart' ),
                    'bottom-right'    => __( 'Bottom Right', 'addonify-floating-cart' ),
                    'top-left'        => __( 'Top Left', 'addonify-floating-cart' ),
                    'bottom-left'     => __( 'Bottom Left', 'addonify-floating-cart' ),
                ),
                'dependent'       => array('display_toast_notification','enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_display_position')
            ),
            'open_cart_modal_on_notification_button_click' => array(
                'label'			  => __( 'Open floating cart notification button', 'addonify-floating-cart' ),
                'description'     => __( 'Enables opening floating cart by clicking on notification button.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('display_toast_notification','enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('open_cart_modal_on_notification_button_click')
            ),
            'display_product_name_in_notification' => array(
                'label'			  => __( 'Display Product name in Notification', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('display_toast_notification','enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_product_name_in_notification')
            ),
            'added_to_cart_notification_text' => array(
                'label'			  => __( 'Added to cart text', 'addonify-floating-cart' ),
                'description'     => __( 'Text shown after item is added to cart.', 'addonify-floating-cart' ),
                'type'            => 'text',
                'placeholder'     => __( 'Added to cart', 'addonify-floating-cart' ),
                'dependent'       => array('display_toast_notification','enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('added_to_cart_notification_text')
            ),
            'close_notification_after_time' => array(
                'label'			  => __( 'Close toast notification after "x" seconds', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'min'             => 1,
                'max'             => 120,
                'dependent'       => array('display_toast_notification','enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('close_notification_after_time')
            ),
            'display_close_notification_button' => array(
                'label'			  => __( 'Display toast notification close button', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('display_toast_notification','enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_close_notification_button')
            ),
            'display_show_cart_button' => array(
                'label'			  => __( 'Display show cart button in toast notification', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('display_toast_notification','enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_show_cart_button')
            ),
            'show_cart_button_label' => array(
                'label'			  => __( 'Label for Show cart button in notification ', 'addonify-floating-cart' ),
                'type'            => 'text',
                'dependent'       => array('display_toast_notification','enable_floating_cart','display_show_cart_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('show_cart_button_label')
            ),
        );
    }
}

if(!function_exists('addonify_floating_cart_toast_notification_settings_add_to_settings')){

    function addonify_floating_cart_toast_notification_settings_add_to_settings($settings){
        return array_merge($settings, addonify_floating_cart_toast_notification_settings());
    }

    add_filter( 'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toast_notification_settings_add_to_settings');

}


if(!function_exists('addonify_floating_cart_toast_notification_designs')){
    function addonify_floating_cart_toast_notification_designs(){
        return array(
            'toast_notification_background_color' => array(
                'label'			  => __( 'Notification Background Color', 'addonify-floating-cart' ),
                'description'     => 'For Changing the notification background color.',
                'type'            => 'color',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_background_color')
            ),
            'toast_notification_text_color' => array(
                'label'			  => __( 'Notification Text Color', 'addonify-floating-cart' ),
                'description'     => 'For Changing the notification text color.',
                'type'            => 'color',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_text_color')
            ),
            'toast_notification_button_background_color' => array(
                'label'			  => __( 'Notification Button Background Color', 'addonify-floating-cart' ),
                'description'     => 'For Changing the notification\'s button background color.',
                'type'            => 'color',
                'dependent'       => array('display_close_notification_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_button_background_color')
            ),
            'toast_notification_button_label_color' => array(
                'label'			  => __( 'Notification Button Label Color', 'addonify-floating-cart' ),
                'description'     => 'For Changing the notification\'s button label color.',
                'type'            => 'color',
                'dependent'       => array('display_close_notification_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_button_label_color')
            ),
            'toast_notification_button_on_hover_label_color' => array(
                'label'			  => __( 'Notification Button Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'For Changing the notification button\'s color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_close_notification_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_button_on_hover_label_color')
            ),
            'toast_notification_button_on_hover_background_color' => array(
                'label'			  => __( 'Notification Button Background Color on Hover', 'addonify-floating-cart' ),
                'description'     => '.',
                'type'            => 'color',
                'dependent'       => array('display_close_notification_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_button_on_hover_background_color')
            ),
            'toast_notification_side_offset' => array(
                'label'			  => __( 'Notification Side Offset', 'addonify-floating-cart' ),
                'description'     => 'For changing notification left-right offset.',
                'type'            => 'number',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_side_offset')
            ),
            'toast_notification_top_bottom_offset' => array(
                'label'			  => __( 'Notification Top-Bottom Offset', 'addonify-floating-cart' ),
                'description'     => 'For changing notification top-bottom offset.',
                'type'            => 'number',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('toast_notification_top_bottom_offset')
            ),
        );
    }
}


if(!function_exists('addonify_floating_cart_toast_notification_designs_add')){
    function addonify_floating_cart_toast_notification_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_toast_notification_designs());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toast_notification_designs_add' );
}