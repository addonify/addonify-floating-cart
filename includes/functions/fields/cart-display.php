<?php

if(!function_exists('addonify_floating_cart_cart_display_settings')){
    function addonify_floating_cart_cart_display_settings(){
        return array(
            'cart_modal_display_layout' => array(
                'label'			  => __( '', 'addonify-floating-cart' ),
                'description'     => 'Choose from different types of layouts.',
                'type'            => 'select',
                'choices' => array(
                    'layout-1'     => __( 'Layout 1', 'addonify-floating-cart' ),
                    'layout-2'     => __( 'Layout 2', 'addonify-floating-cart' ),
                    'layout-3'     => __( 'Layout 3', 'addonify-floating-cart' ),
                ),
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_display_layout')
            ),
            'cart_title' => array(
                'label'			  => __( 'Cart Title', 'addonify-floating-cart' ),
                'description'     => 'Title of floating cart displayed at top.',
                'type'            => 'text',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_title')
            ),
            'display_cart_items_number' => array(
                'label'			  => __( 'Display Cart Items Count', 'addonify-floating-cart' ),
                'description'     => 'Cart Items Count displayed at top.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_cart_items_number')
            ),
            'close_cart_modal_on_overlay_click' => array(
                'label'			  => __( 'Close cart on overlay click', 'addonify-floating-cart' ),
                'description'     => 'Close cart on overlay click.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('close_cart_modal_on_overlay_click')
            ),
            'display_continue_shopping_button' => array(
                'label'			  => __( 'Display Continue Shopping Button', 'addonify-floating-cart' ),
                'description'     => 'Check if continue shopping button should be displayed.',
                'type'            => 'switch',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('display_continue_shopping_button')
            ),
            'continue_shopping_button_label' => array(
                'label'			  => __( 'Continue Shopping Button Label', 'addonify-floating-cart' ),
                'description'     => 'Label for Continue Shopping button.',
                'type'            => 'text',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('display_continue_shopping_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('continue_shopping_button_label')
            ),
            'checkout_button_label' => array(
                'label'			  => __( 'Checkout Button Label', 'addonify-floating-cart' ),
                'description'     => 'Label of checkout button.',
                'type'            => 'text',
                'badge'           => 'Required',
                'badgeType'       => '',
                'dependent'       => array('enable_floating_cart'),
                'value'           => addonify_floating_cart_get_setting_field_value('checkout_button_label')
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


if(!function_exists('addonify_floating_cart_cart_display_designs')){
    function addonify_floating_cart_cart_display_designs(){
        return array(
            'cart_modal_background_color' => array(
                'label'			  => __( 'Cart Background Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change cart background color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_background_color')
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
            'cart_modal_badge_background_color' => array(
                'label'			  => __( 'Cart Badge Background Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change cart badge background color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_badge_background_color')
            ),
            'cart_modal_badge_text_color' => array(
                'label'			  => __( 'Cart Badge Text Color', 'addonify-floating-cart' ),
                'description'     => 'Change this to change cart badge text color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_badge_text_color')
            ),
            'cart_modal_close_icon_color' => array(
                'label'			  => __( 'Cart Close Icon Color', 'addonify-floating-cart' ),
                'description'     => 'To change cart-close icon color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_close_icon_color')
            ),
            'cart_modal_product_title_color' => array(
                'label'			  => __( 'Cart Product Title Color', 'addonify-floating-cart' ),
                'description'     => 'To change product title color in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_color')
            ),
            'cart_modal_product_title_on_hover_color' => array(
                'label'			  => __( 'Product Title Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change product title color while hovering in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_title_on_hover_color')
            ),
            'cart_modal_product_quantity_price_color' => array(
                'label'			  => __( 'Product Quantity Price Color', 'addonify-floating-cart' ),
                'description'     => 'To change product quantity price text color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_quantity_price_color')
            ),
            'cart_modal_product_remove_button_background_color' => array(
                'label'			  => __( 'Product Remove Button Background Color', 'addonify-floating-cart' ),
                'description'     => 'To change product-remove button background color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_background_color')
            ),
            'cart_modal_product_remove_button_icon_color' => array(
                'label'			  => __( 'Product Remove Button Icon Color', 'addonify-floating-cart' ),
                'description'     => 'To change product-remove button icon color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_icon_color')
            ),
            'cart_modal_product_remove_button_on_hover_background_color' => array(
                'label'			  => __( 'Product Remove Button Background Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change product-remove button background color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_on_hover_background_color')
            ),
            'cart_modal_product_remove_button_on_hover_icon_color' => array(
                'label'			  => __( 'Product Remove Button Icon Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change product-remove button icon color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_product_remove_button_on_hover_icon_color')
            ),
            'cart_modal_content_text_color' => array(
                'label'			  => __( 'Cart Content Text Color', 'addonify-floating-cart' ),
                'description'     => 'To change the text color of cart content.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_text_color')
            ),
            'cart_modal_content_link_color' => array(
                'label'			  => __( 'Cart Content Link Color', 'addonify-floating-cart' ),
                'description'     => 'To change the link color of cart content.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_link_color')
            ),
            'cart_modal_content_link_on_hover_color' => array(
                'label'			  => __( 'Content Link Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change content link on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_content_link_on_hover_color')
            ),
            'cart_modal_border_color' => array(
                'label'			  => __( 'Cart Border Color', 'addonify-floating-cart' ),
                'description'     => 'To change cart border color.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_border_color')
            ),
            'cart_modal_input_field_background_color' => array(
                'label'			  => __( 'Input Field Background Color', 'addonify-floating-cart' ),
                'description'     => 'To change inout field backgroound color in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_background_color')
            ),
            'cart_modal_input_field_text_color' => array(
                'label'			  => __( 'Input Field Text Color', 'addonify-floating-cart' ),
                'description'     => 'To change inout field text color in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_text_color')
            ),
            'cart_modal_input_field_border_color' => array(
                'label'			  => __( 'Input Field Border Color', 'addonify-floating-cart' ),
                'description'     => 'To change inout field border color in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_input_field_border_color')
            ),
            'cart_modal_primary_button_background_color' => array(
                'label'			  => __( 'Primary Button Background Color', 'addonify-floating-cart' ),
                'description'     => 'To change primary key background color in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_background_color')
            ),
            'cart_modal_primary_button_label_color' => array(
                'label'			  => __( 'Primary Button Label Color', 'addonify-floating-cart' ),
                'description'     => 'To change primary key label color in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_label_color')
            ),
            'cart_modal_primary_button_border_color' => array(
                'label'			  => __( 'Primary Button Border Color', 'addonify-floating-cart' ),
                'description'     => 'To change primary key border color in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_border_color')
            ),
            'cart_modal_primary_button_on_hover_background_color' => array(
                'label'			  => __( 'Primary Button Background Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change primary key background color on hover in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_on_hover_background_color')
            ),
            'cart_modal_primary_button_on_hover_label_color' => array(
                'label'			  => __( 'Primary Button Label Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change primary key label color on hover in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_on_hover_label_color')
            ),
            'cart_modal_primary_button_on_hover_border_color' => array(
                'label'			  => __( 'Primary Button Border Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change primary key border color on hover in cart.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_primary_button_on_hover_border_color')
            ),
            'cart_modal_secondary_button_background_color' => array(
                'label'			  => __( 'Secondary Button Background Color', 'addonify-floating-cart' ),
                'description'     => '.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_background_color')
            ),
            'cart_modal_secondary_button_label_color' => array(
                'label'			  => __( 'Secondary Button Label Color', 'addonify-floating-cart' ),
                'description'     => '.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_label_color')
            ),
            'cart_modal_secondary_button_border_color' => array(
                'label'			  => __( 'Secondary Button Border Color', 'addonify-floating-cart' ),
                'description'     => '.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_border_color')
            ),
            'cart_modal_secondary_button_on_hover_background_color' => array(
                'label'			  => __( 'Secondary Button Background Color on Hover', 'addonify-floating-cart' ),
                'description'     => '.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_on_hover_background_color')
            ),
            'cart_modal_secondary_button_on_hover_label_color' => array(
                'label'			  => __( 'Secondary Button Label Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change secondary button label color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_on_hover_label_color')
            ),
            'cart_modal_secondary_button_on_hover_border_color' => array(
                'label'			  => __( 'Secondary Button Border Color on Hover', 'addonify-floating-cart' ),
                'description'     => 'To change secondary button border color on hover.',
                'type'            => 'color',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_secondary_button_on_hover_border_color')
            ),
            'cart_modal_width' => array(
                'label'			  => __( 'Cart width', 'addonify-floating-cart' ),
                'description'     => 'Change this to change cart width.',
                'type'            => 'number',
                'dependent'       => array('display_cart_modal_toggle_button'),
                'value'           => addonify_floating_cart_get_setting_field_value('cart_modal_width')
            ),
        );
    }
}


if(!function_exists('addonify_floating_cart_cart_display_designs_add')){
    function addonify_floating_cart_cart_display_designs_add($setting_fields){
        return array_merge($setting_fields, addonify_floating_cart_cart_display_designs());
    }
    apply_filters(  'addonify_floating_cart/settings_fields', 'addonify_floating_cart_cart_display_designs_add' );
}