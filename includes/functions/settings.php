<?php
/**
 * Define admin settings fields.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes/functions
 */

/**
 * Load general setting fields for floating cart.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart.php';
/**
 * Load general setting fields for cart header.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart-header.php';
/**
 * Load general setting fields for cart items/products.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart-items.php';
/**
 * Load general setting fields for cart subtotals.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart-subtotals.php';
/**
 * Load general setting fields for cart buttons.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart-buttons.php';
/**
 * Load setting fields for coupon modal.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/coupon-modal.php';
/**
 * Load setting fields for shipping modal.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/shipping.php';
/**
 * Load general setting fields for cart miscellaneous.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/miscellaneous.php';
/**
 * Load setting fields for floating cart toggle button.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/toggle-button.php';
/**
 * Load setting fields for toast notification.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/toast-notification.php';
/**
 * Load setting fields for cart content.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart-display.php';
/**
 * Load setting fields for shopping meter.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/shopping-meter.php';
/**
 * Load setting fields for adding Custom CSS.
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/custom-css.php';

/**
 * Define default values for the settings fields.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_settings_fields_defaults() {

	$cart_strings = addonify_floating_cart_default_strings();

	return apply_filters(
		'addonify_floating_cart_settings_fields_defaults',
		array(
			// Main cart settings options.
			'enable_floating_cart'                         => true,
			'open_cart_modal_immediately_after_add_to_cart' => true,
			'open_cart_modal_after_click_on_view_cart'     => false,
			'remove_product_from_cart_if_not_in_stock'     => false,
			'enable_shopping_meter'                        => false,
			'customer_shopping_meter_threshold'            => 1000,
			'include_discount_amount_in_threshold'         => false,
			'customer_shopping_meter_pre_threshold_label'  => '',
			'customer_shopping_meter_post_threshold_label' => '',
			'display_taxes_in_cart_subtotal'               => true, // @since 1.2.4
			'load_styles_from_plugin'                      => true,

			// Floating Cart Toggle Button Options.
			'display_cart_modal_toggle_button'             => '1',
			'hide_modal_toggle_button_on_empty_cart'       => false,
			'cart_modal_toggle_button_display_position'    => 'bottom-right',
			'display_cart_items_number_badge'              => '1',
			'cart_items_number_badge_position'             => 'top-left',
			'cart_badge_items_total_count'                 => 'total_products',
			'cart_modal_toggle_button_icon'                => 'icon_1',
			'toggle_button_badge_width'                    => 23,
			'toggle_button_badge_font_size'                => 13,
			'toggle_button_badge_background_color'         => '',
			'toggle_button_badge_on_hover_background_color' => '',
			'toggle_button_badge_label_color'              => '',
			'toggle_button_label_color'                    => '',
			'toggle_button_label_on_hover_color'           => '',
			'toggle_button_background_color'               => '',
			'toggle_button_border_color'                   => '',
			'toggle_button_on_hover_label_color'           => '',
			'toggle_button_on_hover_background_color'      => '',
			'toggle_button_on_hover_border_color'          => '',
			'cart_modal_toggle_button_width'               => 60,
			'cart_modal_toggle_button_border_radius'       => 5,
			'cart_modal_toggle_button_icon_font_size'      => 20,
			'cart_modal_toggle_button_horizontal_offset'   => 100,
			'cart_modal_toggle_button_vertical_offset'     => 100,

			// Toast notification options.
			'display_toast_notification'                   => true,
			'toast_notification_display_position'          => 'top-right',
			'added_to_cart_notification_text'              => $cart_strings['added_to_cart_notification_text'],
			'close_notification_after_time'                => 5,
			'display_close_notification_button'            => false,
			'display_show_cart_button'                     => false,
			'show_cart_button_label'                       => $cart_strings['show_cart_button_label'],
			'toast_notification_background_color'          => '',
			'toast_notification_text_color'                => '',
			'toast_notification_icon_color'                => '',
			'toast_notification_icon_bg_color'             => '',
			'toast_notification_button_background_color'   => '',
			'toast_notification_button_label_color'        => 'white',
			'toast_notification_button_on_hover_background_color' => '',
			'toast_notification_button_on_hover_label_color' => 'white',
			'toast_notification_horizontal_offset'         => '',
			'toast_notification_vertical_offset'           => '',

			// Cart modal options.
			'open_cart_modal_on_trigger_button_mouse_hover' => false,
			'cart_position'                                => 'right',
			'cart_title'                                   => $cart_strings['cart_title'],
			'cart_title_font_size'                         => 14,
			'cart_title_font_weight'                       => '400',
			'cart_title_letter_spacing'                    => 0.25,
			'cart_title_text_transform'                    => 'none',
			'display_cart_items_number'                    => true,
			'close_cart_modal_on_overlay_click'            => true,
			'display_button_before_checkout_button'        => true,
			'display_continue_shopping_button'             => true,
			'continue_shopping_button_action'              => 'default',
			'enable_cart_labels_from_plugin'               => false, // @since 1.2.4
			'continue_shopping_button_label'               => $cart_strings['continue_shopping_button_label'],
			'checkout_button_label'                        => $cart_strings['checkout_button_label'],
			'sub_total_label'                              => $cart_strings['sub_total_label'],
			'discount_label'                               => $cart_strings['discount_label'],
			'tax_label'                                    => $cart_strings['tax_label'],
			'total_label'                                  => $cart_strings['total_label'],
			'coupon_shipping_form_modal_exit_label'        => $cart_strings['coupon_shipping_form_modal_exit_label'], // @since 1.2.4
			'display_empty_cart_icon'                      => false, // @since 1.2.6
			'empty_cart_text'                              => $cart_strings['empty_cart_text'], // @since 1.2.4
			'product_removal_text'                         => $cart_strings['product_removal_text'], // @since 1.2.4
			'product_removal_undo_text'                    => $cart_strings['product_removal_undo_text'], // @since 1.2.4
			'item_counter_singular_text'                   => $cart_strings['item_counter_singular_text'], // @since 1.2.4
			'item_counter_plural_text'                     => $cart_strings['item_counter_plural_text'], // @since 1.2.4
			'invalid_security_token_message'               => $cart_strings['invalid_security_token_message'], // @since 1.2.6

			// Shipping modal options.
			'display_shipping_cost_in_cart_subtotal'       => true, // @since 1.2.4
			'shipping_label'                               => $cart_strings['shipping_label'],
			'open_shipping_label'                          => $cart_strings['open_shipping_label'],
			'shipping_address_form_country_field_label'    => $cart_strings['shipping_address_form_country_field_label'],
			'shipping_address_form_state_field_label'      => $cart_strings['shipping_address_form_state_field_label'],
			'shipping_address_form_city_field_label'       => $cart_strings['shipping_address_form_city_field_label'],
			'shipping_address_form_zip_code_field_label'   => $cart_strings['shipping_address_form_zip_code_field_label'],
			'shipping_address_form_submit_button_label'    => $cart_strings['shipping_address_form_submit_button_label'],

			'cart_modal_width'                             => 500,
			'cart_modal_base_font_size'                    => 15,
			'cart_modal_background_color'                  => '',
			'cart_modal_base_text_color'                   => '',
			'cart_modal_overlay_color'                     => '',
			'cart_modal_content_link_color'                => '',
			'cart_modal_content_link_on_hover_color'       => '',
			'cart_modal_border_color'                      => '',
			'cart_modal_title_color'                       => '',
			'cart_modal_badge_background_color'            => '',
			'cart_modal_badge_text_color'                  => '',
			'cart_modal_close_icon_color'                  => '',
			'cart_modal_close_icon_on_hover_color'         => '',
			'cart_modal_product_title_color'               => '',
			'cart_modal_product_title_on_hover_color'      => '',
			'cart_modal_product_title_font_size'           => 15,
			'cart_modal_product_title_font_weight'         => '400',
			'cart_modal_product_quantity_price_color'      => '',
			'cart_modal_product_remove_button_background_color' => '',
			'cart_modal_product_remove_button_icon_color'  => '',
			'cart_modal_product_remove_button_on_hover_background_color' => '',
			'cart_modal_product_remove_button_on_hover_icon_color' => '',

			// Buttons style.
			'cart_modal_buttons_font_size'                 => 14,
			'cart_modal_buttons_font_weight'               => '400',
			'cart_modal_primary_button_background_color'   => '',
			'cart_modal_primary_button_label_color'        => '',
			'cart_modal_primary_button_border_color'       => '',
			'cart_modal_primary_button_on_hover_background_color' => '',
			'cart_modal_primary_button_on_hover_label_color' => '',
			'cart_modal_primary_button_on_hover_border_color' => '',
			'cart_modal_secondary_button_background_color' => '',
			'cart_modal_secondary_button_label_color'      => '',
			'cart_modal_secondary_button_border_color'     => '',
			'cart_modal_secondary_button_on_hover_background_color' => '',
			'cart_modal_secondary_button_on_hover_label_color' => '',
			'cart_modal_secondary_button_on_hover_border_color' => '',

			// Misc design options.
			'cart_modal_input_field_placeholder_color'     => '',
			'cart_modal_input_field_text_color'            => '',
			'cart_modal_input_field_border_color'          => '',
			'cart_modal_input_field_background_color'      => '',
			'cart_shopping_meter_initial_background_color' => '',
			'cart_shopping_meter_progress_background_color' => '',
			'cart_shopping_meter_threashold_reached_background_color' => '',

			'cart_modal_buttons_font_size'                 => 14,
			'cart_modal_buttons_font_weight'               => '400',
			'cart_modal_buttons_letter_spacing'            => 0.25,
			'cart_modal_buttons_text_transform'            => 'none',
			'cart_modal_buttons_border_radius'             => 3,
			'cart_modal_primary_button_label_color'        => '',
			'cart_modal_primary_button_background_color'   => '',
			'cart_modal_primary_button_border_color'       => '',
			'cart_modal_primary_button_on_hover_label_color' => '',
			'cart_modal_primary_button_on_hover_background_color' => '',
			'cart_modal_primary_button_on_hover_border_color' => '',
			'cart_modal_secondary_button_label_color'      => '',
			'cart_modal_secondary_button_background_color' => '',
			'cart_modal_secondary_button_border_color'     => '',
			'cart_modal_secondary_button_on_hover_label_color' => '',
			'cart_modal_secondary_button_on_hover_background_color' => '',
			'cart_modal_secondary_button_on_hover_border_color' => '',

			// cart coupon options.
			'display_applied_coupons'                      => true,
			'coupon_form_toggler_text'                     => $cart_strings['coupon_form_toggler_text'], // @since 1.2.4
			'coupon_field_label'                           => $cart_strings['coupon_field_label'], // @since 1.2.6
			'coupon_field_placeholder'                     => $cart_strings['coupon_field_placeholder'], // @since 1.2.4
			'cart_apply_coupon_button_label'               => $cart_strings['cart_apply_coupon_button_label'],
			'applied_coupons_list_title'                   => $cart_strings['applied_coupons_list_title'], // @since 1.2.4
			'coupon_removed_message'                       => $cart_strings['coupon_removed_message'], // @since 1.2.6

			'custom_css'                                   => '',
		)
	);
}

/**
 * Define settings fields.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_settings_fields() {

	return apply_filters( 'addonify_floating_cart_settings_fields', array() );
}

/**
 * Retrieve the value of a settings field.
 *
 * @since 1.0.0
 * @param string $setting_id Setting ID.
 * @return mixed
 */
function addonify_floating_cart_get_option( $setting_id ) {

	$defaults = addonify_floating_cart_settings_fields_defaults();

	return get_option( ADDONIFY_FLOATING_CART_DB_INITIALS . $setting_id, $defaults[ $setting_id ] );
}

/**
 * Create and return array of setting_id and respective setting_value of settings fields.
 *
 * @since 1.0.0
 * @param string $setting_id Setting ID.
 * @return array
 */
function addonify_floating_cart_get_settings_fields_values( $setting_id = '' ) {

	$setting_fields = addonify_floating_cart_settings_fields();

	if ( ! empty( $setting_id ) ) {

		return addonify_floating_cart_get_option( $setting_id );
	} else {

		$key_values = array();

		foreach ( $setting_fields as $key => $value ) {

			$field_type = $value['type'];

			switch ( $field_type ) {
				case 'text':
					$key_values[ $key ] = addonify_floating_cart_get_option( $key );
					break;
				case 'switch':
					$key_values[ $key ] = ( addonify_floating_cart_get_option( $key ) === '1' ) ? true : false;
					break;
				case 'checkbox':
					$key_values[ $key ] = addonify_floating_cart_get_option( $key ) ? json_decode( addonify_floating_cart_get_option( $key ), true ) : array();
					break;
				case 'select':
					$key_values[ $key ] = ( addonify_floating_cart_get_option( $key ) === '' ) ? 'Choose value' : addonify_floating_cart_get_option( $key );
					break;
				case 'color':
					$key_values[ $key ] = addonify_floating_cart_get_option( $key );
					break;
				default:
					$key_values[ $key ] = addonify_floating_cart_get_option( $key );
					break;
			}
		}

		return $key_values;
	}
}

/**
 * Create and return array of setting_id and respective setting_value of settings fields.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_get_setting_fields() {

	return array(
		'settings_values' => addonify_floating_cart_get_settings_fields_values(),
		'tabs'            => array(
			'settings' => array(
				'sections' => array(
					'general'            => array(
						'title'       => esc_html__( 'General Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_cart_options_settings(),
					),
					'button'             => array(
						'title'       => esc_html__( 'Cart Toggle Button Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_toggle_cart_button_settings(),
					),
					'cart'               => array(
						'title'       => esc_html__( 'Cart Modal Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_cart_display_settings(),
					),
					'cart_header'        => array(
						'title'       => esc_html__( 'Cart Header Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_header_general_settings(),
					),
					'cart_items'         => array(
						'title'       => esc_html__( 'Cart Products Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_items_general_settings(),
					),
					'cart_subtotals'     => array(
						'title'       => esc_html__( 'Cart Subtotals Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_subtotals_general_settings(),
					),
					'cart_buttons'       => array(
						'title'       => esc_html__( 'Cart Buttons Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_buttons_general_settings(),
					),
					'cart_misc'          => array(
						'title'       => esc_html__( 'Cart Miscellaneous Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_misc_settings(),
					),
					'coupon_modal'       => array(
						'title'       => esc_html__( 'Coupon Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_coupon_modal_general_settings(),
					),
					'shipping'           => array(
						'title'       => esc_html__( 'Shipping Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_shipping_general_settings(),
					),
					'shopping_meter'     => array(
						'title'       => esc_html__( 'Shopping Meter Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_shopping_meter_general_settings(),
					),
					'toast-notification' => array(
						'title'       => esc_html__( 'Toast Notification Options', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_toast_notification_settings(),
					),
				),
			),
			'styles'   => array(
				'sections' => array(
					'general'            => array(
						'title'       => esc_html__( 'Interface Design', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_cart_styles_settings_fields(),
					),
					'button'             => array(
						'title'       => esc_html__( 'Cart Toggle Button', 'addonify-floating-cart' ),
						'description' => '',
						'type'        => 'render-jumbo-box',
						'fields'      => addonify_floating_cart_toggle_cart_button_designs(),
					),
					'toast-notification' => array(
						'title'       => esc_html__( 'Toast Notification', 'addonify-floating-cart' ),
						'description' => '',
						'type'        => 'render-jumbo-box',
						'fields'      => addonify_floating_cart_toast_notification_designs(),
					),
					'cart'               => array(
						'title'       => esc_html__( 'Cart Panel', 'addonify-floating-cart' ),
						'description' => '',
						'type'        => 'render-jumbo-box',
						'fields'      => addonify_floating_cart_cart_display_designs(),
					),
					'cart-buttons'       => array(
						'title'       => esc_html__( 'Buttons in Cart', 'addonify-floating-cart' ),
						'description' => '',
						'type'        => 'render-jumbo-box',
						'fields'      => addonify_floating_cart_cart_buttons_display_designs(),
					),
					'cart-misc'          => array(
						'title'       => esc_html__( 'Miscellaneous Cart Elements', 'addonify-floating-cart' ),
						'description' => '',
						'type'        => 'render-jumbo-box',
						'fields'      => addonify_floating_cart_cart_misc_display_designs(),
					),
					'cart-products'      => array(
						'title'       => esc_html__( 'Products in Cart', 'addonify-floating-cart' ),
						'description' => '',
						'type'        => 'render-jumbo-box',
						'fields'      => addonify_floating_cart_cart_products_display_designs(),
					),
					'custom_css'         => array(
						'title'       => esc_html__( 'Developer', 'addonify-floating-cart' ),
						'description' => '',
						'fields'      => addonify_floating_cart_custom_css_settings_fields(),
					),
				),
			),
		),
	);
}


/**
 * Update plugin's setting options' values.
 *
 * Checks the type of each setting options, sanitizes the value and updates the option's value.
 *
 * @since 1.0.0
 * @param array $settings Array of options values.
 * @return boolean true on successful update else false.
 */
function addonify_floating_cart_update_settings( $settings = '' ) {

	if (
		is_array( $settings ) &&
		count( $settings ) > 0
	) {
		$setting_fields = addonify_floating_cart_settings_fields();

		foreach ( $settings as $id => $value ) {

			$sanitized_value = null;

			$setting_type = $setting_fields[ $id ]['type'];

			switch ( $setting_type ) {
				case 'text':
					$sanitized_value = sanitize_text_field( $value );
					break;
				case 'textarea':
					$sanitized_value = sanitize_textarea_field( $value );
					break;
				case 'switch':
					$sanitized_value = ( true === $value ) ? '1' : '0';
					break;
				case 'number':
					$sanitized_value = is_numeric( $value ) ? $value : 0;
					break;
				case 'color':
					$sanitized_value = sanitize_text_field( $value );
					break;
				case 'select':
				case 'radio':
					$setting_choices = $setting_fields[ $id ]['choices'];
					$sanitized_value = ( array_key_exists( $value, $setting_choices ) ) ? sanitize_text_field( $value ) : $setting_choices[0];
					break;
				case 'checkbox':
					$sanitize_args   = array(
						'choices' => $setting_fields[ $id ]['choices'],
						'values'  => $value,
					);
					$sanitized_value = addonify_floating_cart_sanitize_multi_choices( $sanitize_args );
					$sanitized_value = wp_json_encode( $value );
					break;
				default:
					$sanitized_value = sanitize_text_field( $value );
			}

			if ( ! update_option( ADDONIFY_FLOATING_CART_DB_INITIALS . $id, $sanitized_value ) ) {
				return false;
			}
		}

		return true;
	}
}


/**
 * Sanitize multiple choices values.
 *
 * @since 1.0.0
 * @param array $args Multichoices and values.
 * @return array $sanitized_values
 */
function addonify_floating_cart_sanitize_multi_choices( $args ) {

	if (
		is_array( $args['choices'] ) &&
		count( $args['choices'] ) &&
		is_array( $args['values'] ) &&
		count( $args['values'] )
	) {

		$sanitized_values = array();

		foreach ( $args['values'] as $value ) {

			if ( array_key_exists( $value, $args['choices'] ) ) {

				$sanitized_values[] = $value;
			}
		}

		return $sanitized_values;
	}

	return array();
}
