<?php
/**
 * Define settings fields for cart content.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_display_settings() {

	return array(
		'cart_position'                     => array(
			'label'     => __( 'Cart Position', 'addonify-floating-cart' ),
			'type'      => 'select',
			'choices'   => array(
				'left'  => __( 'Left', 'addonify-floating-cart' ),
				'right' => __( 'Right', 'addonify-floating-cart' ),
			),
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'cart_position' ),
		),
		'cart_title'                        => array(
			'label'     => __( 'Cart Title', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'cart_title' ),
		),
		'display_cart_items_number'         => array(
			'label'       => __( 'Display Badge', 'addonify-floating-cart' ),
			'description' => __( 'Display badge for number of items in the cart beside cart title.', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'display_cart_items_number' ),
		),
		'close_cart_modal_on_overlay_click' => array(
			'label'     => __( 'Close Cart on Overlay Click', 'addonify-floating-cart' ),
			'type'      => 'switch',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'close_cart_modal_on_overlay_click' ),
		),
		'display_continue_shopping_button'  => array(
			'label'       => __( 'Display Cart Close Button', 'addonify-floating-cart' ),
			'description' => __( 'Display cart close button at the footer of the cart.', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'display_continue_shopping_button' ),
		),
		'continue_shopping_button_label'    => array(
			'label'       => __( 'Cart Close Button Label', 'addonify-floating-cart' ),
			'type'        => 'text',
			'placeholder' => __( 'Continue shopping', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart', 'display_continue_shopping_button' ),
			'value'       => addonify_floating_cart_get_option( 'continue_shopping_button_label' ),
		),
		'checkout_button_label'             => array(
			'label'       => __( 'Checkout Button Label', 'addonify-floating-cart' ),
			'type'        => 'text',
			'placeholder' => __( 'Checkout', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'checkout_button_label' ),
		),
	);
}

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @param mixed $setting_fields Setting fields.
 * @return array
 */
function addonify_floating_cart_cart_display_settings_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_display_settings() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_display_settings_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_display_designs() {

	return array(
		'cart_modal_width'                       => array(
			'label'           => __( 'Cart Width', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 400,
			'max'             => 800,
			'value'           => addonify_floating_cart_get_option( 'cart_modal_width' ),
		),
		'cart_modal_base_font_size'              => array(
			'label'           => __( 'General Cart Text Font Size', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 12,
			'max'             => 22,
			'value'           => addonify_floating_cart_get_option( 'cart_modal_base_font_size' ),
		),
		'cart_modal_background_color'            => array(
			'label'       => __( 'Cart Background Color', 'addonify-floating-cart' ),
			'description' => __( 'Main cart container background color.', 'addonify-floating-cart' ),
			'type'        => 'color',
			'value'       => addonify_floating_cart_get_option( 'cart_modal_background_color' ),
		),
		'cart_modal_overlay_color'               => array(
			'label' => __( 'Cart Overlay Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_overlay_color' ),
		),
		'cart_modal_border_color'                => array(
			'label' => __( 'General Border Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_border_color' ),
		),
		'cart_modal_base_text_color'             => array(
			'label' => __( 'General Text Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_base_text_color' ),
		),
		'cart_modal_content_link_color'          => array(
			'label' => __( 'General link Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_content_link_color' ),
		),
		'cart_modal_content_link_on_hover_color' => array(
			'label' => __( 'General link Color on Hover', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_content_link_on_hover_color' ),
		),
		'cart_modal_title_color'                 => array(
			'label'       => __( 'Cart Title Color', 'addonify-floating-cart' ),
			'description' => '',
			'type'        => 'color',
			'value'       => addonify_floating_cart_get_option( 'cart_modal_title_color' ),
		),
		'cart_title_font_size'                   => array(
			'label'           => __( 'Cart Title Font Size', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 13,
			'max'             => 20,
			'value'           => addonify_floating_cart_get_option( 'cart_title_font_size' ),
		),
		'cart_title_font_weight'                 => array(
			'label'   => __( 'Cart Title Font Weight', 'addonify-floating-cart' ),
			'type'    => 'select',
			'choices' => array(
				'400' => __( 'Normal', 'addonify-floating-cart' ),
				'500' => __( 'Medium', 'addonify-floating-cart' ),
				'600' => __( 'Semi bold', 'addonify-floating-cart' ),
				'700' => __( 'Bold', 'addonify-floating-cart' ),
			),
			'value'   => addonify_floating_cart_get_option( 'cart_title_font_weight' ),
		),
		'cart_title_letter_spacing'              => array(
			'label'       => __( 'Cart Title Letter Spacing', 'addonify-floating-cart' ),
			'description' => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'        => 'number',
			'typeStyle'   => 'toggle',
			'min'         => 0,
			'max'         => 3,
			'step'        => 0.1,
			'precision'   => 2,
			'value'       => addonify_floating_cart_get_option( 'cart_title_letter_spacing' ),
		),
		'cart_title_text_transform'              => array(
			'label'   => __( 'Cart Title Text Transform', 'addonify-floating-cart' ),
			'type'    => 'select',
			'choices' => array(
				'none'       => __( 'None', 'addonify-floating-cart' ),
				'capatilize' => __( 'Capatilize', 'addonify-floating-cart' ),
				'uppercase'  => __( 'Uppercase', 'addonify-floating-cart' ),
				'lowercase'  => __( 'Lowercase', 'addonify-floating-cart' ),
			),
			'value'   => addonify_floating_cart_get_option( 'cart_title_text_transform' ),
		),
		'cart_modal_badge_text_color'            => array(
			'label' => __( 'Badge Label Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_badge_text_color' ),
		),
		'cart_modal_badge_background_color'      => array(
			'label' => __( 'Badge Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_badge_background_color' ),
		),
		'cart_modal_close_icon_color'            => array(
			'label' => __( 'Cart Close Icon Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_close_icon_color' ),
		),
		'cart_modal_close_icon_on_hover_color'   => array(
			'label' => __( 'Cart Close Icon Color on Hover', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_close_icon_on_hover_color' ),
		),
	);
}

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @param mixed $setting_fields Setting fields.
 * @return array
 */
function addonify_floating_cart_cart_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_display_designs_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_buttons_display_designs() {

	return array(
		'cart_modal_buttons_font_size'                     => array(
			'label'           => __( 'Buttons Font Size', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 13,
			'max'             => 20,
			'value'           => addonify_floating_cart_get_option( 'cart_modal_buttons_font_size' ),
		),
		'cart_modal_buttons_font_weight'                   => array(
			'label'   => __( 'Buttons Font Weight', 'addonify-floating-cart' ),
			'type'    => 'select',
			'choices' => array(
				'400' => __( 'Normal', 'addonify-floating-cart' ),
				'500' => __( 'Medium', 'addonify-floating-cart' ),
				'600' => __( 'Semi bold', 'addonify-floating-cart' ),
				'700' => __( 'Bold', 'addonify-floating-cart' ),
			),
			'value'   => addonify_floating_cart_get_option( 'cart_modal_buttons_font_weight' ),
		),
		'cart_modal_buttons_letter_spacing'                => array(
			'label'       => __( 'Buttons Letter Spacing', 'addonify-floating-cart' ),
			'description' => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'        => 'number',
			'typeStyle'   => 'toggle',
			'min'         => 0,
			'max'         => 3,
			'step'        => 0.1,
			'precision'   => 2,
			'value'       => addonify_floating_cart_get_option( 'cart_modal_buttons_letter_spacing' ),
		),
		'cart_modal_buttons_border_radius'                 => array(
			'label'           => __( 'Buttons Border Radius', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 0,
			'max'             => 60,
			'value'           => addonify_floating_cart_get_option( 'cart_modal_buttons_border_radius' ),
		),
		'cart_modal_buttons_text_transform'                => array(
			'label'   => __( 'Buttons Text Transform', 'addonify-floating-cart' ),
			'type'    => 'select',
			'choices' => array(
				'none'       => __( 'None', 'addonify-floating-cart' ),
				'capatilize' => __( 'Capatilize', 'addonify-floating-cart' ),
				'uppercase'  => __( 'Uppercase', 'addonify-floating-cart' ),
				'lowercase'  => __( 'Lowercase', 'addonify-floating-cart' ),
			),
			'value'   => addonify_floating_cart_get_option( 'cart_modal_buttons_text_transform' ),
		),
		'cart_modal_primary_button_background_color'       => array(
			'label' => __( 'Primary Button Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_primary_button_background_color' ),
		),
		'cart_modal_primary_button_label_color'            => array(
			'label'     => __( 'Primary Button Label Color color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_label_color' ),
		),
		'cart_modal_primary_button_border_color'           => array(
			'label'     => __( 'Primary Button Border Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_border_color' ),
		),
		'cart_modal_primary_button_on_hover_background_color' => array(
			'label'     => __( 'Primary Button Background Color on Hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_background_color' ),
		),
		'cart_modal_primary_button_on_hover_label_color'   => array(
			'label'     => __( 'Primary Button Label Color color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_label_color' ),
		),
		'cart_modal_primary_button_on_hover_border_color'  => array(
			'label'     => __( 'Primary Button Border Color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_border_color' ),
		),
		'cart_modal_secondary_button_background_color'     => array(
			'label' => __( 'Secondary Button Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_secondary_button_background_color' ),
		),
		'cart_modal_secondary_button_label_color'          => array(
			'label'     => __( 'Secondary Button Label Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_label_color' ),
		),
		'cart_modal_secondary_button_border_color'         => array(
			'label'     => __( 'Secondary Button Border Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_border_color' ),
		),
		'cart_modal_secondary_button_on_hover_background_color' => array(
			'label'     => __( 'Secondary Button Background Color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_background_color' ),
		),
		'cart_modal_secondary_button_on_hover_label_color' => array(
			'label'     => __( 'Secondary Button Label Color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_label_color' ),
		),
		'cart_modal_secondary_button_on_hover_border_color' => array(
			'label'     => __( 'Secondary Button Border Color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_border_color' ),
		),
	);
}

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @param mixed $setting_fields Setting fields.
 * @return array
 */
function addonify_floating_cart_cart_buttons_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_buttons_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_buttons_display_designs_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_misc_display_designs() {

	return array(
		'cart_modal_input_field_placeholder_color'      => array(
			'label' => __( 'Input Field Placeholder Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_input_field_placeholder_color' ),
		),
		'cart_modal_input_field_text_color'             => array(
			'label' => __( 'Input Field Text Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_input_field_text_color' ),
		),
		'cart_modal_input_field_border_color'           => array(
			'label' => __( 'Input Field Border Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_input_field_border_color' ),
		),
		'cart_modal_input_field_background_color'       => array(
			'label' => __( 'Input Field Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_input_field_background_color' ),
		),
		'cart_shopping_meter_initial_background_color'  => array(
			'label' => __( 'Initial Shopping Meter Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_shopping_meter_initial_background_color' ),
		),
		'cart_shopping_meter_progress_background_color' => array(
			'label' => __( 'Final Shopping Meter Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_shopping_meter_progress_background_color' ),
		),
	);
}

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @param mixed $setting_fields Setting fields.
 * @return array
 */
function addonify_floating_cart_cart_misc_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_misc_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_misc_display_designs_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_products_display_designs() {

	return array(
		'cart_modal_product_title_color'              => array(
			'label' => __( 'Product Title Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_product_title_color' ),
		),
		'cart_modal_product_title_on_hover_color'     => array(
			'label' => __( 'Product Title Color on Hover', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_product_title_on_hover_color' ),
		),
		'cart_modal_product_title_font_size'          => array(
			'label'       => __( 'Product Title Font Size', 'addonify-floating-cart' ),
			'description' => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'        => 'number',
			'typeStyle'   => 'toggle',
			'min'         => 13,
			'max'         => 22,
			'value'       => addonify_floating_cart_get_option( 'cart_modal_product_title_font_size' ),
		),
		'cart_modal_product_title_font_weight'        => array(
			'label'   => __( 'Product Title Font Weight', 'addonify-floating-cart' ),
			'type'    => 'select',
			'choices' => array(
				'400' => __( 'Normal', 'addonify-floating-cart' ),
				'500' => __( 'Medium', 'addonify-floating-cart' ),
				'600' => __( 'Semi bold', 'addonify-floating-cart' ),
				'700' => __( 'Bold', 'addonify-floating-cart' ),
			),
			'value'   => addonify_floating_cart_get_option( 'cart_modal_product_title_font_weight' ),
		),
		'cart_modal_product_quantity_price_color'     => array(
			'label' => __( 'Product Quantity & Price Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_product_quantity_price_color' ),
		),
		'cart_modal_product_remove_button_background_color' => array(
			'label' => __( 'Remove Product Button Background Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_background_color' ),
		),
		'cart_modal_product_remove_button_icon_color' => array(
			'label' => __( 'Remove Product Button Icon Color', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_icon_color' ),
		),
		'cart_modal_product_remove_button_on_hover_background_color' => array(
			'label' => __( 'Remove Product Button Background Color on Hover', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_background_color' ),
		),
		'cart_modal_product_remove_button_on_hover_icon_color' => array(
			'label' => __( 'Remove Product Button Icon Color on Hover', 'addonify-floating-cart' ),
			'type'  => 'color',
			'value' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_icon_color' ),
		),
	);
}

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @param mixed $setting_fields Setting fields.
 * @return array
 */
function addonify_floating_cart_cart_products_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_products_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_products_display_designs_add' );
