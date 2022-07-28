<?php

if ( ! function_exists( 'addonify_floating_cart_floating_button_template' ) ) {
    function addonify_floating_cart_floating_button_template() {

        addonify_floating_cart_get_template( 'floating-button.php' );
    }
} 

if( ! function_exists('addonify_floating_cart_add_template')){
    function addonify_floating_cart_add_template(){
        addonify_floating_cart_get_template( 'sidebar-cart.php' );
    }
}

add_action( 'addonify_floating_cart_add', 'addonify_floating_cart_floating_button_template' );

add_action( 'addonify_floating_cart_add', 'addonify_floating_cart_add_template' );


if( ! function_exists('addonify_floating_cart_add_cart_parts')){
    function addonify_floating_cart_add_cart_parts( $part_name, $part_dir = '' ){
        addonify_floating_cart_get_template( $part_dir.$part_name );
    }
}

add_action( 'addonify_floating_cart_add_cart_parts', 'addonify_floating_cart_add_cart_parts', 10, 2 );


add_action( 'addonify_floating_cart_add_cart_sidebar_components', 'addonify_floating_cart_add_cart_sidebar_components' );

if( ! function_exists('addonify_floating_cart_add_cart_sidebar_components')){
	function addonify_floating_cart_add_cart_sidebar_components() {
		addonify_floating_cart_get_template( 'cart-sections/header.php' );
		addonify_floating_cart_get_template( 'cart-sections/shipping-bar.php' );
		addonify_floating_cart_get_template( 'cart-sections/body.php' );
		addonify_floating_cart_get_template( 'cart-sections/footer.php' );
	}
}

function addonify_floating_cart_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	// Set template location for theme 
	if ( empty( $template_path )) :
		$template_path = 'addonify/';
	endif;

	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = plugin_dir_path( dirname(__FILE__ ) ) . 'public/partials/'; // Path to the template folder
	endif;

	// Search template file in theme folder.
	$template = locate_template( array(
		$template_path . $template_name,
		$template_name
	) );

	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'addonify_floating_cart/locate_template', $template, $template_name, $template_path, $default_path );

}

function addonify_floating_cart_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {

	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;

	$template_file = addonify_floating_cart_locate_template( $template_name, $tempate_path, $default_path );

	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;

	include $template_file;

}

if(!function_exists('addonify_floating_cart_get_cart_body')){
	function addonify_floating_cart_get_cart_body($args = array()){
		addonify_floating_cart_get_template('cart-sections/body.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_body','addonify_floating_cart_get_cart_body',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_header')){
	function addonify_floating_cart_get_cart_header($args = array()){
		addonify_floating_cart_get_template('cart-sections/header.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_header','addonify_floating_cart_get_cart_header',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_footer')){
	function addonify_floating_cart_get_cart_footer($args = array()){
		addonify_floating_cart_get_template('cart-sections/footer.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_footer','addonify_floating_cart_get_cart_footer',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_coupon')){
	function addonify_floating_cart_get_cart_coupon($args = array()){
		addonify_floating_cart_get_template('cart-sections/coupon.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_coupon','addonify_floating_cart_get_cart_coupon',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_shipping_bar')){
	function addonify_floating_cart_get_cart_shipping_bar($args = array()){
		addonify_floating_cart_get_template('cart-sections/shipping-bar.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_shipping_bar','addonify_floating_cart_get_cart_shipping_bar',10,1);
}


if(!function_exists('addonify_floating_cart_get_cart_body_image')){
	function addonify_floating_cart_get_cart_body_image($args = array()){
		addonify_floating_cart_get_template('cart-loop/image.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_body_image','addonify_floating_cart_get_cart_body_image',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_body_quantity_field')){
	function addonify_floating_cart_get_cart_body_quantity_field($args = array()){
		addonify_floating_cart_get_template('cart-loop/quantity-field.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_body_quantity_field','addonify_floating_cart_get_cart_body_quantity_field',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_body_quantity_price')){
	function addonify_floating_cart_get_cart_body_quantity_price($args = array()){
		addonify_floating_cart_get_template('cart-loop/quantity-price.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_body_quantity_price','addonify_floating_cart_get_cart_body_quantity_price',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_body_rating')){
	function addonify_floating_cart_get_cart_body_rating($args = array()){
		addonify_floating_cart_get_template('cart-loop/rating.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_body_rating','addonify_floating_cart_get_cart_body_rating',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_body_title')){
	function addonify_floating_cart_get_cart_body_title($args = array()){
		addonify_floating_cart_get_template('cart-loop/title.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_body_title','addonify_floating_cart_get_cart_body_title',10,1);
}