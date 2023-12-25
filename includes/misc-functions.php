<?php
/**
 * Definitions of miscellaneous functions.
 *
 * @since 1.2.4
 *
 * @package Addonify_Floating_Cart
 */

if ( ! function_exists( 'addonify_floating_cart_default_strings' ) ) {
	/**
	 * Translation ready strings displayed at the front-end.
	 *
	 * @since 1.2.4
	 *
	 * @return array
	 */
	function addonify_floating_cart_default_strings() {

		return apply_filters(
			'addonify_floating_cart_default_strings',
			array(
				'added_to_cart_notification_text'       => esc_html__( '{product_name} has been added to cart.', 'addonify-floating-cart' ),
				'show_cart_button_label'                => esc_html__( 'Show Cart', 'addonify-floating-cart' ),
				'cart_title'                            => esc_html__( 'Cart', 'addonify-floating-cart' ),
				'continue_shopping_button_label'        => esc_html__( 'Close', 'addonify-floating-cart' ),
				'checkout_button_label'                 => esc_html__( 'Checkout', 'addonify-floating-cart' ),
				'sub_total_label'                       => esc_html__( 'Sub Total: ', 'addonify-floating-cart' ),
				'discount_label'                        => esc_html__( 'Discount:', 'addonify-floating-cart' ),
				'shipping_label'                        => esc_html__( 'Shipping:', 'addonify-floating-cart' ),
				'open_shipping_label'                   => esc_html__( 'Change address', 'addonify-floating-cart' ),
				'tax_label'                             => esc_html__( 'Tax:', 'addonify-floating-cart' ),
				'total_label'                           => esc_html__( 'Total:', 'addonify-floating-cart' ),
				'coupon_shipping_form_modal_exit_label' => esc_html__( 'Go Back', 'addonify-floating-cart' ), // @since 1.2.4
				'empty_cart_text'                       => esc_html__( 'Your cart is currently empty.', 'addonify-floating-cart' ), // @since 1.2.4
				'product_removal_text'                  => esc_html__( '{product_name} has been removed.', 'addonify-floating-cart' ), // @since 1.2.4
				'product_removal_undo_text'             => esc_html__( 'Undo?', 'addonify-floating-cart' ), // @since 1.2.4
				'item_counter_singular_text'            => esc_html__( 'Item', 'addonify-floating-cart' ), // @since 1.2.4
				'item_counter_plural_text'              => esc_html__( 'Items', 'addonify-floating-cart' ), // @since 1.2.4
				'coupon_form_toggler_text'              => esc_html__( 'Have a coupon?', 'addonify-floating-cart' ), // @since 1.2.4
				'coupon_from_description'               => esc_html__( 'If you have a coupon code, please apply it below.', 'addonify-floating-cart' ), // @since 1.2.4
				'coupon_field_placeholder'              => esc_html__( 'Coupon code', 'addonify-floating-cart' ), // @since 1.2.4
				'applied_coupons_list_title'            => esc_html__( 'Applied coupon:', 'addonify-floating-cart' ), // @since 1.2.4
				'cart_apply_coupon_button_label'        => esc_html__( 'Apply Coupon', 'addonify-floating-cart' ),
			)
		);
	}
}


if ( ! function_exists( 'addonify_floating_cart_get_cart_strings' ) ) {
	/**
	 * Checks if cart strings is enabled from plugin. If found enabled, returns cart strings from the setting. Else returns default strings.
	 *
	 * @since 1.2.4
	 *
	 * @return array
	 */
	function addonify_floating_cart_get_cart_strings() {

		$default_strings = addonify_floating_cart_default_strings();

		if ( addonify_floating_cart_get_option( 'enable_cart_labels_from_plugin' ) === '1' ) {

			$saved_strings = array();

			foreach ( $default_strings as $index => $label ) {

				$index_string = addonify_floating_cart_get_option( $index );

				$saved_strings[ $index ] = ( $index_string ) ? $index_string : $default_strings[ $index ];
			}

			return $saved_strings;
		}

		return $default_strings;
	}
}


if ( ! function_exists( 'addonify_floating_cart_get_setting_values' ) ) {
	/**
	 * Get admin setting values.
	 *
	 * @since 1.2.4
	 *
	 * @return array
	 */
	function addonify_floating_cart_get_setting_values() {

		$settings = addonify_floating_cart_settings_fields_defaults();

		$values = array();

		if ( $settings ) {
			foreach ( $settings as $key => $value ) {
				$values[ $key ] = addonify_floating_cart_get_option( $key );
			}
		}

		return $values;
	}
}
