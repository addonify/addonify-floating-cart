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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
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


		add_filter('woocommerce_add_to_cart_fragments', [$this,'add_to_cart_fragment']);

		add_filter('woocommerce_coupon_message', [$this, 'woocommerce_coupon_msg']);

		add_filter('woocommerce_coupon_error', [$this, 'woocommerce_coupon_msg']);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if( is_cart() || is_checkout() ){
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
	public function enqueue_scripts() {

		if( is_cart() || is_checkout()){
			return;
		}

		wp_enqueue_script('perfect-scrollbar', plugin_dir_url(__FILE__) . 'assets/build/js/conditional/perfect-scrollbar.min.js', null, $this->version, true);

		wp_enqueue_script('notyf', plugin_dir_url(__FILE__) . 'assets/build/js/conditional/notfy.min.js', array(), $this->version, true);

		wp_enqueue_script($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'assets/build/js/public.min.js', array('jquery'), $this->version, true);

		wp_localize_script($this->plugin_name . '-public', 'addonifyFloatingCartJSObject', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'ajax_add_to_cart_action' => 'addonify_floating_cart_add_to_cart',
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

	/**
	 * Template for displaying sidebar cart toggle button.
	 *
	 * @since    1.0.0
	 */
	public function toast_notification_button_template() {

		return apply_filters(
			'addonify_floating_cart_toast_notification_button',
			"<button class='adfy__show-woofc adfy__woofc-fake-button adfy__woofc-notfy-button'>". esc_html( addonify_floating_cart_get_option('show_cart_button_label') ) ."</button>"
		);
	}

	/**
	 * Insert sidebar cart toggle button and sidebar cart at the footer.
	 *
	 * @since    1.0.0
	 */
	public function footer_content() {

		if ( 
			is_cart() || 
			is_checkout() 
		) {

			return;
		}

		do_action( 'addonify_floating_cart_footer_template' );
	}


	/**
	 * Function for adding items in cart through woocommerce fragments
	 *
	 * @param mixed $fragments
	 * @return array $fragments
	 */
	public function add_to_cart_fragment( $fragments ) {
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
		do_action('addonify_floating_cart_sidebar_cart_body', array());
		$fragments['.adfy__woofc-content'] = ob_get_clean();

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


	/**
	 * Function updating cart fragments through ajax call
	 * returns array of cart fragments
	 * @return array
	 */
	public function add_to_cart_ajax( $fragments = array() ) {

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
		do_action('addonify_floating_cart_sidebar_cart_body', array());
		$fragments['.adfy__woofc-content'] = ob_get_clean();


		ob_start();
		do_action('addonify_floating_cart_sidebar_cart_applied_coupons', array());
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
	public function remove_from_cart() {

		$return_response = array(
			'success' => false,
		);

		$nonce = isset( $_POST['nonce'] ) ? wp_unslash( $_POST['nonce']  ) : '';

		if ( 
			$nonce && 
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' ) 
		) {
			$product_name = '';
            $restore_cart_item_key = false;
			$post_product_id = isset( $_POST['product_id'] ) ? (int) wp_unslash( $_POST['product_id'] ) : '';
			$post_cart_item_key = isset( $_POST['cart_item_key'] ) ? wp_unslash( $_POST['cart_item_key'] ) : '';

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				if ( 
					$cart_item['product_id'] === $post_product_id && 
					$cart_item_key === $post_cart_item_key 
				) {
					$product = wc_get_product( $cart_item['product_id'] );
					$product_name = $product->get_title();
					if ( WC()->cart->remove_cart_item( $cart_item_key ) === true ) {
						$return_response['success'] = true;
						$return_response['cart_hash'] = WC()->cart->get_cart_hash();
						$return_response['message'] = __( "{$product_name} is removed successfully the cart.", 'addonify-floating-cart' );
						$return_response['undo_product_link'] = $this->cart_undo_template( $product_name, $cart_item_key );
					} else {
						$return_response['success'] = false;
						$return_response['message'] = __( "Error removing {$product_name} from the cart.", 'addonify-floating-cart' );
					}
					break;
				} else {
					$return_response['success'] = false;
					$return_response['message'] = __( "Invalid product id or cart item key.", 'addonify-floating-cart' );
				}
			}

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();
			$this->check_coupons();

			// Fragments returned
			$return_response['fragments'] = apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() );
			$return_response['cart_items_count'] = WC()->cart->get_cart_contents_count();
			
			
			if ( WC()->cart->get_cart_contents_count() === 0 ) {
				$return_response['empty_cart_message'] = apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty.', 'addonify-floating-cart' ) );
			}

			wp_send_json( $return_response );

		} else {

			wp_send_json( array(
				'success' => false,
				'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', 'addonify-floating-cart' ) ),
			) );
		}

		wp_die();
	}

	/**
	 * restore removed cart item through ajax
	 * @since    1.0.0
	 */
	public function restore_in_cart() {

		$error = true;

		$return_response = array(
			'success' => false,
			'message' => '',
		);

		$nonce = isset( $_POST['nonce'] ) ? wp_unslash( $_POST['nonce']  ) : '';

		if ( 
			$nonce && 
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' ) 
		) {
			
			$post_cart_item_key = isset( $_POST['cart_item_key'] ) ? wp_unslash( $_POST['cart_item_key'] ) : '';

			if ( !empty( $post_cart_item_key ) ) {

				if ( ! array_key_exists( $post_cart_item_key, WC()->cart->get_cart() ) ) {

					$restored = WC()->cart->restore_cart_item( $post_cart_item_key );
					WC()->cart->calculate_totals();
					WC()->cart->maybe_set_cart_cookies();
					if ( $restored ) {
						$return_response['success'] = true;
						$return_response['message'] = apply_filters( 'addonify_floating_cart_item_restored_success_message', __( "Restored successfully.", "addonify-floating-cart" ) );
					} else {
						$return_response['success'] = false;
						$return_response['message'] = apply_filters( 'addonify_floating_cart_item_restore_failure_message', __( "Could not be restored.", "addonify-floating-cart" ) );
					}
				} else {
					$return_response['success'] = false;
					$return_response['message'] = apply_filters( 'addonify_floating_cart_item_already_in_cart_message', __( "Already exists in cart", 'addonify-floating-cart' ) );
				}
			} else {
				$return_response['success'] = false;					
				$return_response['message'] = apply_filters( 'addonify_floating_cart_item_restore_key_missing_message', __( "Key Missing", "addonify-floating-cart" ) );
			}

			$fragments = apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() );

			ob_start();
			do_action('addonify_floating_cart_sidebar_cart_body', array());
			$fragments['.adfy__woofc-content'] = ob_get_clean();

			$return_response['fragments'] = $fragments;
			$return_response['cart_items_count'] = WC()->cart->get_cart_contents_count();
			

			wp_send_json( $return_response );
		} else {

			wp_send_json( array(
				'success' => false,
				'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', 'addonify-floating-cart' ) ),
			) );
		}

		wp_die();
	}

	/**
	 * function for ajax call to update item in cart
	 * prints array of cart fragments
	 * @since    1.0.0
	 *
	 */
	public function update_cart_item() {

		$nonce = isset( $_POST['nonce'] ) ? wp_unslash( $_POST['nonce']  ) : '';

		if ( 
			$nonce && 
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' ) 
		) {
			$error_message = '';
            $quantity = false;

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

                $product = wc_get_product( $cart_item['product_id'] );

				$post_product_id = isset( $_POST['product_id'] ) ? (int) wp_unslash( $_POST['product_id'] ) : '';

				$post_cart_item_key = isset( $_POST['cart_item_key'] ) ? wp_unslash( $_POST['cart_item_key'] ) : '';

				$post_quantity = isset( $_POST['quantity'] ) ? (int) wp_unslash( $_POST['quantity'] ) : 0;

				if ( 
					$post_product_id &&
					$cart_item['product_id'] === $post_product_id &&
					$cart_item_key === $post_cart_item_key
				) {	
					$post_type = isset( $_POST['type'] ) ? wp_unslash( $_POST['type'] ) : '';

					$quantity = $cart_item['quantity'];

					switch ( $post_type ) {
						case 'add':
							$post_quantity = $quantity + 1 ;
							break;
						case 'sub':
							$post_quantity = $quantity - 1 ;
							break;
						default:
							break;
					}

					if ( $post_quantity <= 0 ) {

						$error_message = apply_filters( 'addonify_floating_cart_quantity_update_failure_less_than_zero_message', __( "Quantity must be more than zero.", "addonify-floating-cart" ) );
						unset( $post_quantity );
						break;
					}

					if ( $product->get_stock_quantity() ) {

						if ( $product->get_stock_quantity() >= $post_quantity ) {

							WC()->cart->set_quantity( $cart_item_key, $post_quantity );
						} else {

							$error_message = apply_filters( 'addonify_floating_cart_quantity_update_failure_no_stock_message', __( "Not available in the stock.", "addonify-floating-cart" ) );
							unset( $post_quantity );
						}
					} else {
						WC()->cart->set_quantity( $cart_item_key, $post_quantity );
					}
					break;
				}
			}

			$this->check_coupons();

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();
			// Fragments returned
			$data = array(
				'nQuantity' => isset( $post_quantity ) ? $post_quantity : $quantity,
				'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() ),
			);

			if ( ! empty( $error_message ) ) {
				$data['success'] = false;
				$data['message'] = $error_message;
			} else {
				$data['success'] = true;
				$data['message'] = apply_filters( 'addonify_floating_cart_quantity_update_success_message', __( 'Quantity updated successfully.', 'addonify-floating-cart' ) );
			}

			wp_send_json($data);
		} else {
			
			wp_send_json( array(
				'success' => false,
				'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', 'addonify-floating-cart' ) ),
			) );
		}

		wp_die();
	}

	/**
	 * function for ajax call to apply coupon in cart
	 * prints array of coupon div and if the coupon was applied status
	 * @since    1.0.0
	 */
	public function apply_coupon() {

		$coupon_apply = false;

		$nonce = isset( $_POST['nonce'] ) ? wp_unslash( $_POST['nonce']  ) : '';

		$status = '';

		if ( 
			$nonce && 
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' ) 
		) {
			$coupon_code = isset( $_POST['form_data'] ) ? wp_unslash( $_POST['form_data'] ) : '';

			if ( ! empty( $coupon_code ) ) {

				$coupon = new WC_Coupon( $coupon_code );

				$coupon_id = $coupon->get_code();

				if ( in_array( $coupon_id, WC()->cart->get_applied_coupons() ) ) {

					$status = __( "Coupon already applied.", 'addonify-floating-cart' );
				} else {

					$discounts = new WC_Discounts( WC()->cart );

					$coupon_status = $discounts->is_coupon_valid( $coupon );

					if ( is_bool( $coupon_status ) ) {

						$coupon_apply = WC()->cart->apply_coupon( $coupon_id );

						WC()->cart->calculate_totals();

						WC()->cart->maybe_set_cart_cookies();

						$status = $coupon_apply ? apply_filters( 'addonify_floating_cart_coupon_applied_message', __( "Coupon code applied", "addonify-floating-cart" ) ) : apply_filters( 'addonify_floating_cart_invalid_coupon_message', __( "Error applying coupon code.", "addonify-floating-cart" ) );
					} else {

						$status = apply_filters( 'addonify_floating_cart_invalid_coupon_message', __( "Invalid Coupon Code.", "addonify-floating-cart" ) );
					}
				}

			} else {
				$status = apply_filters( 'addonify_floating_cart_input_coupon_to_apply_message', __( 'Please enter a coupon code.', "addonify-floating-cart" ) );
			}
		} else {
			$status = apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid secutrity token.', "addonify-floating-cart" ) );
		}
		$this->check_coupons();

		ob_start();
			do_action('addonify_floating_cart_sidebar_cart_applied_coupons');
		$coupons = ob_get_clean();

		echo json_encode( array(
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
		) );

		wp_die();
	}

	/**
	 * function for ajax call to remove coupon in cart
	 * prints array of coupon div and if the coupon was removed status
	 * @since    1.0.0
	 */
	public function remove_coupon() {

		$coupon_remove = false;

		$nonce = isset( $_POST['nonce'] ) ? wp_unslash( $_POST['nonce']  ) : '';

		if ( 
			$nonce && 
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' ) 
		) {
			$coupon_code = isset( $_POST['form_data'] ) ? wp_unslash( $_POST['form_data'] ) : '';

			if ( ! empty( $coupon_code ) ) {

				$coupon_remove = WC()->cart->remove_coupon( $coupon_code );

				WC()->cart->calculate_totals();

				WC()->cart->maybe_set_cart_cookies();

				$status = $coupon_remove ? apply_filters( 'addonify_floating_cart_coupon_removed_message', __( "Coupon code removed.", "addonify-floating-cart" ) ) : apply_filters( 'addonify_floating_cart_invalid_coupon_message', __( "Error removing coupon code.", "addonify-floating-cart" ) );
			} else {

				$status = apply_filters( 'addonify_floating_cart_input_coupon_to_apply_message', __( 'Please enter a coupon code.', "addonify-floating-cart" ) );
			}
		} else {

            $status = apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', "addonify-floating-cart" ) );
		}

		$this->check_coupons();

		ob_start();
		do_action( 'addonify_floating_cart_sidebar_cart_applied_coupons' );
		$coupons = ob_get_clean();

		echo json_encode( array(
			'couponRemoved' => $coupon_remove,
			'status' => $status,
			'appliedCoupons' => count( WC()->cart->get_applied_coupons() ),
			'html' => array(
				'#adfy__woofc-applied-coupons' => $coupons,
				'.woocommerce-Price-amount.discount-amount' => $this->discount_template(),
				'.woocommerce-Price-amount.subtotal-amount' => $this->subtotal_template(),
				'.woocommerce-Price-amount.total-amount' => $this->total_template(),
				'.adfy__woofc-shipping-text' => $this->shopping_meter_text_template(),
				'.progress-bar.shipping-bar' => $this->shopping_meter_bar_template(),
			)
		) );

		wp_die();
	}

	/**
	 * Function to check if all the applied coupons are valid
	 * Rejects coupons that are no longer valid in cart
	 */
	public function check_coupons() {

		WC()->cart->check_cart_coupons();
	}

	/**
	 * Define template displaying product remove Undo link.
	 *
	 * @since    1.0.0
	 */
	public function cart_undo_template( $product_name, $cart_item_key ) {

		return $product_name . __( ' has been removed.', 'addonify-floating-cart' ) . '<a href="#" class="adfy__woofc-restore-item adfy__woofc-link has-underline adfy__woofc-prevent-default" id="adfy__woofc_restore_item" data-item_key="' . esc_attr( $cart_item_key ) . '" class="restore-item">' . __( 'Undo?', 'addonify-floating-cart' ) . '</a>';
	}

	/**
	 * Render template for displaying discount amount in the cart summary.
	 *
	 * @since    1.0.0
	 */
	public function discount_template() {

		return apply_filters(
			'addonify_floating_cart_discount_template',
			'<span class="woocommerce-Price-amount discount-amount"><bdi>'. get_woocommerce_currency_symbol() . WC()->cart->get_cart_discount_total() . '</bdi>
			</span>'
		);
	}

	/**
	 * Render template for displaying subtotal amount in the cart summary.
	 *
	 * @since    1.0.0
	 */
	public function subtotal_template() {

		return apply_filters(
			'addonify_floating_cart_subtotal_template',
			'<span class="woocommerce-Price-amount subtotal-amount"><bdi>'. WC()->cart->get_cart_subtotal() . '</bdi>
			</span>'
		);
	}

	/**
	 * Render template for displaying total amount in the cart summary.
	 *
	 * @since    1.0.0
	 */
	public function total_template() {

		return apply_filters(
			'addonify_floating_cart_total_template',
			'<span class="woocommerce-Price-amount total-amount"><bdi>'. WC()->cart->get_cart_total() . '</bdi>
			</span>'
		);
	}

	/**
	 * Render template for displaying shopping meter text.
	 *
	 * @since    1.0.0
	 */
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
			'addonify_floating_cart_shopping_meter_text',
			'<span class="adfy__woofc-shipping-text">' . esc_html( $shopping_threshold_text ) . '</span>'
		);
	}

	/**
	 * Render template for displaying shopping meter bar.
	 *
	 * @since    1.0.0
	 */
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
			'addonify_floating_cart_shopping_meter_bar',
			'<div class="progress-bar shipping-bar" data_percentage="' . esc_attr( $per ) . '" style="width:' . esc_attr( $per ) . '%"></div>' 
		);
	}

	/**
	 * Render template for displaying coupon message.
	 *
	 * @since    1.0.0
	 */
	public function woocommerce_coupon_msg( $msg ) {

		if( wp_doing_ajax() ) {

			return null;
		} else {

			return $msg;
		}
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


