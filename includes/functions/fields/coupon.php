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
					'label' => __( 'Desktop', 'addonify-floating-cart' ),
					'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" 	height="24px"><path d="M4 5V16H20V5H4ZM2 4.00748C2 3.45107 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44892 22 4.00748V18H2V4.00748ZM1 19H23V21H1V19Z"></path></svg>',
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
					'label' => __( 'Tablet', 'addonify-floating-cart' ),
					'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" 	height="24px"><path d="M6 4V20H18V4H6ZM5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z"></path></svg>',
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
					'label' => __( 'Mobile', 'addonify-floating-cart' ),
					'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" 	height="24px"><path d="M7 4V20H17V4H7ZM6 2H18C18.5523 2 19 2.44772 19 3V21C19 21.5523 18.5523 22 18 22H6C5.44772 22 5 21.5523 5 21V3C5 2.44772 5.44772 2 6 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z"></path></svg>',
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
