<?php
/**
 * Addonify Floating Cart For WooCommerce
 *
 * @link              https://addonify.com/
 * @since             1.0.0
 * @package           Addonify_Floating_Cart
 *
 * @wordpress-plugin
 * Plugin Name:       Addonify Floating Cart For WooCommerce
 * Plugin URI:        https://addonify.com/addonify-floating-cart
 * Description:       Addonify Floating Cart is a free WooCommerce addon that adds a sticky, interactive cart, letting visitors manage items without visiting the cart page.
 * Version:           1.2.13
 * Requires at least: 6.0.0
 * Requires PHP:      7.4
 * Tested up to:      6.7.1
 * Author:            Addonify
 * Author URI:        https://addonify.com/
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       addonify-floating-cart
 * Domain Path:       /languages
 * Requires Plugins:  woocommerce
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
define( 'ADDONIFY_FLOATING_CART_VERSION', '1.2.13' );
define( 'ADDONIFY_FLOATING_CART_BASENAME', plugin_basename( __FILE__ ) );
define( 'ADDONIFY_FLOATING_CART_PATH', plugin_dir_path( __FILE__ ) );
define( 'ADDONIFY_FLOATING_CART_DB_INITIALS', 'addonify_fc_' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-addonify-floating-cart.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-addonify-floating-cart-rest-api.php';
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

	if ( class_exists( 'WooCommerce' ) ) {

		$plugin = new Addonify_Floating_Cart();
		$plugin->run();
	} elseif ( version_compare( get_bloginfo( 'version' ), '6.5', '<' ) ) {
		add_action(
			'admin_notices',
			function () {
				?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo esc_html__( 'Addonify Floating Cart requires WooCommerce in order to work.', 'addonify-floating-cart' ); ?></p>
				</div>
				<?php
			}
		);
	}
}
add_action( 'plugins_loaded', 'run_addonify_floating_cart' );
