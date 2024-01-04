<?php
/**
 * Define settings fields for custom CSS.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_custom_css_settings_fields' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_custom_css_settings_fields() {

		return array(
			'custom_css' => array(
				'label'       => esc_html__( 'Custom CSS', 'addonify-floating-cart' ),
				'description' => esc_html__( 'If required, add your custom CSS code here.', 'addonify-floating-cart' ),
				'type'        => 'textarea',
				'className'   => 'fullwidth custom-css-box',
				'placeholder' => '#cart { color: blue; }',
				'dependent'   => array( 'load_styles_from_plugin' ),
				'value'       => addonify_floating_cart_get_option( 'custom_css' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_custom_css_settings_fields() );
		}
	);
}
