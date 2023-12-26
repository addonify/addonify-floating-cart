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
			'label'       => __( 'Display cart toggle button', 'addonify-floating-cart' ),
			'description' => __( 'Enable this option to display button to toggle cart.', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'display_cart_modal_toggle_button' ),
		),
		'hide_modal_toggle_button_on_empty_cart'    => array(
			'label'     => __( 'Hide cart toggle button if the cart is empty', 'addonify-floating-cart' ),
			'type'      => 'switch',
			'dependent' => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
			'value'     => addonify_floating_cart_get_option( 'hide_modal_toggle_button_on_empty_cart' ),
		),
		'cart_modal_toggle_button_display_position' => array(
			'label'       => __( 'Button position', 'addonify-floating-cart' ),
			'type'        => 'select',
			'placeholder' => __( 'Select position', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
			'choices'     => array(
				'top-right'    => __( 'Top Right', 'addonify-floating-cart' ),
				'bottom-right' => __( 'Bottom Right', 'addonify-floating-cart' ),
				'top-left'     => __( 'Top Left', 'addonify-floating-cart' ),
				'bottom-left'  => __( 'Bottom Left', 'addonify-floating-cart' ),
			),
			'value'       => addonify_floating_cart_get_option( 'cart_modal_toggle_button_display_position' ),
		),
		'display_cart_items_number_badge'           => array(
			'label'       => __( 'Display badge', 'addonify-floating-cart' ),
			'description' => __( 'Display badge for number of items in the cart on toggle button', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
			'value'       => addonify_floating_cart_get_option( 'display_cart_items_number_badge' ),
		),
		'cart_items_number_badge_position'          => array(
			'label'       => __( 'Badge position', 'addonify-floating-cart' ),
			'type'        => 'select',
			'placeholder' => __( 'Select position', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button', 'display_cart_items_number_badge' ),
			'choices'     => array(
				'top-right'    => __( 'Top Right', 'addonify-floating-cart' ),
				'bottom-right' => __( 'Bottom Right', 'addonify-floating-cart' ),
				'top-left'     => __( 'Top Left', 'addonify-floating-cart' ),
				'bottom-left'  => __( 'Bottom Left', 'addonify-floating-cart' ),
			),
			'value'       => addonify_floating_cart_get_option( 'cart_items_number_badge_position' ),
		),
		'cart_badge_items_total_count'              => array(
			'label'       => __( 'Cart items count', 'addonify-floating-cart' ),
			'type'        => 'select',
			'placeholder' => __( 'Select count type', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button', 'display_cart_items_number_badge' ),
			'choices'     => array(
				'total_products'            => esc_html__( 'Total Products Types', 'addonify-floating-cart' ),
				'total_products_quantities' => esc_html__( 'Total Product Quantities', 'addonify-floating-cart' ),
			),
			'value'       => addonify_floating_cart_get_option( 'cart_badge_items_total_count' ),
		),
		'cart_modal_toggle_button_icon'             => array(
			'label'         => esc_html__( 'Cart toggle button icon', 'addonify-floating-cart' ),
			'type'          => 'radio-icons',
			'renderChoices' => 'html',
			'className'     => 'fullwidth',
			'choices'       => addonify_floating_cart_get_cart_modal_toggle_button_icons(),
			'dependent'     => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
			'value'         => addonify_floating_cart_get_option( 'cart_modal_toggle_button_icon' ),
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
		'toggle_button_badge_width'                     => array(
			'label'     => __( 'Badge width (unit: px)', 'addonify-floating-cart' ),
			'type'      => 'number',
			'style'     => 'buttons-plus-minus',
			'min'       => 40,
			'max'       => 200,
			'step'      => 5,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_width' ),
		),
		'toggle_button_badge_font_size'                 => array(
			'label'     => __( 'Badge font size (unit: px)', 'addonify-floating-cart' ),
			'type'      => 'number',
			'style'     => 'buttons-plus-minus',
			'min'       => 13,
			'max'       => 20,
			'step'      => 1,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_font_size' ),
		),
		'toggle_button_badge_background_color'          => array(
			'label'     => __( 'Badge background color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_background_color' ),
		),
		'toggle_button_badge_on_hover_background_color' => array(
			'label'     => __( 'Badge background color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_on_hover_background_color' ),
		),
		'toggle_button_badge_label_color'               => array(
			'label'     => __( 'Badge label color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_label_color' ),
		),
		'toggle_button_label_on_hover_color'            => array(
			'label'     => __( 'Badge label color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_label_on_hover_color' ),
		),
		'toggle_button_label_color'                     => array(
			'label'     => __( 'Cart toggle button font color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_label_color' ),
		),
		'toggle_button_background_color'                => array(
			'label'     => __( 'Cart toggle button background color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_background_color' ),
		),
		'toggle_button_border_color'                    => array(
			'label'     => __( 'Cart toggle button border color', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_border_color' ),
		),
		'toggle_button_on_hover_label_color'            => array(
			'label'     => __( 'Cart toggle button label color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_label_color' ),
		),
		'toggle_button_on_hover_background_color'       => array(
			'label'     => __( 'Cart toggle button background color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_background_color' ),
		),
		'toggle_button_on_hover_border_color'           => array(
			'label'     => __( 'Cart toggle button border color on hover', 'addonify-floating-cart' ),
			'type'      => 'color',
			'isAlpha'   => true,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_border_color' ),
		),
		'cart_modal_toggle_button_width'                => array(
			'label'     => __( 'Cart toggle button size (unit: px)', 'addonify-floating-cart' ),
			'type'      => 'number',
			'style'     => 'buttons-plus-minus',
			'min'       => 40,
			'max'       => 200,
			'step'      => 5,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_width' ),
		),
		'cart_modal_toggle_button_border_radius'        => array(
			'label'     => __( 'Cart toggle border radius (unit: px)', 'addonify-floating-cart' ),
			'type'      => 'number',
			'style'     => 'buttons-plus-minus',
			'min'       => 0,
			'max'       => 60,
			'step'      => 2,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_border_radius' ),
		),
		'cart_modal_toggle_button_icon_font_size'       => array(
			'label'     => __( 'Cart toggle button icon font size (unit: px)', 'addonify-floating-cart' ),
			'type'      => 'number',
			'style'     => 'buttons-plus-minus',
			'min'       => 14,
			'max'       => 80,
			'step'      => 2,
			'dependent' => array( 'load_styles_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_width' ),
		),
		'cart_modal_toggle_button_horizontal_offset'    => array(
			'label'       => __( 'Cart toggle button horizontal offset (unit: px)', 'addonify-floating-cart' ),
			'description' => __( 'Horizontal offset from left or right side of the screen.', 'addonify-floating-cart' ),
			'type'        => 'number',
			'style'       => 'slider',
			'min'         => -500,
			'max'         => 500,
			'dependent'   => array( 'load_styles_from_plugin' ),
			'value'       => addonify_floating_cart_get_option( 'cart_modal_toggle_button_horizontal_offset' ),
		),
		'cart_modal_toggle_button_vertical_offset'      => array(
			'label'       => __( 'Cart toggle button vertical offset (unit: px)', 'addonify-floating-cart' ),
			'description' => __( 'Vertical offset from top or bottom of the screen.', 'addonify-floating-cart' ),
			'type'        => 'number',
			'style'       => 'slider',
			'min'         => -500,
			'max'         => 500,
			'dependent'   => array( 'load_styles_from_plugin' ),
			'value'       => addonify_floating_cart_get_option( 'cart_modal_toggle_button_vertical_offset' ),
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
