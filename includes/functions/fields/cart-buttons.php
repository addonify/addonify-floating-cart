<?php
/**
 * Define settings fields for cart buttons.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_buttons_general_settings' ) ) {
	/**
	 * Define general settings for cart buttons.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_buttons_general_settings() {

		return apply_filters(
			'addonify_floating_cart_buttons_general_settings',
			array(
				'checkout_button_label'            => array(
					'label'       => esc_html__( 'Checkout button label', 'addonify-floating-cart' ),
					'type'        => 'text',
					'placeholder' => esc_attr__( 'Checkout', 'addonify-floating-cart' ),
					'dependent'   => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'       => addonify_floating_cart_get_option( 'checkout_button_label' ),
				),
				'display_continue_shopping_button' => array(
					'label'     => esc_html__( 'Display button before checkout button', 'addonify-floating-cart' ),
					'type'      => 'switch',
					'dependent' => array( 'enable_floating_cart' ),
					'value'     => addonify_floating_cart_get_option( 'display_continue_shopping_button' ),
				),
				'continue_shopping_button_action'  => array(
					'label'     => esc_html__( 'Action of button before checkout button', 'addonify-floating-cart' ),
					'type'      => 'select',
					'choices'   => array(
						'default'        => esc_html__( 'Close Cart Modal', 'addonify-floating-cart' ),
						'open_cart_page' => esc_html__( 'Open Cart Page', 'addonify-floating-cart' ),
					),
					'dependent' => array(
						'enable_floating_cart',
						'display_continue_shopping_button',
					),
					'value'     => addonify_floating_cart_get_option( 'continue_shopping_button_action' ),
				),
				'continue_shopping_button_label'   => array(
					'label'       => esc_html__( 'Label of button before checkout button', 'addonify-floating-cart' ),
					'type'        => 'text',
					'placeholder' => esc_attr__( 'Close', 'addonify-floating-cart' ),
					'dependent'   => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_continue_shopping_button',
					),
					'value'       => addonify_floating_cart_get_option( 'continue_shopping_button_label' ),
				),
			)
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_buttons_general_settings() );
		}
	);
}
