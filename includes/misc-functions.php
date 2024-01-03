<?php
/**
 * Definitions of miscellaneous functions.
 *
 * @since 1.1.5
 *
 * @package Addonify_Floating_Cart
 */

if ( ! function_exists( 'addonify_floating_cart_get_cart_modal_toggle_button_icons' ) ) {
	/**
	 * Get the icons for the cart modal toggle button.
	 *
	 * @since 1.1.5
	 *
	 * @return array Array of icons.
	 */
	function addonify_floating_cart_get_cart_modal_toggle_button_icons() {

		return apply_filters(
			'addonify_floating_cart_cart_modal_toggle_button_icons',
			array(
				'icon_1' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 17"><g></g><path d="M2.75 12.5c-0.965 0-1.75 0.785-1.75 1.75s0.785 1.75 1.75 1.75 1.75-0.785 1.75-1.75-0.785-1.75-1.75-1.75zM2.75 15c-0.413 0-0.75-0.337-0.75-0.75s0.337-0.75 0.75-0.75 0.75 0.337 0.75 0.75-0.337 0.75-0.75 0.75zM11.25 12.5c-0.965 0-1.75 0.785-1.75 1.75s0.785 1.75 1.75 1.75 1.75-0.785 1.75-1.75-0.785-1.75-1.75-1.75zM11.25 15c-0.413 0-0.75-0.337-0.75-0.75s0.337-0.75 0.75-0.75 0.75 0.337 0.75 0.75-0.337 0.75-0.75 0.75zM13.37 2l-0.301 2h-13.143l1.117 8.036h11.914l1.043-7.5 0.231-1.536h2.769v-1h-3.63zM12.086 11.036h-10.172l-0.84-6.036h11.852l-0.84 6.036zM11 10h-8v-3.969h1v2.969h6v-2.97h1v3.97zM4 2.969h-1v-1.969h8v1.906h-1v-0.906h-6v0.969z" /></svg>',
				'icon_2' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/></svg>',
				'icon_3' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/></svg>',
				'icon_4' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z"/></svg>',
				'icon_5' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/></svg>',
				'icon_6' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/></svg>',
				'icon_7' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/></svg>',
				'icon_8' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>',
			)
		);
	}
}


if ( ! function_exists( 'addonify_floating_cart_default_strings' ) ) {
	/**
	 * Translation ready strings displayed at the front-end.
	 *
	 * @since 1.2.4
	 *
	 * @return array
	 */
	function addonify_floating_cart_default_strings() {

		$default_strings = array(
			'added_to_cart_notification_text'            => esc_html__( '{product_name} has been added to cart.', 'addonify-floating-cart' ),
			'show_cart_button_label'                     => esc_html__( 'Show Cart', 'addonify-floating-cart' ),
			'cart_title'                                 => esc_html__( 'Cart', 'addonify-floating-cart' ),
			'continue_shopping_button_label'             => esc_html__( 'Close', 'addonify-floating-cart' ),
			'checkout_button_label'                      => esc_html__( 'Checkout', 'addonify-floating-cart' ),
			'sub_total_label'                            => esc_html__( 'Sub Total: ', 'addonify-floating-cart' ),
			'discount_label'                             => esc_html__( 'Discount:', 'addonify-floating-cart' ),
			'shipping_label'                             => esc_html__( 'Shipping:', 'addonify-floating-cart' ),
			'open_shipping_label'                        => esc_html__( 'Change address', 'addonify-floating-cart' ),
			'tax_label'                                  => esc_html__( 'Tax:', 'addonify-floating-cart' ),
			'total_label'                                => esc_html__( 'Total:', 'addonify-floating-cart' ),
			'coupon_shipping_form_modal_exit_label'      => esc_html__( 'Go Back', 'addonify-floating-cart' ), // @since 1.2.4
			'empty_cart_text'                            => esc_html__( 'Your cart is currently empty.', 'addonify-floating-cart' ), // @since 1.2.4
			'product_removal_text'                       => esc_html__( '{product_name} has been removed.', 'addonify-floating-cart' ), // @since 1.2.4
			'product_removal_undo_text'                  => esc_html__( 'Undo?', 'addonify-floating-cart' ), // @since 1.2.4
			'item_counter_singular_text'                 => esc_html__( 'Item', 'addonify-floating-cart' ), // @since 1.2.4
			'item_counter_plural_text'                   => esc_html__( 'Items', 'addonify-floating-cart' ), // @since 1.2.4
			// Coupon modal texts.
			'coupon_form_toggler_text'                   => esc_html__( 'Have a coupon?', 'addonify-floating-cart' ), // @since 1.2.4
			'coupon_field_label'                         => esc_html__( 'Coupon code', 'addonify-floating-cart' ), // @since 1.2.6
			'coupon_field_placeholder'                   => '', // @since 1.2.4
			'applied_coupons_list_title'                 => esc_html__( 'Applied coupon:', 'addonify-floating-cart' ), // @since 1.2.4
			'cart_apply_coupon_button_label'             => esc_html__( 'Apply Coupon', 'addonify-floating-cart' ),
			'coupon_removed_message'                     => esc_html__( 'Coupon has been removed.', 'addonify-floating-cart' ), // @since 1.2.6
			// Shipping modal texts.
			'shipping_address_form_country_field_label'  => esc_html__( 'Country / Region', 'addonify-floating-cart' ), // @since 1.2.6
			'shipping_address_form_state_field_label'    => esc_html__( 'State', 'addonify-floating-cart' ), // @since 1.2.6
			'shipping_address_form_city_field_label'     => esc_html__( 'City', 'addonify-floating-cart' ), // @since 1.2.6
			'shipping_address_form_zip_code_field_label' => esc_html__( 'ZIP code', 'addonify-floating-cart' ), // @since 1.2.6
			'shipping_address_form_submit_button_label'  => esc_html__( 'Update address', 'addonify-floating-cart' ), // @since 1.2.6
			// Miscellaneous texts.
			'invalid_security_token_message'             => esc_html__( 'Invalid security token.', 'addonify-floating-cart' ), // @since 1.2.6
		);

		return apply_filters(
			'addonify_floating_cart_default_strings',
			$default_strings
		);
	}
}
