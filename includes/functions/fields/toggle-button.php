<?php
/**
 * Define settings fields for floating cart toggle button.
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
function addonify_floating_cart_toggle_cart_button_settings() {

	return array(
		'display_cart_modal_toggle_button'          => array(
			'label'       => __( 'Display Cart Toggle Button', 'addonify-floating-cart' ),
			'description' => __( 'Enable this option to display button to toggle cart.', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'display_cart_modal_toggle_button' ),
		),
		'cart_modal_toggle_button_display_position' => array(
			'label'     => __( 'Button Position', 'addonify-floating-cart' ),
			'type'      => 'select',
			'choices'   => array(
				'top-right'    => __( 'Top Right', 'addonify-floating-cart' ),
				'bottom-right' => __( 'Bottom Right', 'addonify-floating-cart' ),
				'top-left'     => __( 'Top Left', 'addonify-floating-cart' ),
				'bottom-left'  => __( 'Bottom Left', 'addonify-floating-cart' ),
			),
			'dependent' => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_display_position' ),
		),
		'display_cart_items_number_badge'           => array(
			'label'       => __( 'Display Badge', 'addonify-floating-cart' ),
			'description' => __( 'Display badge for number of items in the cart on toggle button', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
			'value'       => addonify_floating_cart_get_option( 'display_cart_items_number_badge' ),
		),
		'cart_items_number_badge_position'          => array(
			'label'     => __( 'Badge Position', 'addonify-floating-cart' ),
			'type'      => 'select',
			'choices'   => array(
				'top-right'    => __( 'Top Right', 'addonify-floating-cart' ),
				'bottom-right' => __( 'Bottom Right', 'addonify-floating-cart' ),
				'top-left'     => __( 'Top Left', 'addonify-floating-cart' ),
				'bottom-left'  => __( 'Bottom Left', 'addonify-floating-cart' ),
			),
			'dependent' => array( 'enable_floating_cart', 'display_cart_modal_toggle_button', 'display_cart_items_number_badge' ),
			'value'     => addonify_floating_cart_get_option( 'cart_items_number_badge_position' ),
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
function addonify_floating_cart_toggle_cart_button_settings_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_toggle_cart_button_settings() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_toggle_cart_button_settings_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_toggle_cart_button_designs() {

	return array(
		'toggle_button_badge_width'                  => array(
			'label'           => __( 'Badge Width', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 40,
			'max'             => 200,
			'step'            => 5,
			'dependent'       => array( 'display_cart_modal_toggle_button' ),
			'value'           => addonify_floating_cart_get_option( 'toggle_button_badge_width' ),
		),
		'toggle_button_badge_font_size'              => array(
			'label'           => __( 'Badge Font Size', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 13,
			'max'             => 20,
			'value'           => addonify_floating_cart_get_option( 'toggle_button_badge_font_size' ),
		),
		'toggle_button_badge_background_color'       => array(
			'label'     => __( 'Badge Background Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_items_number_badge' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_background_color' ),
		),
		'toggle_button_badge_label_color'            => array(
			'label'     => __( 'Badge Label Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_items_number_badge' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_label_color' ),
		),
		'toggle_button_label_color'                  => array(
			'label'     => __( 'Cart Toggle Button Font Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_label_color' ),
		),
		'toggle_button_background_color'             => array(
			'label'     => __( 'Cart Toggle Button Background Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_background_color' ),
		),
		'toggle_button_border_color'                 => array(
			'label'     => __( 'Cart Toggle Button Border Color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_border_color' ),
		),
		'toggle_button_on_hover_label_color'         => array(
			'label'     => __( 'Cart Toggle Button Label Color on Hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_label_color' ),
		),
		'toggle_button_on_hover_background_color'    => array(
			'label'     => __( 'Cart Toggle Button Background Color on Hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_background_color' ),
		),
		'toggle_button_on_hover_border_color'        => array(
			'label'     => __( 'Cart Toggle Button Border Color on Hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'dependent' => array( 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_border_color' ),
		),
		'cart_modal_toggle_button_width'             => array(
			'label'           => __( 'Cart Toggle Button Size', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 40,
			'max'             => 200,
			'step'            => 5,
			'dependent'       => array( 'display_cart_modal_toggle_button' ),
			'value'           => addonify_floating_cart_get_option( 'cart_modal_toggle_button_width' ),
		),
		'cart_modal_toggle_button_border_radius'     => array(
			'label'           => __( 'Cart Toggle Border Radius', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 0,
			'max'             => 60,
			'value'           => addonify_floating_cart_get_option( 'cart_modal_toggle_button_border_radius' ),
		),
		'cart_modal_toggle_button_icon_font_size'    => array(
			'label'           => __( 'Cart Toggle Button Icon Font Size', 'addonify-floating-cart' ),
			'description'     => __( 'Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => 14,
			'max'             => 80,
			'step'            => 2,
			'dependent'       => array( 'cart_modal_toggle_button_icon_font_size' ),
			'value'           => addonify_floating_cart_get_option( 'cart_modal_toggle_button_width' ),
		),
		'cart_modal_toggle_button_horizontal_offset' => array(
			'label'           => __( 'Cart Toggle Button Horizontal Offset', 'addonify-floating-cart' ),
			'description'     => __( 'Horizontal offset from left or right side of the screen. Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => -500,
			'max'             => 500,
			'step'            => 10,
			'dependent'       => array( 'display_cart_modal_toggle_button' ),
			'value'           => addonify_floating_cart_get_option( 'cart_modal_toggle_button_horizontal_offset' ),
		),
		'cart_modal_toggle_button_vertical_offset'   => array(
			'label'           => __( 'Cart Toggle Button Vertical Offset', 'addonify-floating-cart' ),
			'description'     => __( 'Vertical offset from top or bottom of the screen. Value in px.', 'addonify-floating-cart' ),
			'type'            => 'number',
			'typeStyle'       => 'toggle',
			'controlPosition' => 'right',
			'min'             => -500,
			'max'             => 500,
			'step'            => 10,
			'dependent'       => array( 'display_cart_modal_toggle_button' ),
			'value'           => addonify_floating_cart_get_option( 'cart_modal_toggle_button_vertical_offset' ),
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
function addonify_floating_cart_toggle_cart_button_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_toggle_cart_button_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_toggle_cart_button_designs_add' );
