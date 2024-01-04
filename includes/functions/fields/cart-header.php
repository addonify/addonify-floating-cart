<?php
/**
 * Define settings fields for cart header.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_header_general_settings' ) ) {
	/**
	 * Define general settings for cart header.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_header_general_settings() {

		return apply_filters(
			'addonify_floating_cart_header_general_settings',
			array(
				'cart_title'                 => array(
					'label'     => esc_html__( 'Cart title', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
					),
					'value'     => addonify_floating_cart_get_option( 'cart_title' ),
				),
				'display_cart_items_number'  => array(
					'label'       => esc_html__( 'Display cart items count badge', 'addonify-floating-cart' ),
					'description' => esc_html__( 'Displays count of cart items beside the cart title.', 'addonify-floating-cart' ),
					'type'        => 'switch',
					'dependent'   => array( 'enable_floating_cart' ),
					'value'       => addonify_floating_cart_get_option( 'display_cart_items_number' ),
				),
				// @since 1.2.4
				'item_counter_singular_text' => array(
					'label'     => esc_html__( 'Cart items count prefix text - singular', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_cart_items_number',
					),
					'value'     => addonify_floating_cart_get_option( 'item_counter_singular_text' ),
				),
				// @since 1.2.4
				'item_counter_plural_text'   => array(
					'label'     => esc_html__( 'Cart items count prefix text - plural', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_cart_items_number',
					),
					'value'     => addonify_floating_cart_get_option( 'item_counter_plural_text' ),
				),
			)
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_header_general_settings() );
		}
	);
}
