<?php

if(!function_exists('addonify_floating_cart_cart_display_settings')){
    function addonify_floating_cart_cart_display_settings(){
        return array(
            // 'cart_modal_display_layout' => array(
            //     'label'			  => __( 'Floating cart layout', 'addonify-floating-cart' ),
            //     'type'            => 'select',
            //     'choices' => array(
            //         'layout-1'     => __( 'Layout 1', 'addonify-floating-cart' ),
            //         'layout-2'     => __( 'Layout 2', 'addonify-floating-cart' ),
            //         'layout-3'     => __( 'Layout 3', 'addonify-floating-cart' ),
            //     ),
            //     'dependent'       => array('enable_floating_cart'),
            //     'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_display_layout')
            // ),
            'cart_title' => array(
                'label'			  => __( 'Cart title', 'addonify-floating-cart' ),
                'description'     => 'Displayed inside cart header.',
                'type'            => 'text',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_title')
            ),
            'display_cart_items_number' => array(
                'label'			  => __( 'Display cart items count', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_items_number')
            ),
            'close_cart_modal_on_overlay_click' => array(
                'label'			  => __( 'Close cart on overlay click', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('close_cart_modal_on_overlay_click')
            ),
            'display_continue_shopping_button' => array(
                'label'			  => __( 'Display continue shopping button', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_continue_shopping_button')
            ),
            'continue_shopping_button_label' => array(
                'label'			  => __( 'Continue shopping button label', 'addonify-floating-cart' ),
                'type'            => 'text',
                'placeholder'     => 'Continue shopping',
                'dependent'       => array('display_continue_shopping_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('continue_shopping_button_label')
            ),
            'checkout_button_label' => array(
                'label'			  => __( 'Checkout button label', 'addonify-floating-cart' ),
                'type'            => 'text',
                'placeholder'     => 'Checkout',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('checkout_button_label')
            ),
            'display_product_removed_from_cart' => array(
                'label'			  => __( 'Display product removed from cart.', 'addonify-floating-cart' ),
                'type'            => 'switch',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_product_removed_from_cart')
            ),
        );
    }
}
if(!function_exists('addonify_floating_cart_cart_display_settings_add')){
    function addonify_floating_cart_cart_display_settings_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_display_settings());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_display_settings_add' );
}


if(!function_exists('addonify_floating_cart_cart_display_designs')){
    function addonify_floating_cart_cart_display_designs(){
        return array(
            //cart general
            'cart_modal_width' => array(
                'label'			  => __( 'Cart width in px', 'addonify-floating-cart' ),
                'description'     => 'Set the width of floating cart in px.',
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'controlPosition' => 'right',
                'min'             => 400,
                'max'             => 800,
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_width')
            ),
            'cart_modal_background_color' => array(
                'label'			  => __( 'Cart background color', 'addonify-floating-cart' ),
                'description'     => __( 'Main cart container background color.', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_background_color')
            ),
            'cart_modal_overlay_color' => array(
                'label'			  => __( 'Cart overlay background color', 'addonify-floating-cart' ),
                'description'     => __('Overlay mask background color.', 'addonify-floating-cart'),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_overlay_color')
            ),
            'cart_modal_border_color' => array(
                'label'			  => __( 'General border color inside cart', 'addonify-floating-cart' ),
                'description'     => __( 'General border color for all borders.', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_border_color')
            ),
            'cart_modal_base_text_color' => array(
                'label'			  => __( 'General text color inside cart', 'addonify-floating-cart' ),
                'description'     => __( 'General text color for texts inside cart.', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_base_text_color')
            ),
            'cart_modal_content_link_color' => array(
                'label'			  => __( 'General link color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_link_color')
            ),
            'cart_modal_content_link_on_hover_color' => array(
                'label'			  => __( 'General link color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_link_on_hover_color')
            ),
            'cart_modal_title_color' => array(
                'label'			  => __( 'Cart title color', 'addonify-floating-cart' ),
                'description'     => __( 'Main cart title inside cart.', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_title_color')
            ),
            'cart_modal_badge_text_color' => array(
                'label'			  => __( 'Item count badge inside cart label color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_badge_text_color')
            ),
            'cart_modal_badge_background_color' => array(
                'label'			  => __( 'Item count badge inside cart background color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_badge_background_color')
            ),
            'cart_modal_close_icon_color' => array(
                'label'			  => __( 'Close cart icon color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_close_icon_color')
            ),
            'cart_modal_close_icon_on_hover_color' => array(
                'label'			  => __( 'Close cart icon color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_close_icon_on_hover_color')
            ),
        );
    }
}
if(!function_exists('addonify_floating_cart_cart_display_designs_add')){
    function addonify_floating_cart_cart_display_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_display_designs());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_display_designs_add' );
}


if(!function_exists('addonify_floating_cart_cart_misc_display_designs')){
    function addonify_floating_cart_cart_misc_display_designs(){
        return array(

            // Misc options
            'cart_modal_input_field_placeholder_color' => array(
                'label'			  => __( 'Input field placeholder color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_placeholder_color')
            ),
            'cart_modal_input_field_text_color' => array(
                'label'			  => __( 'Input field text color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_text_color')
            ),
            'cart_modal_input_field_border_color' => array(
                'label'			  => __( 'Input field border color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_border_color')
            ),
            'cart_modal_input_field_background_color' => array(
                'label'			  => __( 'Input field background color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_background_color')
            ),
            'cart_shopping_meter_initial_background_color' => array(
                'label'			  => __( 'Shopping meter initial background color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_shopping_meter_initial_background_color')
            ),
            'cart_shopping_meter_progress_background_color' => array(
                'label'			  => __( 'Shopping meter progress background color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_shopping_meter_progress_background_color')
            ),
        );
    }
}
if(!function_exists('addonify_floating_cart_cart_misc_display_designs_add')){
    function addonify_floating_cart_cart_misc_display_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_misc_display_designs());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_misc_display_designs_add' );
}


if(!function_exists('addonify_floating_cart_cart_products_display_designs')){
    function addonify_floating_cart_cart_products_display_designs(){
        return array(
            
            // Products
            'cart_modal_product_title_color' => array(
                'label'			  => __( 'Product title color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_color')
            ),
            'cart_modal_product_title_on_hover_color' => array(
                'label'			  => __( 'Product title color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_on_hover_color')
            ),
            'cart_modal_product_title_font_size' => array(
                'label'			  => __( 'Product title font size in px', 'addonify-floating-cart' ),
                'type'            => 'number',
                'typeStyle'       => 'toggle',
                'min'             => 13,
                'max'             => 22,
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_font_size')
            ),
            'cart_modal_product_title_font_weight' => array(
                'label'			  => __( 'Product title font weight', 'addonify-floating-cart' ),
                'type'            => 'select',
                'choices' => array(
                    '400'             => __( 'Normal', 'addonify-floating-cart' ),
                    '500'             => __( 'Medium', 'addonify-floating-cart' ),
                    '600'             => __( 'Semi bold', 'addonify-floating-cart' ),
                    '700'             => __( 'Bold', 'addonify-floating-cart' ),
                ),
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_font_weight')
            ),
            'cart_modal_product_quantity_price_color' => array(
                'label'			  => __( 'Product quantity & price color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_quantity_price_color')
            ),
            'cart_modal_product_remove_button_background_color' => array(
                'label'			  => __( 'Remove product button background color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_background_color')
            ),
            'cart_modal_product_remove_button_icon_color' => array(
                'label'			  => __( 'Remove product button icon color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_icon_color')
            ),
            'cart_modal_product_remove_button_on_hover_background_color' => array(
                'label'			  => __( 'Remove product button background color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_on_hover_background_color')
            ),
            'cart_modal_product_remove_button_on_hover_icon_color' => array(
                'label'			  => __( 'Remove product button icon color on hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_on_hover_icon_color')
            ),
        );
    }
}
if(!function_exists('addonify_floating_cart_cart_products_display_designs_add')){
    function addonify_floating_cart_cart_products_display_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_products_display_designs());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_products_display_designs_add' );
}


if(!function_exists('addonify_floating_cart_cart_primary_button_display_designs')){
    function addonify_floating_cart_cart_primary_button_display_designs(){
        return array(
            //primary button color
            'cart_modal_primary_button_background_color' => array(
                'label'			  => __( 'Primary Button Background Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_background_color')
            ),
            'cart_modal_primary_button_label_color' => array(
                'label'			  => __( 'Primary Button Label Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_label_color')
            ),
            'cart_modal_primary_button_border_color' => array(
                'label'			  => __( 'Primary Button Border Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_border_color')
            ),
            'cart_modal_primary_button_on_hover_background_color' => array(
                'label'			  => __( 'Primary Button Background Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_on_hover_background_color')
            ),
            'cart_modal_primary_button_on_hover_label_color' => array(
                'label'			  => __( 'Primary Button Label Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_on_hover_label_color')
            ),
            'cart_modal_primary_button_on_hover_border_color' => array(
                'label'			  => __( 'Primary Button Border Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_on_hover_border_color')
            ),
        );
    }
}
if(!function_exists('addonify_floating_cart_cart_primary_button_display_designs_add')){
    function addonify_floating_cart_cart_primary_button_display_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_primary_button_display_designs());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_primary_button_display_designs_add' );
}


if(!function_exists('addonify_floating_cart_cart_secondary_button_display_designs')){
    function addonify_floating_cart_cart_secondary_button_display_designs(){
        return array(
            //secondary button color
            'cart_modal_secondary_button_background_color' => array(
                'label'			  => __( 'Secondary Button Background Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_background_color')
            ),
            'cart_modal_secondary_button_label_color' => array(
                'label'			  => __( 'Secondary Button Label Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_label_color')
            ),
            'cart_modal_secondary_button_border_color' => array(
                'label'			  => __( 'Secondary Button Border Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_border_color')
            ),
            'cart_modal_secondary_button_on_hover_background_color' => array(
                'label'			  => __( 'Secondary Button Background Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_on_hover_background_color')
            ),
            'cart_modal_secondary_button_on_hover_label_color' => array(
                'label'			  => __( 'Secondary Button Label Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_on_hover_label_color')
            ),
            'cart_modal_secondary_button_on_hover_border_color' => array(
                'label'			  => __( 'Secondary Button Border Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_on_hover_border_color')
            ),
        );
    }
}
if(!function_exists('addonify_floating_cart_cart_secondary_button_display_designs_add')){
    function addonify_floating_cart_cart_secondary_button_display_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_secondary_button_display_designs());
    }
    add_filter(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_secondary_button_display_designs_add' );
}