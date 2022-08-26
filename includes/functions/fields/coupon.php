<?php
/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_coupon_settings() {

	return array(
		'display_applied_coupons'        => array(
			'label'       => __( 'Display Applied Coupons', 'addonify-floating-cart' ),
			'description' => __( 'Enable this option to display all applied coupons.', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'display_applied_coupons' ),
		),
		'cart_apply_coupon_button_label' => array(
			'label'       => __( 'Coupon Apply Button Label', 'addonify-floating-cart' ),
			'type'        => 'text',
			'placeholder' => __( 'Apply coupon', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'cart_apply_coupon_button_label' ),
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
