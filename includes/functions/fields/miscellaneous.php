<?php
/**
 * Define settings fields for cart miscellaneous.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_misc_settings' ) ) {
	/**
	 * Define general settings for cart miscellaneous.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_misc_settings() {

		return apply_filters(
			'addonify_floating_cart_misc_settings',
			array(
				'cart_badge_items_total_count'          => array(
					'label'     => esc_html__( 'Cart items count badge content', 'addonify-floating-cart' ),
					'type'      => 'select',
					'dependent' => array( 'enable_floating_cart', 'display_cart_modal_toggle_button', 'display_cart_items_number_badge' ),
					'choices'   => array(
						'total_products'            => esc_html__( 'Total Products Types', 'addonify-floating-cart' ),
						'total_products_quantities' => esc_html__( 'Total Product Quantities', 'addonify-floating-cart' ),
					),
					'value'     => addonify_floating_cart_get_option( 'cart_badge_items_total_count' ),
				),
				// @since 1.2.4
				'coupon_shipping_form_modal_exit_label' => array(
					'label'     => esc_html__( 'Coupon and shipping form modal exit label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'     => addonify_floating_cart_get_option( 'coupon_shipping_form_modal_exit_label' ),
				),
				// @since 1.2.6
				'invalid_security_token_message'        => array(
					'label'       => esc_html__( 'Invalid security token message', 'addonify-floating-cart' ),
					'description' => esc_html__( 'Token error message displayed in case security token is invalid when making AJAX request.', 'addonify-floating-cart' ),
					'type'        => 'text',
					'dependent'   => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'       => addonify_floating_cart_get_option( 'invalid_security_token_message' ),
				),
			)
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_misc_settings() );
		}
	);
}
