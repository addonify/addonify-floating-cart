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

		$this->load_dependencies();

		add_filter('woocommerce_add_to_cart_fragments', [$this,'addonify_floating_cart_add_to_cart_fragment']);

		add_filter('addonify_floating_cart/add_to_cart_ajax', [ $this, 'addonify_floating_cart_add_to_cart_ajax']);

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

		wp_enqueue_script($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'assets/build/js/public.min.js', array('jquery'), $this->version, true);

		wp_localize_script($this->plugin_name . '-public', 'addonifyFloatingCartJSObject', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'ajax_add_to_cart_action' => 'addonify_floating_cart_add_to_cart',
			'ajax_remove_from_cart_action' => 'addonify_floating_cart_remove_from_cart',
			'ajax_update_cart_item_action' => 'addonify_floating_cart_update_cart_item',
			'ajax_apply_coupon' => 'addonify_floating_cart_apply_coupon',
			'ajax_remove_coupon' => 'addonify_floating_cart_remove_coupon',
			'nonce' => wp_create_nonce('addonify-floating-cart-ajax-nonce')
		));
	}

	public function footer_content()
	{
		if(is_page('cart') || is_cart() || is_page('checkout') || is_checkout()){
			return;
		} else{
			do_action('addonify_floating_cart_add');
		}
	}

	public function load_dependencies(){

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/settings.php';

	}
	/**
	 * Function for adding items in cart through woocommerce fragments
	 * 
	 * @param mixed $fragments
	 * @return array $fragments
	 */
	public static function addonify_floating_cart_add_to_cart_fragment($fragments){
		ob_start();
		?>
			<span class="adfy__woofc-badge">
				<?php 
				printf( _nx(' %1$s Item', '%1$s Items', esc_html(WC()->cart->get_cart_contents_count()), 'number of cart items', 'addonify-floating-cart'),
					esc_html(WC()->cart->get_cart_contents_count())); 
				?>          
			</span>
		<?php
		$fragments['.adfy__woofc-badge'] = ob_get_clean();
		ob_start();
		do_action('addonify_floating_cart_get_cart_body', array());
		$fragments['.adfy__woofc-content'] = ob_get_clean();
		ob_start();
		do_action('addonify_floating_cart_get_cart_shipping_bar', array());
		$fragments['.adfy__woofc-shipping-bar'] = ob_get_clean();

		ob_start();
		do_action('addonify_floating_cart_get_cart_footer',array());
		$fragments['.adfy__woofc-colophon'] = ob_get_clean();


		$fragments['.badge'] = '<span class="badge">'.WC()->cart->get_cart_contents_count().'</span>';

		return $fragments;
	}

	/**
	 * Function updating cart fragments through ajax call
	 * returns array of cart fragments
	 * @return array 
	 */
	public static function addonify_floating_cart_add_to_cart_ajax()
	{

		ob_start();
		?>
			<span class="adfy__woofc-badge">
				<?php 
				printf( _nx(' %1$s Item', '%1$s Items', esc_html(WC()->cart->get_cart_contents_count()), 'number of cart items', 'addonify-floating-cart'),
					esc_html(WC()->cart->get_cart_contents_count())); 
				?>          
			</span>
		<?php
		$fragments['.adfy__woofc-badge'] = ob_get_clean();

		ob_start();
		do_action('addonify_floating_cart_get_cart_shipping_bar', array());
		$fragments['.adfy__woofc-shipping-bar'] = ob_get_clean();

		ob_start();
		do_action('addonify_floating_cart_get_cart_footer',array());
		$fragments['.adfy__woofc-colophon'] = ob_get_clean();

		ob_start();
		do_action('addonify_floating_cart_get_cart_coupons_available', array());
		$fragments['#adfy__woofc-coupons-available'] = ob_get_clean();

		$fragments['.badge'] = '<span class="badge">'.WC()->cart->get_cart_contents_count().'</span>';

		return $fragments;

	}

	/**
	 * function for ajax call to remove item from cart
	 * prints array of cart fragments
	 * @since    1.0.0
	 */
	public function remove_from_cart()
	{
		if(isset($_POST['nonce']) && wp_verify_nonce( $_POST['nonce'], 'addonify-floating-cart-ajax-nonce' )){
			// Get order review fragment
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				if ($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key']) {
					WC()->cart->remove_cart_item($cart_item_key);
				}
			}

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();
			$this->check_coupons();

			$contents_count = WC()->cart->get_cart_contents_count();

			// Fragments returned
			$data = array(
				'fragments' => apply_filters('addonify_floating_cart/add_to_cart_ajax', array()),
				'cart_items' => $contents_count,
			);
			if($contents_count === 0){
				$data['no_data_html'] = esc_html( apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty.', 'addonify-floating-cart' ) ) );
			}

			wp_send_json($data);
		} else {
			wp_die( __("Invalid request"), "Request Verfication" );
		}
		die();
	}

	/**
	 * function for ajax call to update item in cart
	 * prints array of cart fragments
	 * @since    1.0.0
	 * 
	 */
	public function update_cart_item(){
		if(isset($_POST['nonce']) && wp_verify_nonce( $_POST['nonce'], 'addonify-floating-cart-ajax-nonce' )){
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $product = wc_get_product($cart_item['product_id']);
				if ($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key']) {
					$quantity = $cart_item['quantity'];
					if(esc_html($_POST['type']) === 'update'){
						$nQuantity = (int)esc_html($_POST['quantity']);
					}
					elseif(esc_html($_POST['type']) === 'sub'){
						$nQuantity = $cart_item['quantity'] - 1 ;
					} else {
						$nQuantity = $cart_item['quantity'] + 1 ;
					}
					if($nQuantity <= 0){
						unset($nQuantity);
						break;
					}
					if($product->get_stock_quantity() ){
						if($product->get_stock_quantity() >= $nQuantity){
							WC()->cart->set_quantity($cart_item_key, $nQuantity);
						} else {
							$nQuantity = 'OoS';
						}
					} else {
						WC()->cart->set_quantity($cart_item_key, $nQuantity );
					}
					break;
				}
			}
			$this->check_coupons();

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();		
			// Fragments returned
			$data = array(
				'nQuantity' => $nQuantity ?? $quantity,
				'fragments' => apply_filters('addonify_floating_cart/add_to_cart_ajax', array()),
			);

			wp_send_json($data);
		} else {
			wp_die( __("Invalid request"), "Request Verification" );
		}
		die();
	}

	/**
	 * function for ajax call to apply coupon in cart
	 * prints array of coupon div and if the coupon was applied status
	 * @since    1.0.0
	 */
	public function apply_coupon(){
		$coupon_apply = false;
		if(!empty($_POST['nonce']) && wp_verify_nonce( $_POST['nonce'], 'addonify-floating-cart-ajax-nonce' )){
			$code = esc_html($_POST['form_data']);
			if(!empty($code)){
				if(in_array($code, WC()->cart->get_applied_coupons())){
					$status = "Coupon already applied.";
				} else {
					$coupon = new WC_Coupon($code);
					$discounts = new WC_Discounts( WC()->cart);
					$coupon_status = $discounts->is_coupon_valid($coupon);
					if(is_bool($coupon_status)){
						$coupon_apply = WC()->cart->apply_coupon($code);
						WC()->cart->calculate_totals();
						WC()->cart->maybe_set_cart_cookies();
						$status = $coupon_apply ? "Coupon applied" : "Invalid Coupon Code...";
					} else {
						$status = $coupon_status->get_error_message();
					}
				}

			} else {
				$status = 'Please input a coupon to apply.';
			}
		} else {
			$status = 'Source verification error.';
		}
		$this->check_coupons();
		ob_start();
			do_action('addonify_floating_cart_get_cart_footer');
		$cart_summary = ob_get_clean();

		ob_start();
		addonify_floating_cart_get_template('cart-sections/coupons-available.php');
		$coupons = ob_get_clean();

		ob_start();
		addonify_floating_cart_get_template('cart-sections/shipping-bar.php');
		$shippping_bar = ob_get_clean();
		echo json_encode(array(
			'couponApplied' => $coupon_apply,
			'status' => $status,
			'html' => array(
				'.adfy__woofc-colophon' => $cart_summary,
				'#adfy__woofc-coupons-available' => $coupons,
				'.adfy__woofc-shipping-bar' => $shippping_bar
			)
		));die;
	}

	/**
	 * function for ajax call to remove coupon in cart
	 * prints array of coupon div and if the coupon was removed status
	 * @since    1.0.0
	 */
	public function remove_coupon(){
		$coupon_remove = false;
		if(!empty($_POST['nonce']) && wp_verify_nonce( $_POST['nonce'], 'addonify-floating-cart-ajax-nonce' )){
			$code = esc_html($_POST['form_data']);
			if(!empty($code)){
				$coupon_remove = WC()->cart->remove_coupon($code);
				WC()->cart->calculate_totals();
				WC()->cart->maybe_set_cart_cookies();
				$status = $coupon_remove ? "Coupon removed" : "Invalid Coupon Code.";
			} else {
				$status = 'Please input a coupon to apply.';
			}
		} else {
			$status = 'Source verification error.';
		}
		$this->check_coupons();
		ob_start();
		addonify_floating_cart_get_template('cart-sections/footer.php');
		$cart_summary = ob_get_clean();

		ob_start();
		addonify_floating_cart_get_template('cart-sections/coupons-available.php');
		$coupons = ob_get_clean();

		ob_start();
		addonify_floating_cart_get_template('cart-sections/shipping-bar.php');
		$shippping_bar = ob_get_clean();

		echo json_encode(array(
			'couponRemoved' => $coupon_remove,
			'status' => $status,
			'html' => array(
				'.adfy__woofc-colophon' => $cart_summary,
				'#adfy__woofc-coupons-available' => $coupons,
				'.adfy__woofc-shipping-bar' => $shippping_bar
			)
		));die;
	}

	/**
	 * Function to check if all the applied coupons are valid
	 * Rejects coupons that are no longer valid in cart
	 */
	public function check_coupons(){
		WC()->cart->check_cart_coupons();
	}
}


