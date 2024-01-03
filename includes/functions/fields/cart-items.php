<?php
/**
 * Define settings fields for cart items/products.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_items_general_settings' ) ) {
	/**
	 * Define general settings for cart items/products.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_items_general_settings() {

		return apply_filters(
			'addonify_floating_cart_items_general_settings',
			array(
				// @since 1.2.6
				'display_empty_cart_icon'   => array(
					'label'     => esc_html__( 'Display empty cart icon', 'addonify-floating-cart' ),
					'type'      => 'switch',
					'dependent' => array( 'enable_floating_cart' ),
					'value'     => addonify_floating_cart_get_option( 'display_empty_cart_icon' ),
				),
				// @since 1.2.4
				'empty_cart_text'           => array(
					'label'       => esc_html__( 'Empty cart text', 'addonify-floating-cart' ),
					'description' => esc_html__( 'Text to display when there are no items in the cart.', 'addonify-floating-cart' ),
					'type'        => 'text',
					'dependent'   => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'       => addonify_floating_cart_get_option( 'empty_cart_text' ),
				),
				// @since 1.2.4
				'product_removal_text'      => array(
					'label'     => esc_html__( 'Product removal notice text', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'     => addonify_floating_cart_get_option( 'product_removal_text' ),
				),
				// @since 1.2.4
				'product_removal_undo_text' => array(
					'label'     => esc_html__( 'Product removal undo link label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'     => addonify_floating_cart_get_option( 'product_removal_undo_text' ),
				),
			)
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_items_general_settings() );
		}
	);
}
