<?php
/**
 * Define settings fields for shipping.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_shipping_general_settings' ) ) {
	/**
	 * Define settings for shipping.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_shipping_general_settings() {

		return apply_filters(
			'addonify_floating_cart_shipping_general_settings',
			array(
				// @since 1.2.4
				'display_shipping_cost_in_cart_subtotal'  => array(
					'label'     => esc_html__( 'Display shipping cost in cart subtotals', 'addonify-floating-cart' ),
					'type'      => 'switch',
					'dependent' => array( 'enable_floating_cart' ),
					'value'     => addonify_floating_cart_get_option( 'display_shipping_cost_in_cart_subtotal' ),
				),
				'shipping_label'                          => array(
					'label'     => esc_html__( 'Shipping charge label in cart subtotals', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_shipping_cost_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'shipping_label' ),
				),
				'open_shipping_label'                     => array(
					'label'     => esc_html__( 'Shipping modal toggle link label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_shipping_cost_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'open_shipping_label' ),
				),
				'shipping_address_form_country_field_label' => array(
					'label'     => esc_html__( 'Shipping form country field label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_shipping_cost_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'shipping_address_form_country_field_label' ),
				),
				'shipping_address_form_state_field_label' => array(
					'label'     => esc_html__( 'Shipping form state field label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_shipping_cost_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'shipping_address_form_state_field_label' ),
				),
				'shipping_address_form_city_field_label'  => array(
					'label'     => esc_html__( 'Shipping form city field label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_shipping_cost_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'shipping_address_form_city_field_label' ),
				),
				'shipping_address_form_zip_code_field_label' => array(
					'label'     => esc_html__( 'Shipping form ZIP code label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_shipping_cost_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'shipping_address_form_zip_code_field_label' ),
				),
				'shipping_address_form_submit_button_label' => array(
					'label'     => esc_html__( 'Shipping form submit button label', 'addonify-floating-cart' ),
					'type'      => 'text',
					'dependent' => array(
						'enable_floating_cart',
						'enable_cart_labels_from_plugin',
						'display_shipping_cost_in_cart_subtotal',
					),
					'value'     => addonify_floating_cart_get_option( 'shipping_address_form_submit_button_label' ),
				),
			)
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_shipping_general_settings() );
		}
	);
}
