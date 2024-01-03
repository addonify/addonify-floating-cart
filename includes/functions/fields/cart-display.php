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

if ( ! function_exists( 'addonify_floating_cart_cart_display_settings' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_cart_display_settings() {

		return array(
			'open_cart_modal_on_trigger_button_mouse_hover' => array(
				'label'     => esc_html__( 'Open cart modal on trigger button hover', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'open_cart_modal_on_trigger_button_mouse_hover' ),
			),
			'cart_position'                     => array(
				'label'       => esc_html__( 'Cart position', 'addonify-floating-cart' ),
				'type'        => 'select',
				'placeholder' => esc_attr__( 'Select position', 'addonify-floating-cart' ),
				'choices'     => array(
					'left'  => esc_html__( 'Left', 'addonify-floating-cart' ),
					'right' => esc_html__( 'Right', 'addonify-floating-cart' ),
				),
				'dependent'   => array( 'enable_floating_cart' ),
				'value'       => addonify_floating_cart_get_option( 'cart_position' ),
			),
			'close_cart_modal_on_overlay_click' => array(
				'label'     => esc_html__( 'Close cart on overlay click', 'addonify-floating-cart' ),
				'type'      => 'switch',
				'dependent' => array( 'enable_floating_cart' ),
				'value'     => addonify_floating_cart_get_option( 'close_cart_modal_on_overlay_click' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_misc_settings() );
		}
	);
}


if ( ! function_exists( 'addonify_floating_cart_cart_display_designs' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_cart_display_designs() {

		return array(
			'cart_modal_width'                       => array(
				'label'     => esc_html__( 'Cart width (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 400,
				'max'       => 800,
				'step'      => 20,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_width' ),
			),
			'cart_modal_base_font_size'              => array(
				'label'     => esc_html__( 'General cart text font size (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 12,
				'max'       => 22,
				'step'      => 1,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_base_font_size' ),
			),
			'cart_modal_background_color'            => array(
				'label'       => esc_html__( 'Cart background color', 'addonify-floating-cart' ),
				'description' => esc_html__( 'Main cart container background color.', 'addonify-floating-cart' ),
				'type'        => 'color',
				'isAlpha'     => true,
				'dependent'   => array( 'load_styles_from_plugin' ),
				'value'       => addonify_floating_cart_get_option( 'cart_modal_background_color' ),
			),
			'cart_modal_overlay_color'               => array(
				'label'     => esc_html__( 'Cart overlay background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_overlay_color' ),
			),
			'cart_modal_border_color'                => array(
				'label'     => esc_html__( 'General border color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_border_color' ),
			),
			'cart_modal_base_text_color'             => array(
				'label'     => esc_html__( 'General text color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_base_text_color' ),
			),
			'cart_modal_content_link_color'          => array(
				'label'     => esc_html__( 'General link color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_content_link_color' ),
			),
			'cart_modal_content_link_on_hover_color' => array(
				'label'     => esc_html__( 'General link color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_content_link_on_hover_color' ),
			),
			'cart_modal_title_color'                 => array(
				'label'     => esc_html__( 'Cart title color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_title_color' ),
			),
			'cart_title_font_size'                   => array(
				'label'     => esc_html__( 'Cart title font size (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 13,
				'max'       => 20,
				'step'      => 1,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_title_font_size' ),
			),
			'cart_title_font_weight'                 => array(
				'label'     => esc_html__( 'Cart title font weight', 'addonify-floating-cart' ),
				'type'      => 'select',
				'dependent' => array( 'load_styles_from_plugin' ),
				'choices'   => array(
					'400' => esc_html__( 'Normal', 'addonify-floating-cart' ),
					'500' => esc_html__( 'Medium', 'addonify-floating-cart' ),
					'600' => esc_html__( 'Semi bold', 'addonify-floating-cart' ),
					'700' => esc_html__( 'Bold', 'addonify-floating-cart' ),
				),
				'value'     => addonify_floating_cart_get_option( 'cart_title_font_weight' ),
			),
			'cart_title_letter_spacing'              => array(
				'label'     => esc_html__( 'Cart title letter spacing (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 0,
				'max'       => 3,
				'step'      => 0.1,
				'precision' => 2,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_title_letter_spacing' ),
			),
			'cart_title_text_transform'              => array(
				'label'     => esc_html__( 'Cart title text transform', 'addonify-floating-cart' ),
				'type'      => 'select',
				'dependent' => array( 'load_styles_from_plugin' ),
				'choices'   => array(
					'none'       => esc_html__( 'None', 'addonify-floating-cart' ),
					'capatilize' => esc_html__( 'Capatilize', 'addonify-floating-cart' ),
					'uppercase'  => esc_html__( 'Uppercase', 'addonify-floating-cart' ),
					'lowercase'  => esc_html__( 'Lowercase', 'addonify-floating-cart' ),
				),
				'value'     => addonify_floating_cart_get_option( 'cart_title_text_transform' ),
			),
			'cart_modal_badge_text_color'            => array(
				'label'     => esc_html__( 'Badge label color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_badge_text_color' ),
			),
			'cart_modal_badge_background_color'      => array(
				'label'     => esc_html__( 'Badge background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_badge_background_color' ),
			),
			'cart_modal_close_icon_color'            => array(
				'label'     => esc_html__( 'Cart close icon color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_close_icon_color' ),
			),
			'cart_modal_close_icon_on_hover_color'   => array(
				'label'     => esc_html__( 'Cart close icon color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_close_icon_on_hover_color' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_cart_display_designs() );
		}
	);
}


if ( ! function_exists( 'addonify_floating_cart_cart_buttons_display_designs' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_cart_buttons_display_designs() {

		return array(
			'cart_modal_buttons_font_size'                 => array(
				'label'     => esc_html__( 'Buttons font size (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 13,
				'max'       => 20,
				'step'      => 1,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_buttons_font_size' ),
			),
			'cart_modal_buttons_font_weight'               => array(
				'label'     => esc_html__( 'Buttons font weight', 'addonify-floating-cart' ),
				'type'      => 'select',
				'dependent' => array( 'load_styles_from_plugin' ),
				'choices'   => array(
					'400' => esc_html__( 'Normal', 'addonify-floating-cart' ),
					'500' => esc_html__( 'Medium', 'addonify-floating-cart' ),
					'600' => esc_html__( 'Semi bold', 'addonify-floating-cart' ),
					'700' => esc_html__( 'Bold', 'addonify-floating-cart' ),
				),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_buttons_font_weight' ),
			),
			'cart_modal_buttons_letter_spacing'            => array(
				'label'     => esc_html__( 'Buttons letter spacing (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 0,
				'max'       => 3,
				'step'      => 0.1,
				'precision' => 2,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_buttons_letter_spacing' ),
			),
			'cart_modal_buttons_border_radius'             => array(
				'label'     => esc_html__( 'Buttons border radius (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 0,
				'max'       => 60,
				'step'      => 2,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_buttons_border_radius' ),
			),
			'cart_modal_buttons_text_transform'            => array(
				'label'     => esc_html__( 'Buttons text transform', 'addonify-floating-cart' ),
				'type'      => 'select',
				'dependent' => array( 'load_styles_from_plugin' ),
				'choices'   => array(
					'none'       => esc_html__( 'None', 'addonify-floating-cart' ),
					'capatilize' => esc_html__( 'Capatilize', 'addonify-floating-cart' ),
					'uppercase'  => esc_html__( 'Uppercase', 'addonify-floating-cart' ),
					'lowercase'  => esc_html__( 'Lowercase', 'addonify-floating-cart' ),
				),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_buttons_text_transform' ),
			),
			'cart_modal_primary_button_background_color'   => array(
				'label'     => esc_html__( 'Primary button background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_background_color' ),
			),
			'cart_modal_primary_button_label_color'        => array(
				'label'     => esc_html__( 'Primary button label color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_label_color' ),
			),
			'cart_modal_primary_button_border_color'       => array(
				'label'     => esc_html__( 'Primary button border color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_border_color' ),
			),
			'cart_modal_primary_button_on_hover_background_color' => array(
				'label'     => esc_html__( 'Primary button background color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_background_color' ),
			),
			'cart_modal_primary_button_on_hover_label_color' => array(
				'label'     => esc_html__( 'Primary button label color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_label_color' ),
			),
			'cart_modal_primary_button_on_hover_border_color' => array(
				'label'     => esc_html__( 'Primary button border color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_border_color' ),
			),
			'cart_modal_secondary_button_background_color' => array(
				'label'     => esc_html__( 'Secondary button background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_background_color' ),
			),
			'cart_modal_secondary_button_label_color'      => array(
				'label'     => esc_html__( 'Secondary button label color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_label_color' ),
			),
			'cart_modal_secondary_button_border_color'     => array(
				'label'     => esc_html__( 'Secondary button border color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_border_color' ),
			),
			'cart_modal_secondary_button_on_hover_background_color' => array(
				'label'     => esc_html__( 'Secondary button background color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_background_color' ),
			),
			'cart_modal_secondary_button_on_hover_label_color' => array(
				'label'     => esc_html__( 'Secondary button label color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_label_color' ),
			),
			'cart_modal_secondary_button_on_hover_border_color' => array(
				'label'     => esc_html__( 'Secondary button border color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_border_color' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_cart_buttons_display_designs() );
		}
	);
}


if ( ! function_exists( 'addonify_floating_cart_cart_misc_display_designs' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_cart_misc_display_designs() {

		return array(
			'cart_modal_input_field_placeholder_color'     => array(
				'label'     => esc_html__( 'Input field placeholder color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_input_field_placeholder_color' ),
			),
			'cart_modal_input_field_text_color'            => array(
				'label'     => esc_html__( 'Input field text color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_input_field_text_color' ),
			),
			'cart_modal_input_field_border_color'          => array(
				'label'     => esc_html__( 'Input field border color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_input_field_border_color' ),
			),
			'cart_modal_input_field_background_color'      => array(
				'label'     => esc_html__( 'Input field background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_input_field_background_color' ),
			),
			'cart_shopping_meter_initial_background_color' => array(
				'label'     => esc_html__( 'Initial shopping meter background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_shopping_meter_initial_background_color' ),
			),
			'cart_shopping_meter_progress_background_color' => array(
				'label'     => esc_html__( 'Shopping meter live progress bar background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_shopping_meter_progress_background_color' ),
			),
			'cart_shopping_meter_threashold_reached_background_color' => array(
				'label'     => esc_html__( 'Shopping meter background color once threashold is reached', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_shopping_meter_threashold_reached_background_color' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_cart_misc_display_designs() );
		}
	);
}


if ( ! function_exists( 'addonify_floating_cart_cart_products_display_designs' ) ) {
	/**
	 * Define settings for cart modal toggle button.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	function addonify_floating_cart_cart_products_display_designs() {

		return array(
			'cart_modal_product_title_color'              => array(
				'label'     => esc_html__( 'Product title color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_title_color' ),
			),
			'cart_modal_product_title_on_hover_color'     => array(
				'label'     => esc_html__( 'Product title color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_title_on_hover_color' ),
			),
			'cart_modal_product_title_font_size'          => array(
				'label'     => esc_html__( 'Product title font size (unit: px)', 'addonify-floating-cart' ),
				'type'      => 'number',
				'style'     => 'buttons-plus-minus',
				'min'       => 13,
				'max'       => 22,
				'step'      => 1,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_title_font_size' ),
			),
			'cart_modal_product_title_font_weight'        => array(
				'label'     => esc_html__( 'Product title font weight', 'addonify-floating-cart' ),
				'type'      => 'select',
				'dependent' => array( 'load_styles_from_plugin' ),
				'choices'   => array(
					'400' => esc_html__( 'Normal', 'addonify-floating-cart' ),
					'500' => esc_html__( 'Medium', 'addonify-floating-cart' ),
					'600' => esc_html__( 'Semi bold', 'addonify-floating-cart' ),
					'700' => esc_html__( 'Bold', 'addonify-floating-cart' ),
				),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_title_font_weight' ),
			),
			'cart_modal_product_quantity_price_color'     => array(
				'label'     => esc_html__( 'Product quantity & price color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_quantity_price_color' ),
			),
			'cart_modal_product_remove_button_background_color' => array(
				'label'     => esc_html__( 'Remove product button background color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_background_color' ),
			),
			'cart_modal_product_remove_button_icon_color' => array(
				'label'     => esc_html__( 'Remove product button icon color', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_icon_color' ),
			),
			'cart_modal_product_remove_button_on_hover_background_color' => array(
				'label'     => esc_html__( 'Remove product button background color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_background_color' ),
			),
			'cart_modal_product_remove_button_on_hover_icon_color' => array(
				'label'     => esc_html__( 'Remove product button icon color on hover', 'addonify-floating-cart' ),
				'type'      => 'color',
				'isAlpha'   => true,
				'dependent' => array( 'load_styles_from_plugin' ),
				'value'     => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_icon_color' ),
			),
		);
	}

	add_filter(
		'addonify_floating_cart_settings_fields',
		function( $settings ) {
			return array_merge( $settings, addonify_floating_cart_cart_products_display_designs() );
		}
	);
}
