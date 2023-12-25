<?php
/**
 * Define settings fields for coupon.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions/fields
 */

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_coupon_settings() {

	return array(
		'display_applied_coupons'        => array(
			'label'       => __( 'Display applied coupons', 'addonify-floating-cart' ),
			'description' => __( 'Enable this option to display all applied coupons.', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'display_applied_coupons' ),
		),
		// @since 1.2.4
		'coupon_form_toggler_text'       => array(
			'label'     => __( 'Coupon form toggle link label', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'coupon_form_toggler_text' ),
		),
		// @since 1.2.4
		'coupon_from_description'        => array(
			'label'     => __( 'Coupon form description', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'coupon_from_description' ),
		),
		// @since 1.2.4
		'coupon_field_placeholder'       => array(
			'label'     => __( 'Coupon field placeholder', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'coupon_field_placeholder' ),
		),
		'cart_apply_coupon_button_label' => array(
			'label'       => __( 'Coupon apply button label', 'addonify-floating-cart' ),
			'type'        => 'text',
			'placeholder' => __( 'Apply coupon', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
			'value'       => addonify_floating_cart_get_option( 'cart_apply_coupon_button_label' ),
		),
		// @since 1.2.4
		'applied_coupons_list_title'     => array(
			'label'     => __( 'Applied coupons list title', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart', 'enable_cart_labels_from_plugin' ),
			'value'     => addonify_floating_cart_get_option( 'applied_coupons_list_title' ),
		),
	);
}


/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @param mixed $setting_fields Setting fields.
 * @return array
 */
function addonify_floating_cart_coupon_settings_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_coupon_settings() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_coupon_settings_add' );
