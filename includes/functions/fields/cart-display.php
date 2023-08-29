<?php
/**
 * Define settings fields for cart content.
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
function addonify_floating_cart_cart_display_settings() {

	return array(
		'open_cart_modal_on_trigger_button_mouse_hover' => array(
			'label' => __( 'Open cart modal on trigger button hover', 'addonify-floating-cart' ),
			'type'  => 'switch',
			'dependent' => array( 'enable_floating_cart' ),
			'value' => addonify_floating_cart_get_option( 'open_cart_modal_on_trigger_button_mouse_hover' ),
		),
		'cart_position'                     => array(
			'label'     => __( 'Cart position', 'addonify-floating-cart' ),
			'type'      => 'select',
			'placeholder' => __('Select position', 'addonify-floating-cart'),
			'choices'   => array(
				'left'  => __( 'Left', 'addonify-floating-cart' ),
				'right' => __( 'Right', 'addonify-floating-cart' ),
			),
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'cart_position' ),
		),
		'cart_title'                        => array(
			'label'     => __( 'Cart title', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'cart_title' ),
		),
		'display_cart_items_number'         => array(
			'label'       => __( 'Display badge', 'addonify-floating-cart' ),
			'description' => __( 'Display badge for number of items in the cart beside cart title.', 'addonify-floating-cart' ),
			'type'        => 'switch',
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'display_cart_items_number' ),
		),
		'close_cart_modal_on_overlay_click' => array(
			'label'     => __( 'Close cart on overlay click', 'addonify-floating-cart' ),
			'type'      => 'switch',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'close_cart_modal_on_overlay_click' ),
		),
		'display_continue_shopping_button'  => array(
			'label'     => __( 'Display button before checkout button', 'addonify-floating-cart' ),
			'type'      => 'switch',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'display_continue_shopping_button' ),
		),
		'continue_shopping_button_action'   => array(
			'label'     => __( 'Action of button before checkout button', 'addonify-floating-cart' ),
			'type'      => 'select',
			'placeholder' => __('Select action', 'addonify-floating-cart'),
			'choices'   => array(
				'default'        => __( 'Close Cart Modal', 'addonify-floating-cart' ),
				'open_cart_page' => __( 'Open Cart Page', 'addonify-floating-cart' ),
			),
			'dependent' => array( 'enable_floating_cart', 'display_continue_shopping_button' ),
			'value'     => addonify_floating_cart_get_option( 'continue_shopping_button_action' ),
		),
	);
}

/**
 * Floating cart labels.
 */
function addonify_floating_cart_display_cart_label_settings() {
	return array(
		'continue_shopping_button_label' => array(
			'label'       => __( 'Label of button before checkout button', 'addonify-floating-cart' ),
			'type'        => 'text',
			'placeholder' => __( 'i.e Close', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart', 'display_continue_shopping_button' ),
			'value'       => addonify_floating_cart_get_option( 'continue_shopping_button_label' ),
		),
		'checkout_button_label'          => array(
			'label'       => __( 'Checkout button label', 'addonify-floating-cart' ),
			'type'        => 'text',
			'placeholder' => __( 'Checkout', 'addonify-floating-cart' ),
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => addonify_floating_cart_get_option( 'checkout_button_label' ),
		),
		'sub_total_label'                => array(
			'label'     => __( 'Sub total label', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'sub_total_label' ),
		),
		'discount_label'                 => array(
			'label'     => __( 'Discount label', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'discount_label' ),
		),
		'shipping_label'                 => array(
			'label'     => __( 'Shipping label', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'shipping_label' ),
		),
		'open_shipping_label'            => array(
			'label'     => __( 'Label for opening shipping section', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'open_shipping_label' ),
		),
		'tax_label'                      => array(
			'label'     => __( 'Tax label', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'tax_label' ),
		),
		'total_label'                    => array(
			'label'     => __( 'Total label', 'addonify-floating-cart' ),
			'type'      => 'text',
			'dependent' => array( 'enable_floating_cart' ),
			'value'     => addonify_floating_cart_get_option( 'total_label' ),
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
function addonify_floating_cart_cart_display_settings_add( $setting_fields ) {

	$setting_fields = array_merge( $setting_fields, addonify_floating_cart_cart_display_settings() );

	$setting_fields = array_merge( $setting_fields, addonify_floating_cart_display_cart_label_settings() );

	return $setting_fields;
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_display_settings_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_display_designs() {

	return array(
		'cart_modal_width'                       => array(
			'label'           => __( 'Cart width (unit: px)', 'addonify-floating-cart' ),
			'type'            => 'number',
			'style'			  => 'buttons-plus-minus',
			'min'             => 400,
			'max'             => 800,
			'step'			  => 20,
			'dependent'       => array( 'load_styles_from_plugin' ), 
			'value'           => addonify_floating_cart_get_option( 'cart_modal_width' ),
		),
		'cart_modal_base_font_size'              => array(
			'label'           => __( 'General cart text font size (unit: px)', 'addonify-floating-cart' ),
			'type'            => 'number',
			'style'			  => 'buttons-plus-minus',
			'min'             => 12,
			'max'             => 22,
			'step'			  => 1,
			'dependent'       => array( 'load_styles_from_plugin' ), 
			'value'           => addonify_floating_cart_get_option( 'cart_modal_base_font_size' ),
		),
		'cart_modal_background_color'            => array(
			'label'       => __( 'Cart background color', 'addonify-floating-cart' ),
			'description' => __( 'Main cart container background color.', 'addonify-floating-cart' ),
			'type'        => 'color',
			'isAlpha'     => true,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value'       => addonify_floating_cart_get_option( 'cart_modal_background_color' ),
		),
		'cart_modal_overlay_color'               => array(
			'label'       => __( 'Cart overlay background color', 'addonify-floating-cart' ),
			'type'        => 'color',
			'isAlpha'     => true,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value'       => addonify_floating_cart_get_option( 'cart_modal_overlay_color' ),
		),
		'cart_modal_border_color'                => array(
			'label' 	  => __( 'General border color', 'addonify-floating-cart' ),
			'type'  	  => 'color',
			'isAlpha' 	  => true,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value' 	  => addonify_floating_cart_get_option( 'cart_modal_border_color' ),
		),
		'cart_modal_base_text_color'             => array(
			'label' 	  => __( 'General text color', 'addonify-floating-cart' ),
			'type'  	  => 'color',
			'isAlpha' 	  => true,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value' 	  => addonify_floating_cart_get_option( 'cart_modal_base_text_color' ),
		),
		'cart_modal_content_link_color'          => array(
			'label' 	  => __( 'General link color', 'addonify-floating-cart' ),
			'type'  	  => 'color',
			'isAlpha' 	  => true,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value' 	  => addonify_floating_cart_get_option( 'cart_modal_content_link_color' ),
		),
		'cart_modal_content_link_on_hover_color' => array(
			'label' 	  => __( 'General link color on hover', 'addonify-floating-cart' ),
			'type'  	  => 'color',
			'isAlpha' 	  => true,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value' 	  => addonify_floating_cart_get_option( 'cart_modal_content_link_on_hover_color' ),
		),
		'cart_modal_title_color'                 => array(
			'label'       => __( 'Cart title color', 'addonify-floating-cart' ),
			'type'        => 'color',
			'isAlpha' 	  => true,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value'       => addonify_floating_cart_get_option( 'cart_modal_title_color' ),
		),
		'cart_title_font_size'                   => array(
			'label'           => __( 'Cart title font size (unit: px)', 'addonify-floating-cart' ),
			'type'            => 'number',
			'style'			  => 'buttons-plus-minus',
			'min'             => 13,
			'max'             => 20,
			'step'			  => 1, 
			'dependent'       => array( 'load_styles_from_plugin' ), 
			'value'           => addonify_floating_cart_get_option( 'cart_title_font_size' ),
		),
		'cart_title_font_weight'                 => array(
			'label'           => __( 'Cart title font weight', 'addonify-floating-cart' ),
			'type'    	      => 'select',
			'dependent'       => array( 'load_styles_from_plugin' ), 
			'choices' => array(
				'400' => __( 'Normal', 'addonify-floating-cart' ),
				'500' => __( 'Medium', 'addonify-floating-cart' ),
				'600' => __( 'Semi bold', 'addonify-floating-cart' ),
				'700' => __( 'Bold', 'addonify-floating-cart' ),
			),
			'value'            => addonify_floating_cart_get_option( 'cart_title_font_weight' ),
		),
		'cart_title_letter_spacing'              => array(
			'label'       => __( 'Cart title letter spacing (unit: px)', 'addonify-floating-cart' ),
			'type'        => 'number',
			'style'		  => 'buttons-plus-minus',
			'min'         => 0,
			'max'         => 3,
			'step'        => 0.1,
			'precision'   => 2,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value'       => addonify_floating_cart_get_option( 'cart_title_letter_spacing' ),
		),
		'cart_title_text_transform'              => array(
			'label'   => __( 'Cart title text transform', 'addonify-floating-cart' ),
			'type'    => 'select',
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'choices' => array(
				'none'       => __( 'None', 'addonify-floating-cart' ),
				'capatilize' => __( 'Capatilize', 'addonify-floating-cart' ),
				'uppercase'  => __( 'Uppercase', 'addonify-floating-cart' ),
				'lowercase'  => __( 'Lowercase', 'addonify-floating-cart' ),
			),
			'value'   => addonify_floating_cart_get_option( 'cart_title_text_transform' ),
		),
		'cart_modal_badge_text_color'            => array(
			'label' 		=> __( 'Badge label color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'   	=> array( 'load_styles_from_plugin' ), 
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_badge_text_color' ),
		),
		'cart_modal_badge_background_color'      => array(
			'label' 		=> __( 'Badge background color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true, 
			'dependent'   	=> array( 'load_styles_from_plugin' ), 
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_badge_background_color' ),
		),
		'cart_modal_close_icon_color'            => array(
			'label' 		=> __( 'Cart close icon color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ), 
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_close_icon_color' ),
		),
		'cart_modal_close_icon_on_hover_color'   => array(
			'label' 		=> __( 'Cart close icon color on hover', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha'	 	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ), 
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_close_icon_on_hover_color' ),
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
function addonify_floating_cart_cart_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_display_designs_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_buttons_display_designs() {

	return array(
		'cart_modal_buttons_font_size'                     => array(
			'label'           => __( 'Buttons font size (unit: px)', 'addonify-floating-cart' ),
			'type'            => 'number',
			'style'			  => 'buttons-plus-minus',
			'min'             => 13,
			'max'             => 20,
			'step'			  => 1,
			'dependent'   	  => array( 'load_styles_from_plugin' ), 
			'value'           => addonify_floating_cart_get_option( 'cart_modal_buttons_font_size' ),
		),
		'cart_modal_buttons_font_weight'                   => array(
			'label'   	  => __( 'Buttons font weight', 'addonify-floating-cart' ),
			'type'    	  => 'select',
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'choices' => array(
				'400' => __( 'Normal', 'addonify-floating-cart' ),
				'500' => __( 'Medium', 'addonify-floating-cart' ),
				'600' => __( 'Semi bold', 'addonify-floating-cart' ),
				'700' => __( 'Bold', 'addonify-floating-cart' ),
			),
			'value'   	  => addonify_floating_cart_get_option( 'cart_modal_buttons_font_weight' ),
		),
		'cart_modal_buttons_letter_spacing'                => array(
			'label'       => __( 'Buttons letter spacing (unit: px)', 'addonify-floating-cart' ),
			'type'        => 'number',
			'style'   	  => 'buttons-plus-minus',
			'min'         => 0,
			'max'         => 3,
			'step'        => 0.1,
			'precision'   => 2,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value'       => addonify_floating_cart_get_option( 'cart_modal_buttons_letter_spacing' ),
		),
		'cart_modal_buttons_border_radius'                 => array(
			'label'           => __( 'Buttons border radius (unit: px)', 'addonify-floating-cart' ),
			'type'            => 'number',
			'style'       	  => 'buttons-plus-minus',
			'min'             => 0,
			'max'             => 60,
			'step'            => 2,
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'value'           => addonify_floating_cart_get_option( 'cart_modal_buttons_border_radius' ),
		),
		'cart_modal_buttons_text_transform'                => array(
			'label'   	  => __( 'Buttons text transform', 'addonify-floating-cart' ),
			'type'    	  => 'select',
			'dependent'   => array( 'load_styles_from_plugin' ), 
			'choices' => array(
				'none'       => __( 'None', 'addonify-floating-cart' ),
				'capatilize' => __( 'Capatilize', 'addonify-floating-cart' ),
				'uppercase'  => __( 'Uppercase', 'addonify-floating-cart' ),
				'lowercase'  => __( 'Lowercase', 'addonify-floating-cart' ),
			),
			'value'   	  => addonify_floating_cart_get_option( 'cart_modal_buttons_text_transform' ),
		),
		'cart_modal_primary_button_background_color'       => array(
			'label' 		=> __( 'Primary button background color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'   	=> array( 'load_styles_from_plugin' ), 
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_primary_button_background_color' ),
		),
		'cart_modal_primary_button_label_color'            => array(
			'label'     	=> __( 'Primary button label color', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ), 
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_primary_button_label_color' ),
		),
		'cart_modal_primary_button_border_color'           => array(
			'label'    	 	=> __( 'Primary button border color', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_primary_button_border_color' ),
		),
		'cart_modal_primary_button_on_hover_background_color' => array(
			'label'     	=> __( 'Primary button background color on hover', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_background_color' ),
		),
		'cart_modal_primary_button_on_hover_label_color'   => array(
			'label'     	=> __( 'Primary button label color on hover', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_label_color' ),
		),
		'cart_modal_primary_button_on_hover_border_color'  => array(
			'label'     	=> __( 'Primary button border color on hover', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_border_color' ),
		),
		'cart_modal_secondary_button_background_color'     => array(
			'label' 		=> __( 'Secondary button background color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_secondary_button_background_color' ),
		),
		'cart_modal_secondary_button_label_color'          => array(
			'label'     	=> __( 'Secondary button label color', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_secondary_button_label_color' ),
		),
		'cart_modal_secondary_button_border_color'         => array(
			'label'     	=> __( 'Secondary button border color', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true, 
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_secondary_button_border_color' ),
		),
		'cart_modal_secondary_button_on_hover_background_color' => array(
			'label'     	=> __( 'Secondary button background color on hover', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_background_color' ),
		),
		'cart_modal_secondary_button_on_hover_label_color' => array(
			'label'     	=> __( 'Secondary button label color on hover', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_label_color' ),
		),
		'cart_modal_secondary_button_on_hover_border_color' => array(
			'label'     	=> __( 'Secondary button border color on hover', 'addonify-floating-cart' ),
			'type'      	=> 'color',
			'isAlpha'   	=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'     	=> addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_border_color' ),
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
function addonify_floating_cart_cart_buttons_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_buttons_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_buttons_display_designs_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_misc_display_designs() {

	return array(
		'cart_modal_input_field_placeholder_color'      => array(
			'label' 		=> __( 'Input field placeholder color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha'		=> true, 
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_input_field_placeholder_color' ),
		),
		'cart_modal_input_field_text_color'             => array(
			'label' 		=> __( 'Input field text color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_input_field_text_color' ),
		),
		'cart_modal_input_field_border_color'           => array(
			'label' 		=> __( 'Input field border color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_input_field_border_color' ),
		),
		'cart_modal_input_field_background_color'       => array(
			'label' 		=> __( 'Input field background color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true, 
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_input_field_background_color' ),
		),
		'cart_shopping_meter_initial_background_color'  => array(
			'label' 		=> __( 'Initial shopping meter background color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_shopping_meter_initial_background_color' ),
		),
		'cart_shopping_meter_progress_background_color' => array(
			'label' 		=> __( 'Final shopping meter background color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_shopping_meter_progress_background_color' ),
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
function addonify_floating_cart_cart_misc_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_misc_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_misc_display_designs_add' );

/**
 * Define settings for cart modal toggle button.
 *
 * @since 1.0.0
 * @return array
 */
function addonify_floating_cart_cart_products_display_designs() {

	return array(
		'cart_modal_product_title_color'              => array(
			'label' 		=> __( 'Product title color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_product_title_color' ),
		),
		'cart_modal_product_title_on_hover_color'     => array(
			'label' 		=> __( 'Product title color on hover', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_product_title_on_hover_color' ),
		),
		'cart_modal_product_title_font_size'          => array(
			'label'       	=> __( 'Product title font size (unit: px)', 'addonify-floating-cart' ),
			'type'        	=> 'number',
			'style'   	  	=> 'buttons-plus-minus',
			'min'         	=> 13,
			'max'         	=> 22,
			'step'        	=> 1,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value'       	=> addonify_floating_cart_get_option( 'cart_modal_product_title_font_size' ),
		),
		'cart_modal_product_title_font_weight'        => array(
			'label'   		=> __( 'Product title font weight', 'addonify-floating-cart' ),
			'type'    		=> 'select',
			'dependent'     => array( 'load_styles_from_plugin' ),
			'choices' 		=> array(
				'400' 		=> __( 'Normal', 'addonify-floating-cart' ),
				'500' 		=> __( 'Medium', 'addonify-floating-cart' ),
				'600' 		=> __( 'Semi bold', 'addonify-floating-cart' ),
				'700' 		=> __( 'Bold', 'addonify-floating-cart' ),
			),
			'value'   		=> addonify_floating_cart_get_option( 'cart_modal_product_title_font_weight' ),
		),
		'cart_modal_product_quantity_price_color'     => array(
			'label' 		=> __( 'Product quantity & price color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_product_quantity_price_color' ),
		),
		'cart_modal_product_remove_button_background_color' => array(
			'label' 		=> __( 'Remove product button background color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_product_remove_button_background_color' ),
		),
		'cart_modal_product_remove_button_icon_color' => array(
			'label' 		=> __( 'Remove product button icon color', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_product_remove_button_icon_color' ),
		),
		'cart_modal_product_remove_button_on_hover_background_color' => array(
			'label' 		=> __( 'Remove product button background color on hover', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_background_color' ),
		),
		'cart_modal_product_remove_button_on_hover_icon_color' => array(
			'label' 		=> __( 'Remove product button icon color on hover', 'addonify-floating-cart' ),
			'type'  		=> 'color',
			'isAlpha' 		=> true,
			'dependent'     => array( 'load_styles_from_plugin' ),
			'value' 		=> addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_icon_color' ),
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
function addonify_floating_cart_cart_products_display_designs_add( $setting_fields ) {

	return array_merge( $setting_fields, addonify_floating_cart_cart_products_display_designs() );
}
add_filter( 'addonify_floating_cart_settings_fields', 'addonify_floating_cart_cart_products_display_designs_add' );
