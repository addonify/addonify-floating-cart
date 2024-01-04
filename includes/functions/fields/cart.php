<?php
/**
 * Define general settings fields for floating cart.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_cart_options_settings' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_cart_options_settings() {

		return array(
			'enable_floating_cart'                     => array(
				'label'       => esc_html__( 'Enable floating cart', 'addonify-floating-cart' ),
				'type'        => 'switch',
				'description' => esc_html__( 'If disabled, floating cart will be disabled completely.', 'addonify-floating-cart' ),
				'badge'       => esc_html__( 'Required', 'addonify-floating-cart' ),
				'value'       => addonify_floating_cart_get_option( 'enable_floating_cart' ),
			),
			'open_cart_modal_immediately_after_add_to_cart' => array(
				'label'     => esc_html__( 'Open cart modal on add to cart button click', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'open_cart_modal_immediately_after_add_to_cart' ),
			),
			'open_cart_modal_after_click_on_view_cart' => array(
				'label'     => esc_html__( 'Open cart on view cart button click', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'open_cart_modal_after_click_on_view_cart' ),
			),
			// @since 1.2.6
			'remove_product_from_cart_if_not_in_stock' => array(
				'label'     => esc_html__( 'Remove Product from cart if not in stock', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'remove_product_from_cart_if_not_in_stock' ),
			),
			// @since 1.2.4
			'enable_cart_labels_from_plugin'           => array(
				'label'     => esc_html__( 'Display labels from plugin', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'description' => esc_html__( 'Enable this option to create personalized labels. Once enabled, the user-defined labels will replace the default text strings.' ),
				'dependent' => array( 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'enable_cart_labels_from_plugin' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_cart_options_settings() );
		}
	);
}


if ( ! function_exists( 'addonify_floating_cart_cart_styles_settings_fields' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_cart_styles_settings_fields() {

		return array(
			'load_styles_from_plugin' => array(
				'label'       => esc_html__( 'Enable dymanic styles', 'addonify-floating-cart' ),
				'type'        => 'switch',
				'description' => esc_html__( 'Once enabled, below selected option will overwrite the default plugin stylesheet. ', 'addonify-floating-cart' ),
				'value'       => addonify_floating_cart_get_option( 'load_styles_from_plugin' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_cart_styles_settings_fields() );
		}
	);
}
