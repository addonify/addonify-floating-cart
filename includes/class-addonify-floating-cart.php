<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/includes
 * @author     Addonify <addonify@gmail.com>
 */
class Addonify_Floating_Cart {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Addonify_Floating_Cart_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ADDONIFY_FLOATING_CART_VERSION' ) ) {
			$this->version = ADDONIFY_FLOATING_CART_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'addonify-floating-cart';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->rest_api();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Addonify_Floating_Cart_Loader. Orchestrates the hooks of the plugin.
	 * - Addonify_Floating_Cart_i18n. Defines internationalization functionality.
	 * - Addonify_Floating_Cart_Admin. Defines all hooks for the admin area.
	 * - Addonify_Floating_Cart_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-addonify-floating-cart-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-addonify-floating-cart-rest-api.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-addonify-floating-cart-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-addonify-floating-cart-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-addonify-floating-cart-public.php';



		$this->loader = new Addonify_Floating_Cart_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Addonify_Floating_Cart_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Addonify_Floating_Cart_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Addonify_Floating_Cart_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu_callback' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		if(!$this->is_woocommerce_active()){
			add_action( 'admin_notices', [$this, 'admin_woocommerce_not_active_notice']);
			return;
		}

		$plugin_public = new Addonify_Floating_Cart_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'footer_content' );

		$this->loader->add_action( 'wp_ajax_addonify_floating_cart_add_to_cart', $plugin_public, 'add_to_cart');
		$this->loader->add_action( 'wp_ajax_nopriv_addonify_floating_cart_add_to_cart', $plugin_public, 'add_to_cart');

		$this->loader->add_action( 'wp_ajax_addonify_floating_cart_remove_from_cart', $plugin_public, 'remove_from_cart');
		$this->loader->add_action( 'wp_ajax_nopriv_addonify_floating_cart_remove_from_cart', $plugin_public, 'remove_from_cart');

		$this->loader->add_action( 'wp_ajax_addonify_floating_cart_update_cart_item', $plugin_public, 'update_cart_item');
		$this->loader->add_action( 'wp_ajax_nopriv_addonify_floating_cart_update_cart_item', $plugin_public, 'update_cart_item');

		$this->loader->add_action( 'wp_ajax_addonify_floating_cart_apply_coupon', $plugin_public, 'apply_coupon');
		$this->loader->add_action( 'wp_ajax_nopriv_addonify_floating_cart_apply_coupon', $plugin_public, 'apply_coupon');

		$this->loader->add_action( 'wp_ajax_addonify_floating_cart_remove_coupon', $plugin_public, 'remove_coupon');
		$this->loader->add_action( 'wp_ajax_nopriv_addonify_floating_cart_remove_coupon', $plugin_public, 'remove_coupon');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Addonify_Floating_Cart_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}


	/**
	 * Register rest api endpoints for admin settings page.
	 *
	 * @since    1.0.7
	 * @access   private
	 */
	private function rest_api() {

		$plugin_rest = new Addonify_Floating_Cart_Rest_Api();
	}

	public function admin_woocommerce_not_active_notice(){
		global $pagenow;
		if ( $pagenow == 'index.php' ) {
			ob_start();
			?>
				<div class="notice notice-error is-dismissible">
					<p>
					<?php _e( 'Addonify Floating Cart requires WooCommerce in order to work.', 'addonify-floating-cart' );?>
					</p>
				</div>
			<?php 
			echo ob_get_clean();
		}
	}

	public function is_woocommerce_active(){
		return in_array('woocommerce/woocommerce.php',get_option('active_plugins'));
	}

}
