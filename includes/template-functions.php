<?php

if ( ! function_exists( 'addonify_floating_cart_floating_button_template' ) ) {

    function addonify_floating_cart_floating_button_template() {

        addonify_get_template( 'floating-button.php' );
    }
} 

if( ! function_exists('addonify_add_floating_cart_template')){
    function addonify_add_floating_cart_template(){
        addonify_get_template( 'sidebar-cart.php' );
    }
}

add_action( 'addonify_floating_cart_floating_button', 'addonify_floating_cart_floating_button_template' );

add_action( 'addonify_floating_cart_add', 'addonify_add_floating_cart_template' );