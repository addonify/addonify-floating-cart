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

if ( ! function_exists( 'addonify_floating_cart_toggle_cart_button_settings' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_toggle_cart_button_settings() {

		return array(
			'display_cart_modal_toggle_button'          => array(
				'label'       => esc_html__( 'Display cart toggle button', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Enable this option to display button to toggle cart.', 'addonify-floating-cart' ),
				'type'        => 'switch',
				'dependent'   => array( 'enable_floating_cart' ),
				'value'       => addonify_floating_cart_get_option( 'display_cart_modal_toggle_button' ),
			),
			'hide_modal_toggle_button_on_empty_cart'    => array(
				'label'     => esc_html__( 'Hide cart toggle button if the cart is empty', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
				'value'     => addonify_floating_cart_get_option( 'hide_modal_toggle_button_on_empty_cart' ),
			),
			'cart_modal_toggle_button_display_position' => array(
				'label'       => esc_html__( 'Button position', 'addonify-floating-cart' ),
				'type'        => 'select',
				'placeholder' => esc_attr__( 'Select position', 'addonify-floating-cart' ),
				'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
				'choices'     => array(
					'top-right'    => esc_html__( 'Top Right', 'addonify-floating-cart' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'addonify-floating-cart' ),
					'top-left'     => esc_html__( 'Top Left', 'addonify-floating-cart' ),
					'bottom-left'  => esc_html__( 'Bottom Left', 'addonify-floating-cart' ),
				),
				'value'       => addonify_floating_cart_get_option( 'cart_modal_toggle_button_display_position' ),
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
			'display_cart_items_number_badge'           => array(
				'label'       => esc_html__( 'Display cart items count badge', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Displays count of cart items on the cart toggle button', 'addonify-floating-cart' ),
				'type'        => 'switch',
				'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button' ),
				'value'       => addonify_floating_cart_get_option( 'display_cart_items_number_badge' ),
			),
			'cart_items_number_badge_position'          => array(
				'label'       => esc_html__( 'Badge position', 'addonify-floating-cart' ),
				'type'        => 'select',
				'placeholder' => esc_attr__( 'Select position', 'addonify-floating-cart' ),
				'dependent'   => array( 'enable_floating_cart', 'display_cart_modal_toggle_button', 'display_cart_items_number_badge' ),
				'choices'     => array(
					'top-right'    => esc_html__( 'Top Right', 'addonify-floating-cart' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'addonify-floating-cart' ),
					'top-left'     => esc_html__( 'Top Left', 'addonify-floating-cart' ),
					'bottom-left'  => esc_html__( 'Bottom Left', 'addonify-floating-cart' ),
				),
				'value'       => addonify_floating_cart_get_option( 'cart_items_number_badge_position' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_toggle_cart_button_settings() );
		}
	);
}


if ( ! function_exists( 'addonify_floating_cart_toggle_cart_button_designs' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_toggle_cart_button_designs() {

		return array(
			'toggle_button_badge_width'                  => array(
				'label'     => esc_html__( 'Badge width (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 40,
				'max'       => 200,
				'step'      => 5,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_width' ),
			),
			'toggle_button_badge_font_size'              => array(
				'label'     => esc_html__( 'Badge font size (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 13,
				'max'       => 20,
				'step'      => 1,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_font_size' ),
			),
			'toggle_button_badge_background_color'       => array(
				'label'     => esc_html__( 'Badge background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_background_color' ),
			),
			'toggle_button_badge_on_hover_background_color' => array(
				'label'     => esc_html__( 'Badge background color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_on_hover_background_color' ),
			),
			'toggle_button_badge_label_color'            => array(
				'label'     => esc_html__( 'Badge label color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_badge_label_color' ),
			),
			'toggle_button_label_on_hover_color'         => array(
				'label'     => esc_html__( 'Badge label color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_label_on_hover_color' ),
			),
			'toggle_button_label_color'                  => array(
				'label'     => esc_html__( 'Cart toggle button font color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_label_color' ),
			),
			'toggle_button_background_color'             => array(
				'label'     => esc_html__( 'Cart toggle button background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_background_color' ),
			),
			'toggle_button_border_color'                 => array(
				'label'     => esc_html__( 'Cart toggle button border color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_border_color' ),
			),
			'toggle_button_on_hover_label_color'         => array(
				'label'     => esc_html__( 'Cart toggle button label color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_label_color' ),
			),
			'toggle_button_on_hover_background_color'    => array(
				'label'     => esc_html__( 'Cart toggle button background color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_background_color' ),
			),
			'toggle_button_on_hover_border_color'        => array(
				'label'     => esc_html__( 'Cart toggle button border color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toggle_button_on_hover_border_color' ),
			),
			'cart_modal_toggle_button_width'             => array(
				'label'     => esc_html__( 'Cart toggle button size (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 40,
				'max'       => 200,
				'step'      => 5,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_width' ),
			),
			'cart_modal_toggle_button_border_radius'     => array(
				'label'     => esc_html__( 'Cart toggle border radius (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 0,
				'max'       => 60,
				'step'      => 2,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_border_radius' ),
			),
			'cart_modal_toggle_button_icon_font_size'    => array(
				'label'     => esc_html__( 'Cart toggle button icon font size (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 14,
				'max'       => 80,
				'step'      => 2,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_width' ),
			),
			'cart_modal_toggle_button_horizontal_offset' => array(
				'label'       => esc_html__( 'Cart toggle button horizontal offset (unit: px)', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Horizontal offset from left or right side of the screen.', 'addonify-floating-cart' ),
				'type'        => 'number',
				'style'       => 'slider',
				'min'         => -500,
				'max'         => 500,
				'dependent'   => array( 'load_styles_from_plugin' ),
				'value'       => addonify_floating_cart_get_option( 'cart_modal_toggle_button_horizontal_offset' ),
			),
			'cart_modal_toggle_button_vertical_offset'   => array(
				'label'       => esc_html__( 'Cart toggle button vertical offset (unit: px)', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Vertical offset from top or bottom of the screen.', 'addonify-floating-cart' ),
				'type'        => 'number',
				'style'       => 'slider',
				'min'         => -500,
				'max'         => 500,
				'dependent'   => array( 'load_styles_from_plugin' ),
				'value'       => addonify_floating_cart_get_option( 'cart_modal_toggle_button_vertical_offset' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_toggle_cart_button_designs() );
		}
	);
}
