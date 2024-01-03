<?php
/**
 * Define settings fields for cart subtotals.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_subtotals_general_settings' ) ) {
	/**
	 * Define general settings for cart subtotals.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_subtotals_general_settings() {

		return apply_filters(
			'addonify_floating_cart_subtotals_general_settings',
			array(
				// @since 1.2.4
				'display_taxes_in_cart_subtotal' => array(
					'label'     => esc_html__( 'Display taxes', 'addonify-floating-cart' ),
					'type'      => 'switch',
					'dependent' => array( 'enable_floating_cart' ),
					'value'     => addonify_floating_cart_get_option( 'display_taxes_in_cart_subtotal' ),
				),
				'sub_total_label'                => array(
					'label'     => esc_html__( 'Sub total label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'     => addonify_floating_cart_get_option( 'sub_total_label' ),
				),
				'discount_label'                 => array(
					'label'     => esc_html__( 'Discount label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'     => addonify_floating_cart_get_option( 'discount_label' ),
				),
				'tax_label'                      => array(
					'label'     => esc_html__( 'Tax label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_taxes_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'tax_label' ),
				),
				'total_label'                    => array(
					'label'     => esc_html__( 'Total label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
					'value'     => addonify_floating_cart_get_option( 'total_label' ),
				),
			)
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_subtotals_general_settings() );
		}
	);
}
