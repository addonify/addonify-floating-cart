<?php 

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/cart.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'functions/fields/toggle-button.php';

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
                // main cart settings options
                'enable_floating_cart' => true, //
                'open_cart_modal_immediately_after_add_to_cart' => false,//
                'open_cart_modal_after_click_on_view_cart' => true,//
                // Floating Cart Toggle Button Options
                'display_cart_modal_toggle_button' => true, //
                'cart_modal_toggle_button_display_position' => 'br',
                'display_cart_items_number_badge' => true, //
                'cart_items_number_badge_position' => 'tl',
                'toggle_button_badge_background_color' => '#215bff',
                'toggle_button_badge_label_color' => '#FFFFFF',
                'toggle_button_label_color' => '#000000',
                'toggle_button_background_color' => '#FFFFFF',
                'toggle_button_border_color' => '#555',
                'toggle_button_on_hover_label_color' => '#898989',
                'toggle_button_on_hover_background_color' => '#555',
                'toggle_button_on_hover_border_color' => 'rgba(0,0,0,.3)',
                'cart_modal_toggle_button_padding' => '0',
                'cart_modal_toggle_button_side_offset' => '',
                'cart_modal_toggle_button_vertical_offset' => '',
                // toast notification options
                'display_toast_notification' => true, //
                'toast_notification_display_position' => 'tr',
                'open_cart_modal_on_notification_button_click' => true, //
                'add_to_cart_notification_text' => 'Product has been added to cart.',  //
                'close_notification_after_time' => '3', //
                'display_close_notification_button' => true, //
                'toast_notification_background_color' => '#67C23A',
                'toast_notification_text_color' => '#FFFFFF',
                'toast_notification_button_background_color' => 'rgba(0, 0, 0, 0.2)',
                'toast_notification_button_label_color' => 'white',
                'toast_notification_button_on_hover_background_color' => 'rgba(0, 0, 0, 0.5)',
                'toast_notification_button_on_hover_label_color' => 'white',
                'toast_notification_side_offset' => '',
                'toast_notification_top_bottom_offset' => '',
                // cart modal options
                'cart_modal_display_layout' => '',
                'cart_title' => 'Cart', //
                'display_cart_items_number' => true, //
                'close_cart_modal_on_overlay_click' => true, //
                'display_continue_shopping_button' => true, //
                'continue_shopping_button_label' => 'Continue Shopping', //
                'checkout_button_label' => 'Checkout', //
                'cart_modal_background_color' => '#FFFFFF',
                'cart_modal_overlay_color' => '',
                'cart_modal_title_color' => '#000',
                'cart_modal_badge_background_color' => '',
                'cart_modal_badge_text_color' => '',
                'cart_modal_close_icon_color' => '',
                'cart_modal_product_title_color' => '',
                'cart_modal_product_title_on_hover_color' => '',
                'cart_modal_product_quantity_price_color' => '#000',
                'cart_modal_product_remove_button_background_color' => '',
                'cart_modal_product_remove_button_icon_color' => '',
                'cart_modal_product_remove_button_on_hover_background_color' => '',
                'cart_modal_product_remove_button_on_hover_icon_color' => '',
                'cart_modal_content_text_color' => '',
                'cart_modal_content_link_color' => '',
                'cart_modal_content_link_on_hover_color' => '',
                'cart_modal_border_color' => '',
                'cart_modal_input_field_background_color' => '',
                'cart_modal_input_field_text_color' => '',
                'cart_modal_input_field_border_color' => '',
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
                'cart_modal_width' => '',
            )
        );
    }
}


/**
 * Retrieve the value of a settings field.
 * 
 * @since 1.0.0
 * @param string $setting_id
 * @return mixed 
 */
if ( ! function_exists( 'addonify_floating_cart_get_setting_field_value' ) ) {

    function addonify_floating_cart_get_setting_field_value( $setting_id ) {

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
            
            return addonify_floating_cart_get_setting_field_value( $setting_id );
        } else {

            $key_values = array();

            foreach ( $setting_fields as $key => $value ) {

                $field_type = $value['type'];

                switch ( $field_type ) {

                    case 'text':
                        $key_values[ $key ] = addonify_floating_cart_get_setting_field_value( $key );
                        break;

                    case 'switch':
                        $key_values[$key] = ( addonify_floating_cart_get_setting_field_value( $key ) == '1' ) ? true : false;
                        break;

                    case 'checkbox':
                        $key_values[ $key ] = addonify_floating_cart_get_setting_field_value( $key ) ? unserialize( addonify_floating_cart_get_setting_field_value( $key ) ): [];
                        break;

                    case 'select':
                        $key_values[ $key ] = ( addonify_floating_cart_get_setting_field_value( $key ) == '' ) ? 'Choose value' : addonify_floating_cart_get_setting_field_value( $key );
                        break;

                    case 'color':
                        $key_values[ $key ] = addonify_floating_cart_get_setting_field_value( $key );
                        break;

                    default:
                        $key_values[ $key ] = addonify_floating_cart_get_setting_field_value( $key );
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
                            'title' => __('General Cart Settings', 'addonify-floating-cart'),
                            'descripion' => '',
                            'fields' => addonify_floating_cart_cart_options_settings()
                        ),
                        'button' => array(
                            'title' => __('', 'addonify-floating-cart'),
                            'description' => '',
                            'fields' => addonify_add_floating_cart_toggle_cart_button_settings()
                        ),
                    ),
                ),
            ),
        );
    }
}
