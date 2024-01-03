<?php
/**
 * Define settings fields for toast notification.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_toast_notification_settings' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_toast_notification_settings() {

		return array(
			'display_toast_notification'          => array(
				'label'       => esc_html__( 'Display toast notification', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Enable this option to display toast notification for cart actions.', 'addonify-floating-cart' ),
				'type'        => 'switch',
				'dependent'   => array( 'enable_floating_cart' ),
				'value'       => addonify_floating_cart_get_option( 'display_toast_notification' ),
			),
			'toast_notification_display_position' => array(
				'label'       => esc_html__( 'Notification position', 'addonify-floating-cart' ),
				'type'        => 'select',
				'placeholder' => esc_attr__( 'Select position', 'addonify-floating-cart' ),
				'choices'     => array(
					'top-right'    => esc_html__( 'Top Right', 'addonify-floating-cart' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'addonify-floating-cart' ),
					'top-left'     => esc_html__( 'Top Left', 'addonify-floating-cart' ),
					'bottom-left'  => esc_html__( 'Bottom Left', 'addonify-floating-cart' ),
				),
				'dependent'   => array( 'display_toast_notification', 'enable_floating_cart' ),
				'value'       => addonify_floating_cart_get_option( 'toast_notification_display_position' ),
			),
			'added_to_cart_notification_text'     => array(
				'label'       => esc_html__( 'Added to cart text', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Text to be displayed after product is added to cart. Use {product_name} to display product name added to cart.', 'addonify-floating-cart' ),
				'type'        => 'text',
				'placeholder' => esc_attr__( 'Product added to cart', 'addonify-floating-cart' ),
				'dependent'   => array(
					'display_toast_notification',
					'enable_floating_cart',
					'enable_cart_labels_from_plugin',
				),
				'value'       => addonify_floating_cart_get_option( 'added_to_cart_notification_text' ),
			),
			'close_notification_after_time'       => array(
				'label'     => esc_html__( 'Time to auto close notification (in seconds)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 1,
				'max'       => 120,
				'step'      => 5,
				'dependent' => array( 'display_toast_notification', 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'close_notification_after_time' ),
			),
			'display_close_notification_button'   => array(
				'label'     => esc_html__( 'Display notification close button', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'display_toast_notification', 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'display_close_notification_button' ),
			),
			'display_show_cart_button'            => array(
				'label'     => esc_html__( 'Display button to toggle cart in toast notification', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'display_toast_notification', 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'display_show_cart_button' ),
			),
			'show_cart_button_label'              => array(
				'label'     => esc_html__( 'Label for button to toggle cart', 'addonify-floating-cart' ),
				'type'      => 'text',
				'dependent' => array(
					'display_toast_notification',
					'enable_floating_cart',
					'display_show_cart_button',
					'enable_cart_labels_from_plugin',
				),
				'value'     => addonify_floating_cart_get_option( 'show_cart_button_label' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_toast_notification_settings() );
		}
	);
}


if ( ! function_exists( 'addonify_floating_cart_toast_notification_designs' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_toast_notification_designs() {

		return array(
			'toast_notification_text_color'              => array(
				'label'     => esc_html__( 'Text color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_text_color' ),
			),
			'toast_notification_background_color'        => array(
				'label'     => esc_html__( 'Background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_background_color' ),
			),
			'toast_notification_icon_color'              => array(
				'label'     => esc_html__( 'Icon color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_icon_color' ),
			),
			'toast_notification_icon_bg_color'           => array(
				'label'     => esc_html__( 'Icon background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_icon_bg_color' ),
			),
			'toast_notification_button_background_color' => array(
				'label'     => esc_html__( 'Button background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_button_background_color' ),
			),
			'toast_notification_button_on_hover_background_color' => array(
				'label'     => esc_html__( 'Button background color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_button_on_hover_background_color' ),
			),
			'toast_notification_button_label_color'      => array(
				'label'     => esc_html__( 'Button label color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_button_label_color' ),
			),
			'toast_notification_button_on_hover_label_color' => array(
				'label'     => esc_html__( 'Button label color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_button_on_hover_label_color' ),
			),
			'toast_notification_horizontal_offset'       => array(
				'label'     => esc_html__( 'Horizontal offset from left or right of the screen (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'slider',
				'min'       => -500,
				'max'       => 500,
				'unit'      => 'px',
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_horizontal_offset' ),
			),
			'toast_notification_vertical_offset'         => array(
				'label'     => esc_html__( 'Vertical offset from top or bottom of the screen (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'slider',
				'min'       => -500,
				'max'       => 500,
				'unit'      => 'px',
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'toast_notification_vertical_offset' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_toast_notification_designs() );
		}
	);
}
