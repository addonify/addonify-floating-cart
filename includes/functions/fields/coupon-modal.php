<?php
/**
 * Define settings fields for coupon modal.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

if ( ! function_exists( 'addonify_floating_cart_coupon_modal_general_settings' ) ) {
	/**
	 * Define settings for coupon modal.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_coupon_modal_general_settings() {

		return array(
			// @since 1.2.4
			'coupon_form_toggler_text'       => array(
				'label'     => esc_html__( 'Coupon form toggle link label', 'addonify-floating-cart' ),
				'type'      => 'text',
				'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'coupon_form_toggler_text' ),
			),
			// @since 1.2.6
			'coupon_field_label'             => array(
				'label'     => esc_html__( 'Coupon field label', 'addonify-floating-cart' ),
				'type'      => 'text',
				'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'coupon_field_label' ),
			),
			// @since 1.2.4
			'coupon_field_placeholder'       => array(
				'label'     => esc_html__( 'Coupon field placeholder', 'addonify-floating-cart' ),
				'type'      => 'text',
				'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'coupon_field_placeholder' ),
			),
			'cart_apply_coupon_button_label' => array(
				'label'       => esc_html__( 'Coupon apply button label', 'addonify-floating-cart' ),
				'type'        => 'text',
				'placeholder' => esc_attr__( 'Apply coupon', 'addonify-floating-cart' ),
				'dependent'   => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
				'value'       => addonify_floating_cart_get_option( 'cart_apply_coupon_button_label' ),
			),
			'display_applied_coupons'        => array(
				'label'       => esc_html__( 'Display applied coupons', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Enable this option to display all applied coupons.', 'addonify-floating-cart' ),
				'type'        => 'switch',
				'dependent'   => array( 'enable_floating_cart' ),
				'value'       => addonify_floating_cart_get_option( 'display_applied_coupons' ),
			),
			// @since 1.2.4
			'applied_coupons_list_title'     => array(
				'label'     => esc_html__( 'Applied coupons list title', 'addonify-floating-cart' ),
				'type'      => 'text',
				'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin', 'display_applied_coupons' ),
				'value'     => addonify_floating_cart_get_option( 'applied_coupons_list_title' ),
			),
			// @since 1.2.6
			'coupon_removed_message'         => array(
				'label'     => esc_html__( 'Coupon removal message', 'addonify-floating-cart' ),
				'type'      => 'text',
				'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'coupon_removed_message' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_coupon_modal_general_settings() );
		}
	);
}
