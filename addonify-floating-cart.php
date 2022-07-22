<?php

/**
 *
 * @link              https://addonify.com/
 * @since             1.0.0
 * @package           Addonify_Floating_Cart
 *
 * @wordpress-plugin
 * Plugin Name:       Addonify Foating Cart For WooCommerce
 * Plugin URI:        https://addonify.com/addonify-floating-cart
 * Description:       
 * Version:           1.0.0
 * Author:            Addonify
 * Author URI:        https://addonify.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       addonify-floating-cart
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ADDONIFY_FLOATING_CART_VERSION', '0.0.0' );
define( 'ADDONIFY_FLOATING_CART_PATH', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-addonify-floating-cart-activator.php
 */
function activate_addonify_floating_cart() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-addonify-floating-cart-activator.php';
	Addonify_Floating_Cart_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-addonify-floating-cart-deactivator.php
 */
function deactivate_addonify_floating_cart() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-addonify-floating-cart-deactivator.php';
	Addonify_Floating_Cart_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_addonify_floating_cart' );
register_deactivation_hook( __FILE__, 'deactivate_addonify_floating_cart' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-addonify-floating-cart.php';
require plugin_dir_path( __FILE__ ) . 'includes/template-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_addonify_floating_cart() {

	// if(!addonify_is_woocommerce_active()){
	// 	return;
	// }

	$plugin = new Addonify_Floating_Cart();
	$plugin->run();

}

if(!function_exists('addonify_is_woocommerce_active')){
	function addonify_is_woocommerce_active(){
		return class_exists('woocommerce');
	}
}


run_addonify_floating_cart();

add_filter('woocommerce_cart_contents_count', function($count){
	return count(WC()->cart->get_cart());
});

add_action( 'wp_body_open', function() {
	// var_dump(WC()->cart->get_cart());
} );