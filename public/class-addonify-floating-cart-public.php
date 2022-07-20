<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Addonify_Floating_Cart
 * @subpackage Addonify_Floating_Cart/public
 * @author     Addonify <addonify@gmail.com>
 */
class Addonify_Floating_Cart_Public
{

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_filter('woocommerce_add_to_cart_fragments', ['Addonify_Floating_Cart_Public','addonify_add_to_cart_fragment']);


	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		wp_enqueue_style('perfect-scrollbar', plugin_dir_url(__FILE__) . 'assets/build/css/conditional/perfect-scrollbar.css', array(), $this->version, 'all');

		wp_enqueue_style('notyf', plugin_dir_url(__FILE__) . 'assets/build/css/conditional/notfy.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/build/css/public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script('perfect-scrollbar', plugin_dir_url(__FILE__) . 'assets/build/js/conditional/perfect-scrollbar.min.js', null, $this->version, true);

		wp_enqueue_script('notyf', plugin_dir_url(__FILE__) . 'assets/build/js/conditional/notfy.min.js', array(), $this->version, true);

		wp_enqueue_script($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'assets/build/js/public.min.js', array(), $this->version, true);

		wp_enqueue_script($this->plugin_name . '-custom-jquery', plugin_dir_url(__FILE__) . 'assets/src/js/scripts/custom-jQuery.js', array('jquery'), $this->version, true);

		wp_localize_script($this->plugin_name . '-custom-jquery', 'addonifyFloatingCartJSObject', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'ajax_remove_from_cart_action' => 'addonify_floating_cart_remove_from_cart',
			'ajax_update_cart_item_action' => 'addonify_floating_cart_update_cart_item',
			'nonce' => wp_create_nonce('addonify-floating-cart-ajax-nonce')
		));
	}

	public function footer_content()
	{

		// echo plugin_dir_path( __FILE__ );

		do_action('addonify_floating_cart_add');

	}


	public static function addonify_add_to_cart_fragment($fragments)
	{

		ob_start();
			?>
			<div class="adfy_woofc-inner">
			<?php
				do_action( 'addonify_floating_cart_add_cart_sidebar_components');
			?>
			</div>
			<?php
		$fragments['.adfy_woofc-inner'] = ob_get_clean();

		$fragments['.badge'] = '<span class="badge">'.WC()->cart->get_cart_contents_count().'</span>';

		return $fragments;

	}


	public function remove_from_cart()
	{
		if(isset($_POST['nonce']) && wp_verify_nonce( $_POST['nonce'], 'addonify-floating-cart-ajax-nonce' )){
			// Get order review fragment
			ob_start();
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				if ($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key']) {
					WC()->cart->remove_cart_item($cart_item_key);
				}
			}

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();

			$mini_cart = ob_get_clean();

			// Fragments returned
			$data = array(
				'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array()),
				'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session())
			);

			wp_send_json($data);
		} else {
			wp_die( __("Invalid request"), "Request Verfication" );
		}
		die();
	}

	public function update_cart_item(){
		if(isset($_POST['nonce']) && wp_verify_nonce( $_POST['nonce'], 'addonify-floating-cart-ajax-nonce' )){
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $product = wc_get_product($cart_item['product_id']);
				if ($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key']) {
					if(esc_html($_POST['type']) === 'update'){
						$nQuantity = (int)esc_html($_POST['quantity']);
					}
					elseif(esc_html($_POST['type']) === 'sub'){
						$nQuantity = $cart_item['quantity'] - 1 ;
					} else {
						$nQuantity = $cart_item['quantity'] + 1 ;
					}
					if($nQuantity <= 0){
						break;
					}
					if($product->get_stock_quantity() ){
						if($product->get_stock_quantity() >= $nQuantity){
							WC()->cart->set_quantity($cart_item_key, $nQuantity);
						}
					} else {
						WC()->cart->set_quantity($cart_item_key, $nQuantity );
					}
				}
			}

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();		
			// Fragments returned
			$data = array(
				'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array()),
				'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session())
			);

			wp_send_json($data);
		} else {
			wp_die( __("Invalid request"), "Request Verification" );
		}
		die();
	}

}


