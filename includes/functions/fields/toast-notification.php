<?php

if(!function_exists('addonify_floating_cart_toast_notification_settings')){
    function addonify_floating_cart_toast_notification_settings(){
        return array(
            'display_toast_notification' => array(
                'label'			  => __( 'Display Toast notification', 'addonify-floating-cart' ),
                'description'     => 'Enable this to enable the show toast notification.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_toast_notification')
            ),
            'open_cart_modal_on_notification_button_click' => array(
                'label'			  => __( 'Open floating cart notification button', 'addonify-floating-cart' ),
                'description'     => 'Enables opening floating cart by clicking on notification button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('open_cart_modal_on_notification_button_click')
            ),
            'add_to_cart_notification_text' => array(
                'label'			  => __( 'Added to cart text', 'addonify-floating-cart' ),
                'description'     => 'Text shown after item is added to cart.',
                'type'            => 'text',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('add_to_cart_notification_text')
            ),
            'close_notification_after_time' => array(
                'label'			  => __( 'Close notification after(secs)', 'addonify-floating-cart' ),
                'description'     => 'Input seconds after which toast notification closes.(defaults 3secs)',
                'type'            => 'number',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('close_notification_after_time')
            ),
            'display_close_notification_button' => array(
                'label'			  => __( 'Display toast notification close button', 'addonify-floating-cart' ),
                'description'     => 'Enable this to display number of items in cart on toggle button.',
                'type'            => 'switch',
                'badge'           => 'Optional',
                'badgeType'       => '',
                'dependent'       => array('display_toast_notification'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_close_notification_button')
            ),

        );
    }
}

if(!function_exists('addonify_floating_cart_toast_notification_settings_add_to_settings')){

    function addonify_floating_cart_toast_notification_settings_add_to_settings($settings){
        return array_merge($settings, addonify_floating_cart_toast_notification_settings());
    }

    apply_filters( 'addonify_floating_cart/settings_fields', 'addonify_floating_cart_toast_notification_settings_add_to_settings');

}