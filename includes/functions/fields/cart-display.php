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
                'label'			  => __( 'Cart Background Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change cart background color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_background_color')
            ),
            'cart_modal_border_color' => array(
                'label'			  => __( 'Cart Border Color', 'addonify-floating-cart' ),
                'description'     => 'To change cart border color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_border_color')
            ),
            'cart_modal_overlay_color' => array(
                'label'			  => __( 'Cart Overlay Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change cart overlay color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_overlay_color')
            ),
            'cart_modal_title_color' => array(
                'label'			  => __( 'Cart Title Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change cart title section color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_title_color')
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
            //misc
            'cart_modal_badge_background_color' => array(
                'label'			  => __( 'Cart Badge Background Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_badge_background_color')
            ),
            'cart_modal_badge_text_color' => array(
                'label'			  => __( 'Cart Badge Text Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_badge_text_color')
            ),
            'cart_modal_close_icon_color' => array(
                'label'			  => __( 'Cart Close Icon Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_close_icon_color')
            ),
            'cart_modal_content_text_color' => array(
                'label'			  => __( 'Cart Content Text Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_text_color')
            ),
            'cart_modal_content_link_color' => array(
                'label'			  => __( 'Cart Content Link Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_link_color')
            ),
            'cart_modal_content_link_on_hover_color' => array(
                'label'			  => __( 'Content Link Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_link_on_hover_color')
            ),
            'cart_modal_input_field_background_color' => array(
                'label'			  => __( 'Input Field Background Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_background_color')
            ),
            'cart_modal_input_field_text_color' => array(
                'label'			  => __( 'Input Field Text Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_text_color')
            ),
            'cart_modal_input_field_border_color' => array(
                'label'			  => __( 'Input Field Border Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_border_color')
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
            //products
            'cart_modal_product_title_color' => array(
                'label'			  => __( 'Cart Product Title Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_color')
            ),
            'cart_modal_product_title_on_hover_color' => array(
                'label'			  => __( 'Product Title Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_on_hover_color')
            ),
            'cart_modal_product_quantity_price_color' => array(
                'label'			  => __( 'Product Quantity Price Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_quantity_price_color')
            ),
            'cart_modal_product_remove_button_background_color' => array(
                'label'			  => __( 'Product Remove Button Background Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_background_color')
            ),
            'cart_modal_product_remove_button_icon_color' => array(
                'label'			  => __( 'Product Remove Button Icon Color', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_icon_color')
            ),
            'cart_modal_product_remove_button_on_hover_background_color' => array(
                'label'			  => __( 'Product Remove Button Background Color on Hover', 'addonify-floating-cart' ),
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_on_hover_background_color')
            ),
            'cart_modal_product_remove_button_on_hover_icon_color' => array(
                'label'			  => __( 'Product Remove Button Icon Color on Hover', 'addonify-floating-cart' ),
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