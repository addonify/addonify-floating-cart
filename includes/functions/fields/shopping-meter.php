<?php
/**
 * Define settings fields for shopping meter.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_shopping_meter_general_settings' ) ) {
	/**
	 * Define general settings for shopping meter.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_shopping_meter_general_settings() {

		return apply_filters(
			'addonify_floating_cart_shopping_meter_general_settings',
			array(
				'enable_shopping_meter'                => array(
					'label'     => esc_html__( 'Enable shopping meter', 'addonify-floating-cart' ),
					'type'      => 'switch',
					'dependent' => array( 'enable_floating_cart' ),
					'value'     => addonify_floating_cart_get_option( 'enable_shopping_meter' ),
				),
				'customer_shopping_meter_threshold'    => array(
					'label'       => esc_html__( 'Shopping meter threshold amount', 'addonify-floating-cart' ),
					'description' => esc_html__( 'Minimum amount that a customer need to spend.', 'addonify-floating-cart' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 0,
					'step'        => 10,
					'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
					'value'       => addonify_floating_cart_get_option( 'customer_shopping_meter_threshold' ),
				),
				'include_discount_amount_in_threshold' => array(
					'label'       => esc_html__( 'Calculate threshold amount including discount', 'addonify-floating-cart' ),
					'description' => esc_html__( 'When enabled, {amount}=(threshold-(subtotal-discount)). Normally, {amount} = (threshold-subtotal)', 'addonify-floating-cart' ),
					'type'        => 'switch',
					'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
					'value'       => addonify_floating_cart_get_option( 'include_discount_amount_in_threshold' ),
				),
				'customer_shopping_meter_pre_threshold_label' => array(
					'label'       => esc_html__( 'Initial shopping meter notice', 'addonify-floating-cart' ),
					'description' => esc_html__( 'Notice that is displayed before a customer\'s cart amount meets the threshold amount. Use {amount} placeholder to display the shopping meter threshold amount.', 'addonify-floating-cart' ),
					'type'        => 'text',
					'className'   => 'fullwidth',
					'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
					'value'       => addonify_floating_cart_get_option( 'customer_shopping_meter_pre_threshold_label' ),
				),
				'customer_shopping_meter_post_threshold_label' => array(
					'label'       => esc_html__( 'Final shopping meter notice', 'addonify-floating-cart' ),
					'description' => esc_html__( 'Notice that is displayed after a customer\'s cart amount meets the threshold amount.', 'addonify-floating-cart' ),
					'type'        => 'text',
					'className'   => 'fullwidth',
					'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
					'value'       => addonify_floating_cart_get_option( 'customer_shopping_meter_post_threshold_label' ),
				),
			)
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_shopping_meter_general_settings() );
		}
	);
}
