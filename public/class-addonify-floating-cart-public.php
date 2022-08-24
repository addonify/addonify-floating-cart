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

		// $this->load_dependencies();

		

	}


	public function init() {

		if ( 
			! class_exists( 'WooCommerce' ) || 
			(int) addonify_floating_cart_get_option( 'enable_floating_cart' ) === 0 
		) {
			return;
		}

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_footer', [ $this, 'footer_content' ] );

		add_action( 'wp_ajax_addonify_floating_cart_add_to_cart', [ $this, 'add_to_cart' ]);
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_add_to_cart', [ $this, 'add_to_cart' ]);

		add_action( 'wp_ajax_addonify_floating_cart_add_to_cart_action', [ $this, 'add_to_cart_handler' ]);
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_add_to_cart_action', [ $this, 'add_to_cart_handler' ]);

		add_action( 'wp_ajax_addonify_floating_cart_remove_from_cart', [ $this, 'remove_from_cart' ]);
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_remove_from_cart', [ $this, 'remove_from_cart' ]);

		add_action( 'wp_ajax_addonify_floating_cart_restore_in_cart', [ $this, 'restore_in_cart' ]);
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_restore_in_cart', [ $this, 'restore_in_cart' ]);

		add_action( 'wp_ajax_addonify_floating_cart_update_cart_item', [ $this, 'update_cart_item' ]);
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_update_cart_item', [ $this, 'update_cart_item' ]);

		add_action( 'wp_ajax_addonify_floating_cart_apply_coupon', [ $this, 'apply_coupon' ]);
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_apply_coupon', [ $this, 'apply_coupon' ]);

		add_action( 'wp_ajax_addonify_floating_cart_remove_coupon', [ $this, 'remove_coupon' ]);
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_remove_coupon', [ $this, 'remove_coupon' ]);


		add_filter('woocommerce_add_to_cart_fragments', [$this,'addonify_floating_cart_add_to_cart_fragment']);

		add_filter('addonify_floating_cart/add_to_cart_ajax', [ $this, 'addonify_floating_cart_add_to_cart_ajax']);

		add_filter('woocommerce_coupon_message', [$this, 'addonify_floating_cart_empty_woocommerce_coupon_msg']);

		add_filter('woocommerce_coupon_error', [$this, 'addonify_floating_cart_empty_woocommerce_coupon_msg']);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		if( is_cart() || is_checkout()){
			return;
		}
		wp_enqueue_style('perfect-scrollbar', plugin_dir_url(__FILE__) . 'assets/build/css/conditional/perfect-scrollbar.css', array(), $this->version, 'all');

		wp_enqueue_style('notyf', plugin_dir_url(__FILE__) . 'assets/build/css/conditional/notfy.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/build/css/public.css', array(), $this->version, 'all');

		if ( (int) addonify_floating_cart_get_option( 'load_styles_from_plugin' ) === 1 ) {

			$inline_css = $this->dynamic_css();

			$custom_css = addonify_floating_cart_get_option( 'custom_css' );

			if ( $custom_css ) {
				$inline_css .= $custom_css;
			}
			
			$inline_css = $this->minify_css( $inline_css );

			wp_add_inline_style( $this->plugin_name, $inline_css );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		if( is_cart() || is_checkout()){
			return;
		}
		wp_enqueue_script('perfect-scrollbar', plugin_dir_url(__FILE__) . 'assets/build/js/conditional/perfect-scrollbar.min.js', null, $this->version, true);

		wp_enqueue_script('notyf', plugin_dir_url(__FILE__) . 'assets/build/js/conditional/notfy.min.js', array(), $this->version, true);

		wp_enqueue_script($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'assets/build/js/public.min.js', array('jquery'), $this->version, true);

		wp_localize_script($this->plugin_name . '-public', 'addonifyFloatingCartJSObject', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'ajax_add_to_cart_action' => 'addonify_floating_cart_add_to_cart',
			'add_to_cart_action' => 'addonify_floating_cart_add_to_cart_action',
			'ajax_restore_in_cart_action' => 'addonify_floating_cart_restore_in_cart',
			'ajax_remove_from_cart_action' => 'addonify_floating_cart_remove_from_cart',
			'ajax_update_cart_item_action' => 'addonify_floating_cart_update_cart_item',
			'ajax_apply_coupon' => 'addonify_floating_cart_apply_coupon',
			'ajax_remove_coupon' => 'addonify_floating_cart_remove_coupon',
			'nonce' => wp_create_nonce('addonify-floating-cart-ajax-nonce'),
			'addonifyFloatingCartNotifyShow' => addonify_floating_cart_get_option('display_toast_notification'),
			'addonifyFloatingCartNotifyDuration' => (int)addonify_floating_cart_get_option('close_notification_after_time') * 1000,
			'addonifyFloatingCartNotifyDismissible' => addonify_floating_cart_get_option('display_close_notification_button'),
			'displayToastNotificationButton' => addonify_floating_cart_get_option('display_show_cart_button'),
			'addonifyFloatingCartNotifyMessage' => addonify_floating_cart_get_option('added_to_cart_notification_text'),
			'toast_notification_display_position' => addonify_floating_cart_get_option('toast_notification_display_position'),
			'open_cart_modal_after_click_on_view_cart' => addonify_floating_cart_get_option('open_cart_modal_after_click_on_view_cart'),
			'open_cart_modal_immediately_after_add_to_cart' => addonify_floating_cart_get_option('open_cart_modal_immediately_after_add_to_cart'),
			'show_cart_button_label' => addonify_floating_cart_get_option('show_cart_button_label'),
			'toastNotificationButton' => $this->toast_notification_button_template()
		));
	}


	public function toast_notification_button_template() {

		return apply_filters(
			'addonify_floating_cart/toast_notification_button',
			"<button class='adfy__show-woofc adfy__woofc-fake-button adfy__woofc-notfy-button'>". esc_html( addonify_floating_cart_get_option('show_cart_button_label') ) ."</button>"
		);
	}

	public function footer_content()
	{
		if( is_cart() || is_checkout()){
			return;
		}
		do_action('addonify_floating_cart_add');
	}

	public function load_dependencies(){

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/settings.php';

	}


	public function update_cart_fragments() {
		
		// add_filter('woocommerce_add_to_cart_fragments', function($fragments){
		// 	var_dump( $fragments );
		// 	die();
		// });
	}

	/**
	 * Function for adding items in cart through woocommerce fragments
	 *
	 * @param mixed $fragments
	 * @return array $fragments
	 */
	public function addonify_floating_cart_add_to_cart_fragment($fragments){
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
		do_action('addonify_floating_cart/get_cart_body', array());
		$fragments['.adfy__woofc-content'] = ob_get_clean();

		// ob_start();
		// do_action('addonify_floating_cart/get_cart_shipping_bar', array());
		// $fragments['.adfy__woofc-shipping-bar'] = ob_get_clean();
		// ob_start();
		// do_action('addonify_floating_cart/get_cart_footer',array());
		// $fragments['.adfy__woofc-colophon'] = ob_get_clean();

		if(array_key_exists('product_id', $_POST)){
			$product = wc_get_product( absint($_POST['product_id']) );
			$fragments['product'] = $product->get_title();
		}


		$fragments['.adfy_woofc-badge-count'] = '<span class="adfy_woofc-badge-count">' . WC()->cart->get_cart_contents_count().'</span>';

		$fragments['.woocommerce-Price-amount.discount-amount'] = $this->discount_template();
		
		$fragments['.woocommerce-Price-amount.subtotal-amount'] = $this->subtotal_template();
		
		$fragments['.woocommerce-Price-amount.total-amount'] = $this->total_template();

		$fragments['.adfy__woofc-shipping-text'] = $this->shopping_meter_text_template();

		$fragments['.progress-bar.shipping-bar'] = $this->shopping_meter_bar_template();

		return $fragments;
	}

	public function add_to_cart_handler() {

		$response = array(
			'success' => false,
			'message' => 'Wow'
		);

		wp_send_json( $response );

		wp_die();
	}

	/**
	 * Function updating cart fragments through ajax call
	 * returns array of cart fragments
	 * @return array
	 */
	public function addonify_floating_cart_add_to_cart_ajax()
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
		do_action('addonify_floating_cart/get_cart_body', array());
		$fragments['.adfy__woofc-content'] = ob_get_clean();

		// ob_start();
		// do_action('addonify_floating_cart/get_cart_shipping_bar', array());
		// $fragments['.adfy__woofc-shipping-bar'] = ob_get_clean();

		// ob_start();
		// do_action('addonify_floating_cart/get_cart_footer',array());
		// $fragments['.adfy__woofc-colophon'] = ob_get_clean();

		ob_start();
		do_action('addonify_floating_cart/cart_coupons_available_template', array());
		$fragments['.adfy__woofc-coupons'] = ob_get_clean();

		$fragments['.adfy_woofc-badge-count'] = '<span class="adfy_woofc-badge-count">' . WC()->cart->get_cart_contents_count().'</span>';
		
		$fragments['.woocommerce-Price-amount.discount-amount'] = $this->discount_template();
		
		$fragments['.woocommerce-Price-amount.subtotal-amount'] = $this->subtotal_template();
		
		$fragments['.woocommerce-Price-amount.total-amount'] = $this->total_template();

		$fragments['.adfy__woofc-shipping-text'] = $this->shopping_meter_text_template();

		$fragments['.progress-bar.shipping-bar'] = $this->shopping_meter_bar_template();

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
			$product_name = '';
            $restore_cart_item_key = false;
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				if ($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key']) {
					$product = wc_get_product($cart_item['product_id']);
					$product_name = $product->get_title();
					$restore_cart_item_key = $cart_item_key;
					WC()->cart->remove_cart_item($cart_item_key);
					break;
				}
			}

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();
			$this->check_coupons();

			// Fragments returned
			$data = array(
				'fragments' => apply_filters('addonify_floating_cart/add_to_cart_ajax', array()),
				'cart_items' => WC()->cart->get_cart_contents_count(),
				'undo_product_link' => $this->cart_undo_template( $product_name, $restore_cart_item_key )
			);
			
			if($contents_count === 0){
				$data['no_data_html'] = esc_html( apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty.', 'addonify-floating-cart' ) ) );
			}

			wp_send_json($data);
		} else {
			wp_die( __("Invalid request"), "Request Verification" );
		}
		die();
	}

	/**
	 * restore removed cart item through ajax
	 * @since    1.0.0
	 */
	public function restore_in_cart(){
		$error = true;
		if(isset($_POST['nonce']) && wp_verify_nonce( $_POST['nonce'], 'addonify-floating-cart-ajax-nonce' )){
			$item_key = $_POST['cart_item_key'];
			if(!array_key_exists($item_key, WC()->cart->get_cart())){
				if(!empty($item_key)){
					$restored = WC()->cart->restore_cart_item($item_key);
					WC()->cart->calculate_totals();
					WC()->cart->maybe_set_cart_cookies();
					$error = !$restored;
					$msg = $restored ? esc_html(apply_filters('addonify-floating-cart-restored-success-message',__("Restored successfully.","addonify-floating-cart"))) : esc_html(apply_filters('addonify-floating-cart-restore-fail-message',__("Could not be restored.","addonify-floating-cart")));
				} else {
					$msg = esc_html(apply_filters('addonify-floating-cart-restore-key-missing-message',__("Key Missing","addonify-floating-cart")));
				}
			} else {
				$msg = "Already exists in cart";
			}
			$fragments = apply_filters('addonify_floating_cart/add_to_cart_ajax', array());
			ob_start();
			do_action('addonify_floating_cart/get_cart_body', array());
			$fragments['.adfy__woofc-content'] = ob_get_clean();
			$data = array(
				'fragments' => $fragments,
				'error' => $error,
				'message' => $msg,
				'cart_items' => WC()->cart->get_cart_contents_count()
			);
			wp_send_json($data);
		} else {
			wp_die( __("Invalid request"), "Request Verification" );
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
			$error = false;
            $quantity = false;
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
						$error = esc_html(apply_filters('addonify-floating-cart-quantity-must-be-greater-than-zero-message',__("Quantity must be more than zero.","addonify-floating-cart")));
						unset($nQuantity);
						break;
					}
					if($product->get_stock_quantity() ){
						if($product->get_stock_quantity() >= $nQuantity){
							WC()->cart->set_quantity($cart_item_key, $nQuantity);
						} else {
							$error = esc_html(apply_filters('addonify-floating-cart-quantity-not-available-message',__("Not available in the given quantity.","addonify-floating-cart")));
							unset($nQuantity);
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
				'nQuantity' => isset($nQuantity) ? $nQuantity : $quantity,
				'fragments' => apply_filters('addonify_floating_cart/add_to_cart_ajax', array()),
				'error_msg' => $error,
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
						$status = $coupon_apply ? esc_html(apply_filters('addonify-floating-cart-coupon-applied-message',__("Coupon applied","addonify-floating-cart"))) : esc_html(apply_filters('addonify-floating-cart-invalid-coupon-message',__("Invalid Coupon Code...","addonify-floating-cart")));
					} else {
						$status = esc_html($coupon_status->get_error_message());
					}
				}

			} else {
				$status = esc_html(apply_filters('addonify-floating-cart-input-coupon-to-apply-message',__('Please input a coupon to apply.',"addonify-floating-cart")));
			}
		} else {
			$status = esc_html(apply_filters('addonify-floating-cart-source-verification-error-message',__('Source verification error.',"addonify-floating-cart")));
		}
		$this->check_coupons();

		// ob_start();
		// 	do_action('addonify_floating_cart/get_cart_footer');
		// $cart_summary = ob_get_clean();

		ob_start();
			do_action('addonify_floating_cart/cart_coupons_available_template');
		$coupons = ob_get_clean();

		// ob_start();
		// 	do_action('addonify_floating_cart/get_cart_shipping_bar');
		// $shippping_bar = ob_get_clean();

		echo json_encode(array(
			'couponApplied' => $coupon_apply,
			'status' => $status,
			'appliedCoupons' => count( WC()->cart->get_applied_coupons() ),
			'html' => array(
				// '.adfy__woofc-colophon' => $cart_summary,
				'.adfy__woofc-coupons' => $coupons,
				// '.adfy__woofc-shipping-bar' => $shippping_bar,
				'.woocommerce-Price-amount.discount-amount' => $this->discount_template(),
				'.woocommerce-Price-amount.subtotal-amount' => $this->subtotal_template(),
				'.woocommerce-Price-amount.total-amount' => $this->total_template(),
				'.adfy__woofc-shipping-text' => $this->shopping_meter_text_template(),
				'.progress-bar.shipping-bar' => $this->shopping_meter_bar_template()
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
				$status = $coupon_remove ? esc_html(apply_filters('addonify-floating-cart-coupon-removed-message',__("Coupon removed","addonify-floating-cart"))) : esc_html(apply_filters('addonify-floating-cart-source-invalid-coupon-error-message',__("Invalid Coupon Code.","addonify-floating-cart")));
			} else {
				$status = esc_html(apply_filters('addonify-floating-cart-no-coupon-message',__('Please input a coupon to apply.',"addonify-floating-cart")));
			}
		} else {
            $status = esc_html(apply_filters('addonify-floating-cart-source-verification-error-message',__('Source verification error.',"addonify-floating-cart")));
		}
		$this->check_coupons();

		// ob_start();
		// do_action('addonify_floating_cart/get_cart_footer');
		// $cart_summary = ob_get_clean();

		ob_start();
		do_action('addonify_floating_cart/cart_coupons_available_template');
		$coupons = ob_get_clean();

		// ob_start();
		// do_action('addonify_floating_cart/get_cart_shipping_bar');
		// $shippping_bar = ob_get_clean();

		echo json_encode(array(
			'couponRemoved' => $coupon_remove,
			'status' => $status,
			'appliedCoupons' => count( WC()->cart->get_applied_coupons() ),
			'html' => array(
				// '.adfy__woofc-colophon' => $cart_summary,
				'#adfy__woofc-applied-coupons' => $coupons,
				// '.adfy__woofc-shipping-bar' => $shippping_bar,
				'.woocommerce-Price-amount.discount-amount' => $this->discount_template(),
				'.woocommerce-Price-amount.subtotal-amount' => $this->subtotal_template(),
				'.woocommerce-Price-amount.total-amount' => $this->total_template(),
				'.adfy__woofc-shipping-text' => $this->shopping_meter_text_template(),
				'.progress-bar.shipping-bar' => $this->shopping_meter_bar_template()
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


	public function cart_undo_template( $product_name, $cart_item_key ) {

		return $product_name . __( ' has been removed.', 'addonify-floating-cart' ) . '<a class="adfy__woofc-restore-item" id="adfy__woofc_restore_item" data-item_key="' . esc_attr( $cart_item_key ) . '" class="restore-item">' . __( 'Undo?', 'addonify-floating-cart' ) . '</a>';
	}

	public function discount_template() {
		return apply_filters(
			'addonify_floating_cart/discount_template',
			'<span class="woocommerce-Price-amount discount-amount"><bdi>'. get_woocommerce_currency_symbol() . WC()->cart->get_cart_discount_total() . '</bdi>
			</span>'
		);
	}

	public function subtotal_template() {
		return apply_filters(
			'addonify_floating_cart/subtotal_template',
			'<span class="woocommerce-Price-amount subtotal-amount"><bdi>'. WC()->cart->get_cart_subtotal() . '</bdi>
			</span>'
		);
	}

	public function total_template() {
		return apply_filters(
			'addonify_floating_cart/total_template',
			'<span class="woocommerce-Price-amount total-amount"><bdi>'. WC()->cart->get_cart_total() . '</bdi>
			</span>'
		);
	}


	public function shopping_meter_text_template() {

		$shopping_threshold_amount = (int)addonify_floating_cart_get_option('customer_shopping_meter_threshold');

		$cart_total = WC()->cart->get_cart_contents_total();

		$shopping_threshold_text = addonify_floating_cart_get_option('customer_shopping_meter_pre_threshold_label');

		$final_shopping_threshold_text = addonify_floating_cart_get_option('customer_shopping_meter_post_threshold_label');

		if ( $cart_total >= $shopping_threshold_amount ) {
			$shopping_threshold_text = addonify_floating_cart_get_option('customer_shopping_meter_post_threshold_label');
		} else {
			
			$left_amount = $shopping_threshold_amount - $cart_total;

			$shopping_threshold_text = str_replace( "{amount}", get_woocommerce_currency_symbol() . $left_amount, $shopping_threshold_text );
		}

		return apply_filters(
			'addonify_floating_cart/shopping_meter_text',
			'<span class="adfy__woofc-shipping-text">' . esc_html( $shopping_threshold_text ) . '</span>'
		);
	}

	public function shopping_meter_bar_template() {

		$shopping_threshold_amount = (int)addonify_floating_cart_get_option('customer_shopping_meter_threshold');

		$cart_total = WC()->cart->get_cart_contents_total();

		$per = 0;

		if ( $cart_total >= $shopping_threshold_amount ) {
			$per = 100;
		} else {
			$per =  100 - ( ($shopping_threshold_amount - $cart_total) / $shopping_threshold_amount * 100);
		}

		return apply_filters(
			'addonify_floating_cart/shopping_meter_bar',
			'<div class="progress-bar shipping-bar" data_percentage="' . esc_attr( $per ) . '" style="width:' . esc_attr( $per ) . '%"></div>' 
		);
	}

	public function addonify_floating_cart_empty_woocommerce_coupon_msg($msg){
		if(wp_doing_ajax()){
			return NULL;
		} else {
			return $msg;
		}
	}
	/**
	 * to get html of an item provided a key
	 * @param string $key
	 * @return string $html
	 */
	public function get_item_from_key($key){
		ob_start();
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			if ($cart_item_key == $key) {
                if(isset($cart_item['variation_id']) && $cart_item['variation_id']){
                    $variation = new WC_Product_Variation($cart_item['variation_id']);
                } else {
                    $variation = NULL;
                }
				$product = wc_get_product($cart_item['product_id']);
                ?>
                <div class="adfy__woofc-item">
                    <?php
                        do_action( 'addonify_floating_cart/get_cart_body_image', array(
                            'product' => $product,
                            'cart_item_key' => $cart_item_key,
                            'cart_item' => $cart_item,
                            'variation' => $variation,
                        ));
                    ?>
                    <div class="adfy__woofc-item-content">
                        <?php
                        do_action( 'addonify_floating_cart/get_cart_body_title', array(
                            'product' => $product,
                            'cart_item' => $cart_item,
                        ));
                        do_action('addonify_floating_cart/get_cart_body_quantity_price', array(
                            'product' => $product,
                            'cart_item' => $cart_item,
                            'variation' => $variation,
                        ));
                        do_action( 'addonify_floating_cart/get_cart_body_quantity_field', array(
                            'product' => $product,
                            'cart_item_key' => $cart_item_key,
                            'cart_item' => $cart_item,
                        ));
                        ?>
                    </div>
                </div><!-- // adfy__woofc-item -->
                <?php
				break;
			}
		}
		return ob_get_clean();
	}




	/**
	 * Print dynamic CSS generated from settings page.
	 */
	public function dynamic_css() {

		$css_values = array( 
			'--adfy_woofc_cart_width' => addonify_floating_cart_get_option('cart_modal_width') . 'px', // New
			'--adfy_woofc_base_text_color' => addonify_floating_cart_get_option('cart_modal_base_text_color'), 
			'--adfy_woofc_base_link_color' =>  addonify_floating_cart_get_option('cart_modal_content_link_color'),	
			'--adfy_woofc_base_link_color_hover' => addonify_floating_cart_get_option('cart_modal_content_link_on_hover_color'),
			'--adfy_woofc_base_text_font_size' => addonify_floating_cart_get_option('cart_modal_base_font_size') . 'px',
			'--adfy_woofc_border_color' => addonify_floating_cart_get_option('cart_modal_border_color'),
			'--adfy_woofc_cart_background_color' => addonify_floating_cart_get_option('cart_modal_background_color'),
			'--adfy_woofc_cart_overlay_background_color' => addonify_floating_cart_get_option('cart_modal_overlay_color'), 

			'--adfy_woofc_toggle_button_text_color' => addonify_floating_cart_get_option('toggle_button_label_color'),
			'--adfy_woofc_toggle_button_text_color_hover' => addonify_floating_cart_get_option('toggle_button_on_hover_label_color'),
			'--adfy_woofc_toggle_button_background_color' => addonify_floating_cart_get_option('toggle_button_background_color'),
			'--adfy_woofc_toggle_button_background_color_hover' =>addonify_floating_cart_get_option('toggle_button_on_hover_background_color'), 
			'--adfy_woofc_toggle_button_border_color' => addonify_floating_cart_get_option('toggle_button_border_color'),
			'--adfy_woofc_toggle_button_border_color_hover' => addonify_floating_cart_get_option('toggle_button_on_hover_border_color'),
			'--adfy_woofc_toggle_button_badge_text_color' => addonify_floating_cart_get_option('toggle_button_badge_label_color'),
			'--adfy_woofc_toggle_button_badge_background_color' => addonify_floating_cart_get_option('toggle_button_badge_background_color'),
			'--adfy_woofc_toggle_button_badge_width' => addonify_floating_cart_get_option('toggle_button_badge_width'), // New
			'--adfy_woofc_toggle_button_badge_font_size' => addonify_floating_cart_get_option('toggle_button_badge_font_size') . 'px', // New
			'--adfy_woofc_toggle_button_size' => addonify_floating_cart_get_option('cart_modal_toggle_button_width') . 'px',
			'--adfy_woofc_toggle_button_border_radius' => addonify_floating_cart_get_option('cart_modal_toggle_button_border_radius') . 'px', // New
			'--adfy_woofc_toggle_button_cart_icon_font_size' => addonify_floating_cart_get_option('cart_modal_toggle_button_icon_font_size') . 'px',
			'--adfy_woofc_toggle_button_horizental_offset' => addonify_floating_cart_get_option('cart_modal_toggle_button_horizontal_offset') . 'px',
			'--adfy_woofc_toggle_button_vertical_offset' => addonify_floating_cart_get_option('cart_modal_toggle_button_vertical_offset') . 'px',

			// General Buttons styles
			'--adfy_woofc_base_button_font_size' => addonify_floating_cart_get_option('cart_modal_buttons_font_size') . 'px',
			'--adfy_woofc_base_button_font_weight' => addonify_floating_cart_get_option('cart_modal_buttons_font_weight'),
			'--adfy_woofc_base_button_letter_spacing' => addonify_floating_cart_get_option('cart_modal_buttons_letter_spacing'),
			'--adfy_woofc_base_button_border_radius' => addonify_floating_cart_get_option('cart_modal_buttons_border_radius') . 'px',
			'--adfy_woofc_base_button_text_transform' => addonify_floating_cart_get_option('cart_modal_buttons_text_transform'),
			'--adfy_woofc_primary_button_label_color' => addonify_floating_cart_get_option('cart_modal_primary_button_label_color'),
			'--adfy_woofc_primary_button_label_color_hover' => addonify_floating_cart_get_option('cart_modal_primary_button_on_hover_label_color'),
			'--adfy_woofc_primary_button_background_color' => addonify_floating_cart_get_option('cart_modal_primary_button_background_color'),
			'--adfy_woofc_primary_button_background_color_hover' => addonify_floating_cart_get_option('cart_modal_primary_button_on_hover_background_color'),
			'--adfy_woofc_primary_button_border_color' => addonify_floating_cart_get_option('cart_modal_primary_button_border_color'),
			'--adfy_woofc_primary_button_border_color_hover' => addonify_floating_cart_get_option('cart_modal_primary_button_on_hover_border_color'),

			'--adfy_woofc_secondary_button_label_color' => addonify_floating_cart_get_option('cart_modal_secondary_button_label_color'),
			'--adfy_woofc_secondary_button_label_color_hover' => addonify_floating_cart_get_option('cart_modal_secondary_button_on_hover_label_color'),
			'--adfy_woofc_secondary_button_background_color' => addonify_floating_cart_get_option('cart_modal_secondary_button_background_color'),
			'--adfy_woofc_secondary_button_background_color_hover' => addonify_floating_cart_get_option('cart_modal_secondary_button_on_hover_background_color'),
			'--adfy_woofc_secondary_button_border_color' => addonify_floating_cart_get_option('cart_modal_secondary_button_border_color'),
			'--adfy_woofc_secondary_button_border_color_hover' => addonify_floating_cart_get_option('cart_modal_secondary_button_on_hover_border_color'),
			
			// Miscellaneous
			'--adfy_woofc_cart_input_placeholder_color' => addonify_floating_cart_get_option('cart_modal_input_field_placeholder_color'),
			'adfy_woofc_cart_input_border_color' => addonify_floating_cart_get_option('cart_modal_input_field_text_color'),
			'--adfy_woofc_cart_input_border_color' => addonify_floating_cart_get_option('cart_modal_input_field_border_color'),
			'--adfy_woofc_cart_input_background_color' => addonify_floating_cart_get_option('cart_modal_input_field_background_color'),
			// Shopping meter
			'--adfy_woofc_shopping_meter_initial_background_color' => addonify_floating_cart_get_option('cart_shopping_meter_initial_background_color'),
			'--adfy_woofc_shopping_meter_progress_background_color' => addonify_floating_cart_get_option('cart_shopping_meter_progress_background_color'),

			// Toast notification
			'--adfy_woofc_toast_text_color' => addonify_floating_cart_get_option('toast_notification_text_color'),
			'--adfy_woofc_toast_background_color' => addonify_floating_cart_get_option('toast_notification_background_color'),
			'--adfy_woofc_toast_button_text_color' => addonify_floating_cart_get_option('toast_notification_button_label_color'),
			'--adfy_woofc_toast_button_text_color_hover' => addonify_floating_cart_get_option('toast_notification_button_on_hover_label_color'),
			'--adfy_woofc_toast_button_background_color' => addonify_floating_cart_get_option('toast_notification_button_background_color'),
			'--adfy_woofc_toast_button_background_color_hover' => addonify_floating_cart_get_option('toast_notification_button_on_hover_background_color'),

			// Cart & cart title
			
			'--adfy_woofc_cart_title_text_color' => addonify_floating_cart_get_option('cart_modal_title_color'),
			'--adfy_woofc_cart_title_font_size' => addonify_floating_cart_get_option('cart_title_font_size') . 'px', // New
			'--adfy_woofc_cart_title_font_weight' => addonify_floating_cart_get_option('cart_title_font_weight'), // New
			'--adfy_woofc_cart_title_letter_spacing' => addonify_floating_cart_get_option('cart_title_letter_spacing'), // New
			'--adfy_woofc_cart_title_text_transform' => addonify_floating_cart_get_option('cart_title_text_transform'), // New
			'--adfy_woofc_cart_title_count_badge_text_color' => addonify_floating_cart_get_option('cart_modal_badge_text_color'),
			'--adfy_woofc_cart_title_count_badge_background_color' => addonify_floating_cart_get_option('cart_modal_badge_background_color'),

			'--adfy_woofc_cart_close_button_text_color' => addonify_floating_cart_get_option('cart_modal_close_icon_color'),
			'--adfy_woofc_cart_close_button_text_color_hover' => addonify_floating_cart_get_option('cart_modal_close_icon_on_hover_color'),

			'--adfy_woofc_cart_field_placeholder_color' => addonify_floating_cart_get_option('cart_modal_input_field_placeholder_color'), // TO DO
			'--adfy_woofc_cart_field_background_color' => addonify_floating_cart_get_option('cart_modal_input_field_background_color'),		
			'--adfy_woofc_cart_field_text_color' => addonify_floating_cart_get_option('cart_modal_input_field_text_color'),				
			'--adfy_woofc_cart_field_border_color' =>  addonify_floating_cart_get_option('cart_modal_input_field_border_color'),

			// Product titles
			'--adfy_woofc_cart_product_title_text_color' => addonify_floating_cart_get_option('cart_modal_product_title_color'), 
			'--adfy_woofc_cart_product_title_text_color_hover' => addonify_floating_cart_get_option('cart_modal_product_title_on_hover_color'),
			'--adfy_woofc_cart_product_price_quantity_text_color' => addonify_floating_cart_get_option('cart_modal_product_quantity_price_color'), 
			'--adfy_woofc_cart_product_quantity_text_color' => addonify_floating_cart_get_option('cart_modal_base_text_color'),
			'--adfy_woofc_cart_product_quantity_input_button_text_color' => addonify_floating_cart_get_option('cart_modal_base_text_color'),
			'--adfy_woofc_cart_product_remove_button_text_color' => addonify_floating_cart_get_option('cart_modal_product_remove_button_icon_color'),
			'--adfy_woofc_cart_product_remove_button_text_color_hover' => addonify_floating_cart_get_option('cart_modal_product_remove_button_on_hover_icon_color'),
			'--adfy_woofc_cart_product_remove_button_background_color' => addonify_floating_cart_get_option('cart_modal_product_remove_button_background_color'),
			'--adfy_woofc_cart_product_remove_button_background_color_hover' => addonify_floating_cart_get_option('cart_modal_product_remove_button_on_hover_background_color'),
			'--adfy_woofc_cart_product_title_font_size' => addonify_floating_cart_get_option('cart_modal_product_title_font_size') . 'px',
			'--adfy_woofc_cart_product_title_font_weight' => addonify_floating_cart_get_option('cart_modal_product_title_font_weight'),
		);

		$css = ':root {';

		foreach ( $css_values as $key => $value ) {

			if ( $value ) {
				$css .= $key . ': ' . $value . ';';
			}
		}

		$css .= '}';

		return $css;
	}

	/**
	 * Minify the dynamic css.
	 * 
	 * @param string $css css to minify.
	 * @return string minified css.
	 */
	public function minify_css( $css ) {

		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		return trim( $css );
	}
}


