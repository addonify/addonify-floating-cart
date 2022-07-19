<?php

if ( ! function_exists( 'addonify_floating_cart_floating_button_template' ) ) {
    function addonify_floating_cart_floating_button_template() {

        addonify_floating_cart_get_template( 'floating-button.php' );
    }
} 

if( ! function_exists('addonify_add_floating_cart_template')){
    function addonify_add_floating_cart_template(){
        addonify_floating_cart_get_template( 'sidebar-cart.php' );
    }
}

add_action( 'addonify_floating_cart_add', 'addonify_floating_cart_floating_button_template' );

add_action( 'addonify_floating_cart_add', 'addonify_add_floating_cart_template' );


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

// add_action('wp_body_open', function(){
// 	var_dump(wp_kses_allowed_html( 'post' ));
// });