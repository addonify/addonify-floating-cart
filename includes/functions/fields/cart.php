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

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_options_settings() {

	return array(
		'enable_floating_cart'                          => array(
			'label'       => __( 'Enable floating cart', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'description' => __( 'If disabled, floating cart will be disabled completely.', 'addonify-floating-cart' ),
			'badge'       => __( 'Required', 'addonify-floating-cart' ),
			'value'       => addonify_floating_cart_get_option( 'enable_floating_cart' ),
		),
		'open_cart_modal_immediately_after_add_to_cart' => array(
			'label'     => __( 'Open cart modal on add to cart button click', 'addonify-floating-cart' ),
			'type'      => 'switch',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'open_cart_modal_immediately_after_add_to_cart' ),
		),
		'open_cart_modal_after_click_on_view_cart'      => array(
			'label'     => __( 'Open cart on view cart button click', 'addonify-floating-cart' ),
			'type'      => 'switch',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'open_cart_modal_after_click_on_view_cart' ),
		),
		'enable_shopping_meter'                         => array(
			'label'     => __( 'Enable shopping meter', 'addonify-floating-cart' ),
			'type'      => 'switch',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'enable_shopping_meter' ),
		),
		'customer_shopping_meter_threshold'             => array(
			'label'       => __( 'Shopping meter threshold amount', 'addonify-floating-cart' ),
			'description' => __( 'Minimum amount that a customer need to spend.', 'addonify-floating-cart' ),
			'type'        => 'number',
			'style'       => 'buttons-plus-minus',
			'min'         => 0,
			'step'        => 10,
			'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
			'value'       => addonify_floating_cart_get_option( 'customer_shopping_meter_threshold' ),
		),
		'include_discount_amount_in_threshold'          => array(
			'label'       => __( 'Calculate threshold amount including discount', 'addonify-floating-cart' ),
			'description' => __( 'When enabled, {amount}=(threshold-(subtotal-discount)). Normally, {amount} = (threshold-subtotal)', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
			'value'       => addonify_floating_cart_get_option( 'include_discount_amount_in_threshold' ),
		),
		'customer_shopping_meter_pre_threshold_label'   => array(
			'label'       => __( 'Initial shopping meter notice', 'addonify-floating-cart' ),
			'description' => __( 'Notice that is displayed before a customer\'s cart amount meets the threshold amount. Use {amount} placeholder to display the shopping meter threshold amount.', 'addonify-floating-cart' ),
			'type'        => 'text',
			'className'   => 'fullwidth',
			'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
			'value'       => addonify_floating_cart_get_option( 'customer_shopping_meter_pre_threshold_label' ),
		),
		'customer_shopping_meter_post_threshold_label'  => array(
			'label'       => __( 'Final shopping meter notice', 'addonify-floating-cart' ),
			'description' => __( 'Notice that is displayed after a customer\'s cart amount meets the threshold amount.', 'addonify-floating-cart' ),
			'type'        => 'text',
			'className'   => 'fullwidth',
			'dependent'   => array( 'enable_floating_cart', 'enable_shopping_meter' ),
			'value'       => addonify_floating_cart_get_option( 'customer_shopping_meter_post_threshold_label' ),
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
function addonify_floating_cart_cart_options_add_to_settings_field( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_options_settings() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_options_add_to_settings_field' );


/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_styles_settings_fields() {

	return array(
		'load_styles_from_plugin' => array(
			'label'       => __( 'Enable dymanic styles', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'description' => __( 'Once enabled, below selected option will overwrite the default plugin stylesheet. ', 'addonify-floating-cart' ),
			'value'       => addonify_floating_cart_get_option( 'load_styles_from_plugin' ),
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
function addonify_floating_cart_general_styles_add_to_settings_fields( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_styles_settings_fields() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_general_styles_add_to_settings_fields' );
