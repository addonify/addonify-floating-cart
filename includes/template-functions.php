<?php

if ( ! function_exists( 'addonify_floating_cart_floating_button_template' ) ) {
    function addonify_floating_cart_floating_button_template() {
		if(addonify_floating_cart_get_setting_field_value('display_cart_modal_toggle_button')){
			addonify_floating_cart_get_template( 'floating-button.php' );
		}
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
		do_action('addonify_floating_cart_get_cart_header', array());
		do_action('addonify_floating_cart_get_cart_body', array());
		do_action('addonify_floating_cart_get_cart_shipping_bar', array());
		do_action('addonify_floating_cart_get_cart_footer', array());
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


//----------------------------------------------------------------------------------------------------------------
//
//           Cart template functions with hooks    ---------------------------------------------------------------
//
//----------------------------------------------------------------------------------------------------------------

if(!function_exists('addonify_floating_cart_get_cart_header')){
	function addonify_floating_cart_get_cart_header($args = array()){
		addonify_floating_cart_get_template('cart-sections/header.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_header','addonify_floating_cart_get_cart_header',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_body')){
	function addonify_floating_cart_get_cart_body($args = array()){
		addonify_floating_cart_get_template('cart-sections/body.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_body','addonify_floating_cart_get_cart_body',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_coupon')){
	function addonify_floating_cart_get_cart_coupon($args = array()){
		addonify_floating_cart_get_template('cart-sections/coupon.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_coupon','addonify_floating_cart_get_cart_coupon',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_coupons_available')){
	function addonify_floating_cart_get_cart_coupons_available($args = array()){
		addonify_floating_cart_get_template('cart-sections/coupons-available.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_coupons_available','addonify_floating_cart_get_cart_coupons_available',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_shipping_bar')){
	function addonify_floating_cart_get_cart_shipping_bar($args = array()){
		addonify_floating_cart_get_template('cart-sections/shipping-bar.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_shipping_bar','addonify_floating_cart_get_cart_shipping_bar',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_footer')){
	function addonify_floating_cart_get_cart_footer($args = array()){
		addonify_floating_cart_get_template('cart-sections/footer.php', $args);
	}
	add_action('addonify_floating_cart_get_cart_footer','addonify_floating_cart_get_cart_footer',10,1);
}
if(!function_exists('addonify_floatting_cart_get_cart_footer_button')){
	function addonify_floatting_cart_get_cart_footer_button($args = array()){
		ob_start();
        if(addonify_floating_cart_get_setting_field_value('display_continue_shopping_button')){ ?>
            <button class="adfy__woofc-button adfy__hide-woofc close">
                <?php esc_html_e(addonify_floating_cart_get_setting_field_value('continue_shopping_button_label')); ?>
            </button>
        <?php } ?>
        <a href="<?php echo wc_get_checkout_url(); ?>" class="adfy__woofc-button proceed-to-checkout">
            <?php esc_html_e(addonify_floating_cart_get_setting_field_value('checkout_button_label')); ?>
        </a>
		<?php
		echo ob_get_clean();
	}
	add_action('addonify_floatting_cart_get_cart_footer_button','addonify_floatting_cart_get_cart_footer_button',10,1);
}


//----------------------------------------------------------------------------------------------------------------
//
//           Cart template body loop functions with hooks    -----------------------------------------------------
//
//----------------------------------------------------------------------------------------------------------------

if(!function_exists('addonify_floating_cart_get_cart_body_image')){
	function addonify_floating_cart_get_cart_body_image($args = array()){
		$args_['product'] = $args['product'];
        $args_['product_permalink'] = $args['product']->is_visible() ? $args['product']->get_permalink(  ) : '';
        if(!empty($variation) ){
            $args_['image'] = $args['variation']->get_image();
        } else {
            $args_['image'] =  $args['product']->get_image();
        }
		$args_['cart_item_key'] = $args['cart_item_key'];
		addonify_floating_cart_get_template('cart-loop/image.php', $args_);
	}
	add_action('addonify_floating_cart_get_cart_body_image','addonify_floating_cart_get_cart_body_image',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_body_quantity_field')){
	function addonify_floating_cart_get_cart_body_quantity_field($args = array()){
		$args_['step'] = apply_filters( 'woocommerce_quantity_input_step', 1, $args['product'] );
		$args_['min'] = apply_filters( 'woocommerce_quantity_input_min', 0, $args['product'] );
		$args_['max'] = apply_filters( 'woocommerce_quantity_input_max', -1, $args['product'] );
		$args_['item_quantity'] = $args['cart_item']['quantity'];
		 
		$args_['data_attributes'] = " data-product_id='" . esc_attr( $args['product']->get_id() )."' 
            data-product_sku='".esc_attr( $args['product']->get_sku() )."'
            data-cart_item_key='".esc_attr( $args['cart_item_key'] )."' ";
		
		addonify_floating_cart_get_template('cart-loop/quantity-field.php', $args_);
	}
	add_action('addonify_floating_cart_get_cart_body_quantity_field','addonify_floating_cart_get_cart_body_quantity_field',10,1);
}
if(!function_exists('addonify_floating_cart_get_cart_body_quantity_price')){
	function addonify_floating_cart_get_cart_body_quantity_price($args = array()){
		if(!empty($args['variation']) ){
			$args_['price'] = get_woocommerce_currency_symbol().$args['variation']->get_price();
		} else {
			$args_['price'] =  get_woocommerce_currency_symbol().$args['product']->get_price();
		}
		$args_['quantity'] = $args['cart_item']['quantity'];
		addonify_floating_cart_get_template('cart-loop/quantity-price.php', $args_);
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
		$args_['attributes'] = '';
		if($args['product']->has_attributes()){
			if(isset($args['cart_item']['variation']) && is_array($args['cart_item']['variation'])){
				foreach($args['cart_item']['variation'] as $index=> $value){
					$index = ucfirst( str_replace('attribute_pa_','',$index));
					$args_['attributes'] .= esc_html($index.':'.$value) . '&nbsp;';
				}
			}
		}
		$args_['product_title'] = $args['product']->get_title();
		$args_['product_permalink'] = $args['product']->get_permalink();
		addonify_floating_cart_get_template('cart-loop/title.php', $args_);
	}
	add_action('addonify_floating_cart_get_cart_body_title','addonify_floating_cart_get_cart_body_title',10,1);
}