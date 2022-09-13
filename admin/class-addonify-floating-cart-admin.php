<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/admin
 * @author     Addonify <addonify@gmail.com>
 */
class Addonify_Floating_Cart_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Default settings_page_slug
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $settings_page_slug = 'addonify_floating_cart';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}


	public function admin_init() {

		if ( ! class_exists( 'WooCommerce' ) ) {

			add_action( 'admin_notices', array( $this, 'woocommerce_not_active_notice' ) ); 
		}

		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_menu', [ $this, 'add_menu_callback' ], 20 );

		// Add a custom link in plugins.php page in wp-admin.
		add_action( 'plugin_action_links', array( $this, 'custom_plugin_link_callback' ), 10, 2 );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Addonify_Floating_Cart_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Addonify_Floating_Cart_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_register_script( 
			"{$this->plugin_name}-manifest", 
			plugin_dir_url( __FILE__ ) . 'assets/js/manifest.js', 
			null, 
			$this->version, 
			true 
		);

		wp_register_script( 
			"{$this->plugin_name}-vendor", 
			plugin_dir_url( __FILE__ ) . 'assets/js/vendor.js', 
			array(  "{$this->plugin_name}-manifest" ), 
			$this->version, 
			true 
		);

		wp_register_script( 
			"{$this->plugin_name}-main", 
			plugin_dir_url( __FILE__ ) . 'assets/js/main.js', 
			array( 'lodash', "{$this->plugin_name}-vendor", 'wp-i18n', 'wp-api-fetch' ), 
			$this->version, 
			true 
		);

		if( 
			isset( $_GET['page'] ) && 
			$_GET['page'] == $this->settings_page_slug 
		) {
			wp_enqueue_script( "{$this->plugin_name}-manifest" );

			wp_enqueue_script( "{$this->plugin_name}-vendor" );

			wp_enqueue_script( "{$this->plugin_name}-main" );

			wp_localize_script( "{$this->plugin_name}-main", 'ADDONIFY_WOOFC_LOCOLIZER', array(
				'admin_url'  						=> esc_url( admin_url( '/' ) ),
				'ajax_url'   						=> esc_url( admin_url( 'admin-ajax.php' ) ),
				'rest_namespace' 					=> 'addonify_floating_cart_options_api',
				'version_number' 					=> $this->version,
			));
		}

		wp_set_script_translations( "{$this->plugin_name}-main", $this->plugin_name );
	}

	public function add_menu_callback(){

		// do not show menu if woocommerce is not active
		if ( ! class_exists( 'WooCommerce' ) )  {
			return;
		} 

		global $admin_page_hooks;
		
		$parent_menu_slug = array_search( 'addonify', (array)$admin_page_hooks, true );

		if ( ! $parent_menu_slug ) {

			add_menu_page( 
				'Addonify Settings', 
				'Addonify', 
				'manage_options', 
				$this->settings_page_slug, 
				array( $this, 'get_settings_screen_contents' ), 
				'dashicons-superhero', 
				70 
			);

			add_submenu_page(  
				$this->settings_page_slug, 
				'Addonify Floating Cart Settings', 
				'Floating Cart', 
				'manage_options', 
				$this->settings_page_slug, 
				array( $this, 'get_settings_screen_contents' ), 
				0 
			);
		} else {

			add_submenu_page(  
				$parent_menu_slug, 
				'Addonify Floating Cart Settings', 
				'Floating Cart', 
				'manage_options', 
				$this->settings_page_slug, 
				array( $this, 'get_settings_screen_contents' ), 
				0 
			);
		}
	}

	/**
	 * Print "settings" link in plugins.php admin page
	 *
	 * @since    1.0.0
	 * @param    string $links Links.
	 * @param    string $file  PLugin file name.
	 */
	public function custom_plugin_link_callback( $links, $file ) {

		if ( plugin_basename( dirname( __FILE__, 2 ) . '/addonify-floating-cart.php' ) === $file ) {

			// add "Settings" link.
			$links[] = '<a href="admin.php?page=' . esc_attr( $this->settings_page_slug ) . '">' . __( 'Settings', 'addonify-floating-cart' ) . '</a>';
		}

		return $links;
	}

	// callback function
	// get contents for settings page screen
	public function get_settings_screen_contents() {
		?>
		<div id="___adfy-floating-cart-app___"></div>
		<?php
	}

	public function woocommerce_not_active_notice() {
		?>
		<div class="notice notice-error is-dismissible">
			<p><?php echo __( 'Addonify Floating Cart requires WooCommerce in order to work.', 'addonify-floating-cart' ); ?></p>
		</div>
		<?php
	}
}
