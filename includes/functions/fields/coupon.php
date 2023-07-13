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

		// Expremental: Responsive control.
		'responsive_control' => array(
			'label'       => __( 'Example responsive control', 'addonify-floating-cart' ),
			'type'        => 'responsive-control-position',
			'className'	  => 'fullwidth',
			'choices' => array(
				'desktop' => array(
					'id'    => 'desktop',
					'visibility'  => array(
						'visible' => 'Visible',
						'hidden'  => 'Hidden',
					),
					'location'  => array(
						'top' 	  => '',
						'right'   => '',
						'bottom'  => '',
						'left'    => '',
					),
					'unit' 			  => array(
						'px' 		  => 'px',
						'percent'  	  => '%',
						'em'  		  => 'em',
						'rem'  		  => 'rem',
					),
				),
				'tablet' => array(
					'id'    => 'tablet',
					'visibility'  => array(
						'visible' => 'Visible',
						'hidden'  => 'Hidden',
					),
					'location'  => array(
						'top' 	  => '',
						'right'   => '',
						'bottom'  => '',
						'left'    => '',
					),
					'unit' 			  => array(
						'px' 		  => 'px',
						'percent'     => '%',
						'em'  		  => 'em',
						'rem'  		  => 'rem',
					),
				),
				'mobile' => array(
					'id'    => 'mobile',
					'visibility'  => array(
						'visible' => 'Visible',
						'hidden'  => 'Hidden',
					),
					'location'  => array(
						'top' 	  => '',
						'right'   => '',
						'bottom'  => '',
						'left'    => '',
					),
					'unit' 			  => array(
						'px' 		  => 'px',
						'percent'     => '%',
						'em'  		  => 'em',
						'rem'  		  => 'rem',
					),
				),
			),
			'dependent'   => array( 'enable_floating_cart' ),
			'value'       => array(
				'desktop' => array(
					'id'   		  => 'desktop',	
					'visibility'  => 'visible',
					'location'    => array(
						'top' 	  => '',
						'right'   => '40',
						'bottom'  => '40',
						'left'    => '',
					),
					'unit'		  => 'px'
				),
				'tablet' => array(
					'id'   		  => 'tablet',	
					'visibility'  => 'hidden',
					'location'    => array(
						'top' 	  => '',
						'right'   => '2',
						'bottom'  => '3',
						'left'    => '',
					),
					'unit'		  => 'em'
				),
				'mobile' => array(
					'id'   		  => 'mobile',	
					'visibility'  => 'visible',
					'location'    => array(
						'top' 	  => '',
						'right'   => '10',
						'bottom'  => '10',
						'left'    => '',
					),
					'unit'		  => 'px'
				),
			)
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
