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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/addonify-floating-cart-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/addonify-floating-cart-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function is_woocommerce_active(){
		return in_array('woocommerce/woocommerce.php',get_option('active_plugins'));
	}

	public function add_menu_callback(){

		// do not show menu if woocommerce is not active
		if ( ! $this->is_woocommerce_active() )  return; 

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

	// callback function
	// get contents for settings page screen
	public function get_settings_screen_contents() {
		?>
		<div id="___adfy-floating-cart-app___"></div>
		<?php
	}


}
