<?php

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/coupon.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/toggle-button.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/toast-notification.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart-display.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/custom-css.php';

/**
 * Define default values for the settings fields.
 *
 * @since 1.0.0
 * @return array
 */
if ( ! function_exists( 'addonify_floating_cart_settings_fields_defaults' ) ) {
    function addonify_floating_cart_settings_fields_defaults() {

        return apply_filters(
            'addonify_floating_cart/settings_fields_defaults',
            array(
                // Main cart settings options
                'enable_floating_cart' => true, 
                'open_cart_modal_immediately_after_add_to_cart' => false, 
                'open_cart_modal_after_click_on_view_cart' => true,
                'enable_shopping_meter' => true,
                'customer_shopping_meter_threshold' => 1000, 
                'customer_shopping_meter_pre_threshold_label' => '',
                'customer_shopping_meter_post_threshold_label' => '',
                'load_styles_from_plugin' => true, 
                
                // Floating Cart Toggle Button Options
                'display_cart_modal_toggle_button' => true, 
                'cart_modal_toggle_button_display_position' => 'bottom-right',
                'display_cart_items_number_badge' => true,
                'cart_items_number_badge_position' => 'top-left',
                'toggle_button_badge_width' => 23,
                'toggle_button_badge_font_size' => 13,
                'toggle_button_badge_background_color' => '', 
                'toggle_button_badge_label_color' => '',
                'toggle_button_label_color' => '',
                'toggle_button_background_color' => '',
                'toggle_button_border_color' => '',
                'toggle_button_on_hover_label_color' => '',
                'toggle_button_on_hover_background_color' => '',
                'toggle_button_on_hover_border_color' => '',
                'cart_modal_toggle_button_width' => 60,
                'cart_modal_toggle_button_border_radius' => 5,
                'cart_modal_toggle_button_icon_font_size' => 20,
                'cart_modal_toggle_button_horizontal_offset' => 100,
                'cart_modal_toggle_button_vertical_offset' => 100,

                // Toast notification options
                'display_toast_notification' => true,
                'toast_notification_display_position' => 'top-right',
                'open_cart_modal_on_notification_button_click' => false,
                'added_to_cart_notification_text' => '{product_name} has been added to cart.',
                'close_notification_after_time' => 5,
                'display_close_notification_button' => false,
                'display_show_cart_button' => false,
                'show_cart_button_label' => 'Show Cart',
                'toast_notification_background_color' => '',
                'toast_notification_text_color' => '',
                'toast_notification_button_background_color' => '',
                'toast_notification_button_label_color' => 'white',
                'toast_notification_button_on_hover_background_color' => '',
                'toast_notification_button_on_hover_label_color' => 'white',
                'toast_notification_horizontal_offset' => '', // Left
                'toast_notification_vertical_offset' => '', // Left

                // Cart modal options
                'cart_title' => 'Cart', 
                'cart_title_font_size' => 14,
                'cart_title_font_weight' => '400', 
                'cart_title_letter_spacing' => 0.25,
                'cart_title_text_transform' => 'none',
                'display_cart_items_number' => true,
                'close_cart_modal_on_overlay_click' => true,
                'display_continue_shopping_button' => true,
                'continue_shopping_button_label' => 'Close',
                'checkout_button_label' => 'Checkout',
                'display_product_removed_from_cart' => true, 

                'cart_modal_width' => 500, 
                'cart_modal_base_font_size' => 15,
                'cart_modal_background_color' => '', 
                'cart_modal_base_text_color' => '', 
                'cart_modal_overlay_color' => '', 
                'cart_modal_content_link_color' => '', 
                'cart_modal_content_link_on_hover_color' => '', 
                'cart_modal_border_color' => '', 
                'cart_modal_title_color' => '',
                'cart_modal_badge_background_color' => '',
                'cart_modal_badge_text_color' => '',
                'cart_modal_close_icon_color' => '',
                'cart_modal_close_icon_on_hover_color'  => '',
                'cart_modal_product_title_color' => '',
                'cart_modal_product_title_on_hover_color' => '',
                'cart_modal_product_title_font_size' => 15, 
                'cart_modal_product_title_font_weight'  => '400', 
                'cart_modal_product_quantity_price_color' => '',
                'cart_modal_product_remove_button_background_color' => '',
                'cart_modal_product_remove_button_icon_color' => '',
                'cart_modal_product_remove_button_on_hover_background_color' => '',
                'cart_modal_product_remove_button_on_hover_icon_color' => '',

                // Buttons style
                'cart_modal_buttons_font_size' => 14,
                'cart_modal_buttons_font_weight' => '400',
                'cart_modal_primary_button_background_color' => '',
                'cart_modal_primary_button_label_color' => '',
                'cart_modal_primary_button_border_color' => '',
                'cart_modal_primary_button_on_hover_background_color' => '',
                'cart_modal_primary_button_on_hover_label_color' => '',
                'cart_modal_primary_button_on_hover_border_color' => '',
                'cart_modal_secondary_button_background_color' => '',
                'cart_modal_secondary_button_label_color' => '',
                'cart_modal_secondary_button_border_color' => '',
                'cart_modal_secondary_button_on_hover_background_color' => '',
                'cart_modal_secondary_button_on_hover_label_color' => '',
                'cart_modal_secondary_button_on_hover_border_color' => '',
                
                // Misc design options
                'cart_modal_input_field_placeholder_color' => '',
                'cart_modal_input_field_text_color' => '',
                'cart_modal_input_field_border_color' => '',
                'cart_modal_input_field_background_color' => '',
                'cart_shopping_meter_initial_background_color'  => '',
                'cart_shopping_meter_progress_background_color'  => '',

                'cart_modal_buttons_font_size' => 14,
                'cart_modal_buttons_font_weight' => '400', 
                'cart_modal_buttons_letter_spacing' => 0.25,
                'cart_modal_buttons_text_transform' => 'none',
                'cart_modal_buttons_border_radius' => 3,
                'cart_modal_primary_button_label_color' => '',
                'cart_modal_primary_button_background_color' => '',
                'cart_modal_primary_button_border_color' => '',
                'cart_modal_primary_button_on_hover_label_color' => '',
                'cart_modal_primary_button_on_hover_background_color' => '',
                'cart_modal_primary_button_on_hover_border_color' => '',
                'cart_modal_secondary_button_label_color' => '',
                'cart_modal_secondary_button_background_color' => '',
                'cart_modal_secondary_button_border_color' => '',
                'cart_modal_secondary_button_on_hover_label_color' => '',
                'cart_modal_secondary_button_on_hover_background_color' => '',
                'cart_modal_secondary_button_on_hover_border_color' => '',
                
                // cart coupon options
                'display_applied_coupons' => true,
                'cart_apply_coupon_button_label' => 'Apply Coupon',

                'custom_css' => ''
            )
        );
    }
}

/**
 * Define settings fields.
 *
 * @since 1.0.0
 * @return array
 */
if ( ! function_exists( 'addonify_floating_cart_settings_fields' ) ) {

    function addonify_floating_cart_settings_fields() {

        return apply_filters( 'addonify_floating_cart/settings_fields', array() );
    }
}

/**
 * Retrieve the value of a settings field.
 *
 * @since 1.0.0
 * @param string $setting_id
 * @return mixed
 */
if ( ! function_exists( 'addonify_floating_cart_get_option' ) ) {

    function addonify_floating_cart_get_option( $setting_id ) {

        $defaults = addonify_floating_cart_settings_fields_defaults();

        return get_option( ADDONIFY_FLOATING_CART_DB_INITIALS . $setting_id, $defaults[ $setting_id ] );
    }
}

/**
 * Create and return array of setting_id and respective setting_value of settings fields.
 *
 * @since 1.0.0
 * @return array
 */
if ( ! function_exists( 'addonify_floating_cart_get_settings_fields_values' ) ) {

    function addonify_floating_cart_get_settings_fields_values( $setting_id = '' ) {

        $setting_fields = addonify_floating_cart_settings_fields();

        if ( !empty($setting_id)) {

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
                        $key_values[$key] = ( addonify_floating_cart_get_option( $key ) == '1' ) ? true : false;
                        break;

                    case 'checkbox':
                        $key_values[ $key ] = addonify_floating_cart_get_option( $key ) ? unserialize( addonify_floating_cart_get_option( $key ) ): [];
                        break;

                    case 'select':
                        $key_values[ $key ] = ( addonify_floating_cart_get_option( $key ) == '' ) ? 'Choose value' : addonify_floating_cart_get_option( $key );
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
}

if(!function_exists('addonify_floating_cart_get_setting_fields')){
    function addonify_floating_cart_get_setting_fields(){
        return array(
            'settings_values' => addonify_floating_cart_get_settings_fields_values(),
            'tabs' => array(
                'settings' => array(
                    'sections' => array(
                        'general' => array(
                            'title' => __('General', 'addonify-floating-cart'),
                            'description' => '',
                            'fields' => addonify_floating_cart_cart_options_settings()
                        ),
                        'button' => array(
                            'title' => __('Cart Toggle Button Options', 'addonify-floating-cart'),
                            'description' => '',
                            'fields' => addonify_floating_cart_toggle_cart_button_settings()
                        ),
                        'toast-notification' => array(
                            'title' => __('Toast Notification Options', 'addonify-floating-cart'),
                            'description' => '',
                            'fields' => addonify_floating_cart_toast_notification_settings()
                        ),
                        'cart' => array(
                            'title' => __('Cart Drawer/Modal Options', 'addonify-floating-cart'),
                            'description' => '',
                            'fields' => addonify_floating_cart_cart_display_settings()
                        ),
                        'coupon' => array(
                            'title' => __('Coupon Options', 'addonify-floating-cart'),
                            'description' => '',
                            'fields' => addonify_floating_cart_coupon_settings()
                        ),
                    ),
                ),
                'styles' => array(
                    'sections' => array(
                        'general' => array(
                            'title' => __('General', 'addonify-floating-cart'),
                            'description' => '',
                            'fields' => addonify_floating_cart_cart_styles_settings_fields()
                        ),
                        'button' => array(
                            'title' => __('Cart Toggle Button Design Options', 'addonify-floating-cart'),
                            'description' => '',
                            'type' => 'color-options-group',
                            'fields' => addonify_floating_cart_toggle_cart_button_designs()
                        ),
                        'toast-notification' => array(
                            'title' => __('Toast Notification Design Options', 'addonify-floating-cart'),
                            'description' => '',
                            'type' => 'color-options-group',
                            'fields' => addonify_floating_cart_toast_notification_designs()
                        ),
                        'cart' => array(
                            'title' => __('Cart Panel Design Options', 'addonify-floating-cart'),
                            'description' => '',
                            'type' => 'color-options-group',
                            'fields' => addonify_floating_cart_cart_display_designs()
                        ),
                        'cart-buttons' => array(
                            'title' => __('Buttons in Cart Design Options', 'addonify-floating-cart'),
                            'description' => '',
                            'type' => 'color-options-group',
                            'fields' => addonify_floating_cart_cart_buttons_display_designs()
                        ),
                        'cart-misc' => array(
                            'title' => __('Miscellaneous Cart Elements Design Options', 'addonify-floating-cart'),
                            'description' => '',
                            'type' => 'color-options-group',
                            'fields' => addonify_floating_cart_cart_misc_display_designs()
                        ),
                        'cart-products' => array(
                            'title' => __('Products in Cart Design Options', 'addonify-floating-cart'),
                            'description' => '',
                            'type' => 'color-options-group',
                            'fields' => addonify_floating_cart_cart_products_display_designs()
                        ),
                        'custom_css' => array(
                            'title' => __( 'Developer', 'addonify-floating-cart' ),
                            'description' => '',
                            'fields' => addonify_floating_cart_custom_css_settings_fields()
                        )
                        //'cart-secondary-button' => array(
                        //    'title' => __('Secondary Button in Cart Design Options', 'addonify-floating-cart'),
                        //    'description' => '',
                        //    'type' => 'color-options-group',
                        //    'fields' => addonify_floating_cart_cart_secondary_button_display_designs()
                        //),
                    ),
                ),
            ),
        );
    }
}


/**
 * Update plugin's setting options' values.
 *
 * Checks the type of each setting options, sanitizes the value and updates the option's value.
 *
 * @since 1.0.0
 * @param array $settings array of options values.
 * @return boolean true on successful update else false.
 */
if ( ! function_exists( 'addonify_floating_cart_update_settings' ) ) {

    function addonify_floating_cart_update_settings( $settings = '' ) {

        if (
            is_array( $settings ) &&
            count( $settings ) > 0
        ) {
            $setting_fields = addonify_floating_cart_settings_fields();

            foreach ( $settings as $id => $value ) {

                $sanitized_value = null;

                $setting_type = $setting_fields[$id]['type'];

                switch ( $setting_type ) {
                    case 'text':
                        $sanitized_value = sanitize_text_field( $value );
                        break;
                    case 'textarea':
                        $sanitized_value = sanitize_textarea_field( $value );
                        break;
                    case 'switch':
                        $sanitized_value = ( $value == true ) ? '1' : '0';
                        break;
                    case 'number':
                        $sanitized_value = is_numeric( $value ) ? $value : 0;
                        break;
                    case 'color':
                        $sanitized_value = sanitize_text_field( $value );
                        break;
                    case 'select':
                        $setting_choices = $setting_fields[$id]['choices'];
                        $sanitized_value = ( array_key_exists( $value, $setting_choices ) ) ? sanitize_text_field( $value ) : $setting_choices[0];
                        break;
                    case 'checkbox':
                        $sanitize_args = array(
                            'choices' => $setting_fields[$id]['choices'],
                            'values' => $value
                        );
                        $sanitized_value = addonify_floating_cart_sanitize_multi_choices( $sanitize_args );
                        $sanitized_value = json_encode( $value );
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
}


/**
 * Sanitize multiple choices values.
 *
 * @since 1.0.0
 * @param array $args
 * @return array $sanitized_values
 */
if ( ! function_exists( 'addonify_floating_cart_sanitize_multi_choices' ) ) {

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
}
