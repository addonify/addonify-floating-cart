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
class Addonify_Floating_Cart_Public {

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
	 * Strings from settings.
	 *
	 * @since 1.2.5
	 *
	 * @access public
	 * @var    string $strings_from_setting Strings enabled from setting.
	 */
	public $strings_from_setting;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->strings_from_setting = addonify_floating_cart_get_option( 'enable_cart_labels_from_plugin' );
	}

	/**
	 * Public Init Function
	 */
	public function init() {

		if ( (int) addonify_floating_cart_get_option( 'enable_floating_cart' ) === 0 ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_footer', array( $this, 'footer_content' ) );

		$this->register_ajax_actions();

		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'add_to_cart_ajax' ) );
	}

	/**
	 * Register ajax actions.
	 */
	public function register_ajax_actions() {

		if ( is_cart() || is_checkout() ) {
			return;
		}

		add_action( 'wp_ajax_addonify_floating_cart_add_to_cart', array( $this, 'add_to_cart' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_add_to_cart', array( $this, 'add_to_cart' ) );

		add_action( 'wp_ajax_addonify_floating_cart_remove_from_cart', array( $this, 'remove_from_cart' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_remove_from_cart', array( $this, 'remove_from_cart' ) );

		add_action( 'wp_ajax_addonify_floating_cart_restore_in_cart', array( $this, 'restore_in_cart' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_restore_in_cart', array( $this, 'restore_in_cart' ) );

		add_action( 'wp_ajax_addonify_floating_cart_update_cart_item', array( $this, 'update_cart_item' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_update_cart_item', array( $this, 'update_cart_item' ) );

		add_action( 'wp_ajax_addonify_floating_cart_apply_coupon', array( $this, 'apply_coupon' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_apply_coupon', array( $this, 'apply_coupon' ) );

		add_action( 'wp_ajax_addonify_floating_cart_remove_coupon', array( $this, 'remove_coupon' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_remove_coupon', array( $this, 'remove_coupon' ) );

		add_action( 'wp_ajax_addonify_floating_update_shipping_info', array( $this, 'update_shipping_info' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_update_shipping_info', array( $this, 'update_shipping_info' ) );

		add_action( 'wp_ajax_addonify_floating_update_shipping_method', array( $this, 'update_shipping_method' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_update_shipping_method', array( $this, 'update_shipping_method' ) );

		add_action( 'wp_ajax_addonify_floating_cart_refresh_cart_fragments', array( $this, 'refresh_cart_fragments' ) );
		add_action( 'wp_ajax_nopriv_addonify_floating_cart_refresh_cart_fragments', array( $this, 'refresh_cart_fragments' ) );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if ( is_cart() || is_checkout() ) {
			return;
		}

		wp_enqueue_style(
			'notyf',
			plugin_dir_url( __FILE__ ) . 'assets/libs/notfy/notfy.min.css',
			array(),
			3,
			'all'
		);

		wp_enqueue_style(
			'perfect-scrollbar',
			plugin_dir_url( __FILE__ ) . 'assets/libs/perfect-scrollbar/perfect-scrollbar.min.css',
			array(),
			'1.5.3',
			'all'
		);

		wp_enqueue_style(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'assets/build/public.min.css',
			array(),
			$this->version,
			'all'
		);

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

		if ( is_cart() || is_checkout() ) {
			return;
		}

		if ( did_action( 'woocommerce_init' ) ) {
			$states    = array();
			$countries = WC()->countries->get_allowed_countries();
			foreach ( $countries as $i => $country ) {
				$states[ $i ] = WC()->countries->get_states( $i );
			}
		}

		wp_enqueue_script(
			'notyf',
			plugin_dir_url( __FILE__ ) . 'assets/libs/notfy/notfy.min.js',
			array(),
			'3',
			true
		);

		wp_enqueue_script(
			'perfect-scrollbar',
			plugin_dir_url( __FILE__ ) . 'assets/libs/perfect-scrollbar/perfect-scrollbar.min.js',
			array(),
			'1.5.3',
			true
		);

		wp_enqueue_script(
			$this->plugin_name . '-public',
			plugin_dir_url( __FILE__ ) . 'assets/build/public.min.js',
			array( 'jquery', 'wp-i18n' ),
			$this->version,
			true
		);

		$added_to_cart_notification_text = esc_html__( '{product_name} has been added to cart.', 'addonify-floating-cart' );
		$show_cart_button_label          = esc_html__( 'Show Cart', 'addonify-floating-cart' );

		if ( '1' === $this->strings_from_setting ) {

			$saved_added_to_cart_notification_text = addonify_floating_cart_get_option( 'added_to_cart_notification_text' );
			if ( $saved_added_to_cart_notification_text ) {
				$added_to_cart_notification_text = $saved_added_to_cart_notification_text;
			}

			$saved_show_cart_button_label = addonify_floating_cart_get_option( 'show_cart_button_label' );
			if ( $saved_show_cart_button_label ) {
				$show_cart_button_label = $saved_show_cart_button_label;
			}
		}

		wp_localize_script(
			$this->plugin_name . '-public',
			'addonifyFloatingCartJSObject',
			array(
				'ajax_url'                                 => admin_url( 'admin-ajax.php' ),
				'ajax_add_to_cart_action'                  => 'addonify_floating_cart_add_to_cart',
				'ajax_restore_in_cart_action'              => 'addonify_floating_cart_restore_in_cart',
				'ajax_remove_from_cart_action'             => 'addonify_floating_cart_remove_from_cart',
				'ajax_update_cart_item_action'             => 'addonify_floating_cart_update_cart_item',
				'ajax_apply_coupon'                        => 'addonify_floating_cart_apply_coupon',
				'ajax_remove_coupon'                       => 'addonify_floating_cart_remove_coupon',
				'ajax_refresh_cart_fragments'              => 'addonify_floating_cart_refresh_cart_fragments',
				'updateShippingInfo'                       => 'addonify_floating_update_shipping_info',
				'updateShippingMethod'                     => 'addonify_floating_update_shipping_method',
				'nonce'                                    => wp_create_nonce( 'addonify-floating-cart-ajax-nonce' ),
				'addonifyFloatingCartNotifyShow'           => addonify_floating_cart_get_option( 'display_toast_notification' ),
				'addonifyFloatingCartNotifyDuration'       => (int) addonify_floating_cart_get_option( 'close_notification_after_time' ) * 1000,
				'addonifyFloatingCartNotifyDismissible'    => addonify_floating_cart_get_option( 'display_close_notification_button' ),
				'displayToastNotificationButton'           => addonify_floating_cart_get_option( 'display_show_cart_button' ),
				'addonifyFloatingCartNotifyMessage'        => $added_to_cart_notification_text,
				'toast_notification_display_position'      => addonify_floating_cart_get_option( 'toast_notification_display_position' ),
				'openCartModalOnTriggerButtonHover'        => addonify_floating_cart_get_option( 'open_cart_modal_on_trigger_button_mouse_hover' ),
				'open_cart_modal_after_click_on_view_cart' => addonify_floating_cart_get_option( 'open_cart_modal_after_click_on_view_cart' ),
				'open_cart_modal_immediately_after_add_to_cart' => addonify_floating_cart_get_option( 'open_cart_modal_immediately_after_add_to_cart' ),
				'show_cart_button_label'                   => $show_cart_button_label,
				'toastNotificationButton'                  => $this->toast_notification_button_template(),
				'hideTriggerButtonIfCartIsEmpty'           => addonify_floating_cart_get_option( 'hide_modal_toggle_button_on_empty_cart' ),
				'hideCartOnOverlayClicked'                 => addonify_floating_cart_get_option( 'close_cart_modal_on_overlay_click' ),
				'states'                                   => $states,
			)
		);
	}

	/**
	 * Template for displaying sidebar cart toggle button.
	 *
	 * @since    1.0.0
	 */
	public function toast_notification_button_template() {

		$show_cart_button_label = esc_html__( 'Show Cart', 'addonify-floating-cart' );

		if ( '1' === $this->strings_from_setting ) {
			$saved_show_cart_button_label = addonify_floating_cart_get_option( 'show_cart_button_label' );
			if ( $saved_show_cart_button_label ) {
				$show_cart_button_label = $saved_show_cart_button_label;
			}
		}

		return apply_filters(
			'addonify_floating_cart_toast_notification_button',
			"<button class='adfy__show-woofc adfy__woofc-fake-button adfy__woofc-notfy-button'>" . esc_html( $show_cart_button_label ) . '</button>'
		);
	}

	/**
	 * Insert sidebar cart toggle button and sidebar cart at the footer.
	 *
	 * @since    1.0.0
	 */
	public function footer_content() {

		if ( is_cart() || is_checkout() ) {
			return;
		}

		WC()->cart->calculate_totals();
		WC()->cart->maybe_set_cart_cookies();

		do_action( 'addonify_floating_cart_footer_template', $this->strings_from_setting );
	}

	/**
	 * Function updating cart fragments through ajax call
	 * returns array of cart fragments
	 *
	 * @param array $fragments Fragments.
	 * @return array
	 */
	public function add_to_cart_ajax( $fragments = array() ) {

		WC()->cart->calculate_totals();
		WC()->cart->maybe_set_cart_cookies();

		if ( isset( $_POST['product_id'] ) ) { //phpcs:ignore
			$product              = wc_get_product( absint( $_POST['product_id'] ) ); //phpcs:ignore
			$fragments['product'] = $product->get_title();
		}

		foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
			$product = $cart_item['data'];

			// Check stock based on stock-status.
			if ( ! $product->is_in_stock() ) {

				if ( WC()->cart->remove_cart_item( $key ) ) {

					$fragments['cart_error'] = sprintf(
						/* translators: 1: product name. */
						__( '%1$s is no more available in stock. %1$s has been removed from cart.', 'addonify-floating-cart' ),
						esc_html( $product->get_name() )
					);
				} else {
					$fragments['cart_error'] = sprintf(
						/* translators: 1: product name. */
						__( '%1$s is no more available in stock. Please remove it from cart.', 'addonify-floating-cart' ),
						esc_html( $product->get_name() )
					);
				}
			}
		}

		$prev_notices = WC()->session->get( 'wc_notices', array() );

		WC()->session->set( 'wc_notices', array() );

		$this->check_coupons();

		$notices = WC()->session->get( 'wc_notices' );

		if ( $notices ) {
			if ( ! empty( $notices['success'] ) ) {
				$status = apply_filters( 'addonify_floating_cart_invalid_coupon_message', $notices['success'][0]['notice'] );
			} else {
				$status = apply_filters( 'addonify_floating_cart_invalid_coupon_message', $notices['error'][0]['notice'] );
			}
			if ( ! empty( $status ) ) {
				$fragments['couponStatus'] = $status;
			}
		}

		WC()->session->set( 'wc_notices', $prev_notices );

		if ( addonify_floating_cart_get_option( 'cart_badge_items_total_count' ) === 'total_products' ) {
			$cart_items_count = count( WC()->cart->get_cart_contents() );
		} else {
			$cart_items_count = WC()->cart->get_cart_contents_count();
		}
		ob_start();
		addonify_floating_cart_display_items_count( $cart_items_count, $this->strings_from_setting );
		$fragments['.adfy__woofc-badge'] = ob_get_clean();

		ob_start();
		do_action( 'addonify_floating_cart_sidebar_cart_body', $this->strings_from_setting );
		$fragments['.adfy__woofc-content'] = ob_get_clean();

		ob_start();
		do_action( 'addonify_floating_cart_sidebar_cart_applied_coupons', $this->strings_from_setting );
		$fragments['.adfy__woofc-coupons'] = ob_get_clean();

		$fragments['.adfy_woofc-badge-count'] = '<span class="adfy_woofc-badge-count">' . esc_html( $cart_items_count ) . '</span>';

		ob_start();
		do_action( 'addonify_floating_cart_sidebar_cart_footer', $this->strings_from_setting );
		$fragments['.adfy__woofc-colophon'] = ob_get_clean();

		ob_start();

		$modal_close_label = esc_html__( 'Go Back', 'addonify-floating-cart' );
		if ( '1' === $this->strings_from_setting ) {
			$saved_modal_close_label = addonify_floating_cart_get_option( 'coupon_shipping_form_modal_exit_label' );
			if ( $saved_modal_close_label ) {
				$modal_close_label = $saved_modal_close_label;
			}
		}
		?>
		<div id="adfy__woofc-shipping-container" data_display="hidden">
			<div class="shipping-container-header">
				<button class="adfy__woofc-fake-button" id="adfy__woofc-hide-shipping-container">
					<svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
					</svg>
					<?php echo esc_html( $modal_close_label ); ?>
				</button>
			</div>
			<?php
			do_action( 'addonify_floating_cart_sidebar_cart_shipping', array() );
			?>
		</div>
		<?php
		$fragments['#adfy__woofc-shipping-container'] = ob_get_clean();

		ob_start();
		do_action( 'addonify_floating_cart_sidebar_cart_shipping_bar', array() );
		$fragments['.adfy__woofc-shipping-bar'] = ob_get_clean();

		return $fragments;

	}

	/**
	 * Return ajax cart fragments.
	 */
	public function refresh_cart_fragments() {
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if (
			$nonce &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' )
		) {
			// Fragments returned.
			$return_response['fragments'] = apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() );
			wp_send_json( $return_response );
		}
		wp_die();
	}

	/**
	 * Function for ajax call to remove item from cart.
	 * prints array of cart fragments
	 *
	 * @since    1.0.0
	 */
	public function remove_from_cart() {

		$return_response = array(
			'success' => false,
		);

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if (
			$nonce &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' )
		) {
			$product_name       = '';
			$post_product_id    = isset( $_POST['product_id'] ) ? (int) sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : '';
			$post_cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) ) : '';

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				if (
					$cart_item['product_id'] === $post_product_id &&
					$cart_item_key === $post_cart_item_key
				) {
					$product      = wc_get_product( $cart_item['product_id'] );
					$product_name = $product->get_title();
					if ( WC()->cart->remove_cart_item( $cart_item_key ) === true ) {

						$product_removal_text = esc_html__( '{product_name} has been removed.', 'addonify-floating-cart' );
						if ( '1' === $strings_from_setting ) {
							$saved_product_removal_text = addonify_floating_cart_get_option( 'product_removal_text' );
							if ( $saved_product_removal_text ) {
								$product_removal_text = $saved_product_removal_text;
							}
						}

						$return_response['success']           = true;
						$return_response['cart_hash']         = WC()->cart->get_cart_hash();
						$return_response['message']           = $product_removal_text;
						$return_response['undo_product_link'] = $this->cart_undo_template( $product_name, $cart_item_key );
					} else {
						$return_response['success'] = false;
						$return_response['message'] = __( "Error removing {$product_name} from the cart.", 'addonify-floating-cart' ); //phpcs:ignore
					}
					break;
				} else {
					$return_response['success'] = false;
					$return_response['message'] = __( 'Invalid product id or cart item key.', 'addonify-floating-cart' );
				}
			}

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();

			// Fragments returned.
			$return_response['fragments']        = apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() );
			$return_response['cart_items_count'] = WC()->cart->get_cart_contents_count();

			if ( WC()->cart->get_cart_contents_count() === 0 ) {

				$empty_cart_text = esc_html__( 'Your cart is currently empty.', 'addonify-floating-cart' );

				if ( '1' === $this->strings_from_setting ) {
					$saved_empty_cart_text = addonify_floating_cart_get_option( 'empty_cart_text' );
					if ( $saved_empty_cart_text ) {
						$empty_cart_text = $saved_empty_cart_text;
					}
				}

				$return_response['empty_cart_message'] = $empty_cart_text;
			}

			wp_send_json( $return_response );

		} else {

			wp_send_json(
				array(
					'success' => false,
					'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', 'addonify-floating-cart' ) ),
				)
			);
		}

		wp_die();
	}

	/**
	 * Restore removed cart item through ajax.
	 *
	 * @since    1.0.0
	 */
	public function restore_in_cart() {

		$return_response = array(
			'success' => false,
			'message' => '',
		);

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if (
			$nonce &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' )
		) {

			$post_cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) ) : '';

			if ( ! empty( $post_cart_item_key ) ) {

				if ( ! array_key_exists( $post_cart_item_key, WC()->cart->get_cart() ) ) {

					$restored = WC()->cart->restore_cart_item( $post_cart_item_key );
					WC()->cart->calculate_totals();
					WC()->cart->maybe_set_cart_cookies();
					if ( $restored ) {
						$return_response['success'] = true;
						$return_response['message'] = apply_filters( 'addonify_floating_cart_item_restored_success_message', __( 'Restored successfully.', 'addonify-floating-cart' ) );
					} else {
						$return_response['success'] = false;
						$return_response['message'] = apply_filters( 'addonify_floating_cart_item_restore_failure_message', __( 'Could not be restored.', 'addonify-floating-cart' ) );
					}
				} else {
					$return_response['success'] = false;
					$return_response['message'] = apply_filters( 'addonify_floating_cart_item_already_in_cart_message', __( 'Already exists in cart', 'addonify-floating-cart' ) );
				}
			} else {
				$return_response['success'] = false;
				$return_response['message'] = apply_filters( 'addonify_floating_cart_item_restore_key_missing_message', __( 'Key Missing', 'addonify-floating-cart' ) );
			}

			$fragments = apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() );

			ob_start();
			do_action( 'addonify_floating_cart_sidebar_cart_body', array() );
			$fragments['.adfy__woofc-content'] = ob_get_clean();

			$return_response['fragments']        = $fragments;
			$return_response['cart_items_count'] = WC()->cart->get_cart_contents_count();

			wp_send_json( $return_response );
		} else {

			wp_send_json(
				array(
					'success' => false,
					'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', 'addonify-floating-cart' ) ),
				)
			);
		}

		wp_die();
	}

	/**
	 * Function for ajax call to update item in cart
	 * prints array of cart fragments.
	 *
	 * @since    1.0.0
	 */
	public function update_cart_item() {

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if (
			$nonce &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' )
		) {
			$error_message = '';
			$quantity      = false;

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

				$product = wc_get_product( $cart_item['product_id'] );

				$post_product_id = isset( $_POST['product_id'] ) ? (int) sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : '';

				$post_cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) ) : '';

				$post_quantity = isset( $_POST['quantity'] ) ? (int) sanitize_text_field( wp_unslash( $_POST['quantity'] ) ) : 0;

				if (
					$post_product_id &&
					$cart_item['product_id'] === $post_product_id &&
					$cart_item_key === $post_cart_item_key
				) {
					$post_type = isset( $_POST['type'] ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';

					$quantity = $cart_item['quantity'];

					switch ( $post_type ) {
						case 'add':
							$post_quantity = $quantity + 1;
							break;
						case 'sub':
							$post_quantity = $quantity - 1;
							break;
						default:
							break;
					}

					if ( $post_quantity <= 0 ) {

						$error_message = apply_filters( 'addonify_floating_cart_quantity_update_failure_less_than_zero_message', __( 'Quantity must be more than zero.', 'addonify-floating-cart' ) );
						unset( $post_quantity );
						break;
					}

					if ( $product->get_stock_quantity() ) {

						if ( $product->get_stock_quantity() >= $post_quantity ) {

							WC()->cart->set_quantity( $cart_item_key, $post_quantity );
						} else {

							$error_message = apply_filters( 'addonify_floating_cart_quantity_update_failure_no_stock_message', __( 'Not available in the stock.', 'addonify-floating-cart' ) );
							unset( $post_quantity );
						}
					} else {
						WC()->cart->set_quantity( $cart_item_key, $post_quantity );
					}
					break;
				}
			}

			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();
			// Fragments returned.
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

			wp_send_json( $data );
		} else {
			wp_send_json(
				array(
					'success' => false,
					'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', 'addonify-floating-cart' ) ),
				)
			);
		}

		wp_die();
	}

	/**
	 * Function for ajax call to apply coupon in cart
	 * prints array of coupon div and if the coupon was applied status
	 *
	 * @since    1.0.0
	 */
	public function apply_coupon() {

		$coupon_apply = false;

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		$status = '';

		$prev_notices = WC()->session->get( 'wc_notices', array() );

		WC()->session->set( 'wc_notices', array() );

		if (
			$nonce &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' )
		) {
			$coupon_code = isset( $_POST['form_data'] ) ? sanitize_text_field( wp_unslash( $_POST['form_data'] ) ) : '';
			if ( ! empty( $coupon_code ) ) {
				$coupons_applied_before = WC()->cart->get_applied_coupons();

				$coupon_apply = WC()->cart->apply_coupon( $coupon_code );

				WC()->cart->calculate_totals();

				WC()->cart->maybe_set_cart_cookies();

				$notices = WC()->session->get( 'wc_notices' );

				if ( $coupon_apply ) {
					$status = apply_filters( 'addonify_floating_cart_coupon_message', $notices['success'][0]['notice'] );
				} else {
					$status = apply_filters( 'addonify_floating_cart_invalid_coupon_message', $notices['error'][0]['notice'] );
				}

				if ( $coupon_apply ) {

					$coupons_applied_after = WC()->cart->get_applied_coupons();

					$diff = array_diff( $coupons_applied_before, $coupons_applied_after );

					if ( array_key_exists( $coupon_code, $diff ) ) {
						unset( $diff[ $coupon_code ] );
					}
					if ( ! empty( $diff ) ) {
						$status .= '<br /> <small>Following coupons in your cart were unset for not being valid anymore: <strong>' . implode( ',', $diff ) . '</strong></small>';
					}
				}
			} else {
				$status = apply_filters( 'addonify_floating_cart_input_coupon_to_apply_message', __( 'Please enter a coupon code.', 'addonify-floating-cart' ) );
			}
		} else {
			$status = apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid secutrity token.', 'addonify-floating-cart' ) );
		}
		$this->check_coupons();

		ob_start();
			do_action( 'addonify_floating_cart_sidebar_cart_applied_coupons', $this->strings_from_setting );
		$coupons = ob_get_clean();

		echo wp_json_encode(
			array(
				'couponApplied'  => $coupon_apply,
				'status'         => $status,
				'appliedCoupons' => count( WC()->cart->get_applied_coupons() ),
				'html'           => $this->add_to_cart_ajax(),
			)
		);

		WC()->session->set( 'wc_notices', $prev_notices );

		wp_die();
	}

	/**
	 * Function for ajax call to remove coupon in cart
	 * prints array of coupon div and if the coupon was removed status
	 *
	 * @since    1.0.0
	 */
	public function remove_coupon() {

		$coupon_remove = false;

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if (
			$nonce &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' )
		) {
			$coupon_code = isset( $_POST['form_data'] ) ? sanitize_text_field( wp_unslash( $_POST['form_data'] ) ) : '';

			if ( ! empty( $coupon_code ) ) {

				$coupon_remove = WC()->cart->remove_coupon( $coupon_code );

				WC()->cart->calculate_totals();

				WC()->cart->maybe_set_cart_cookies();

				$status = $coupon_remove ? apply_filters( 'addonify_floating_cart_coupon_removed_message', __( 'Coupon code removed.', 'addonify-floating-cart' ) ) : apply_filters( 'addonify_floating_cart_invalid_coupon_message', __( 'Error removing coupon code.', 'addonify-floating-cart' ) );
			} else {

				$status = apply_filters( 'addonify_floating_cart_input_coupon_to_apply_message', __( 'Please enter a coupon code.', 'addonify-floating-cart' ) );
			}
		} else {
			$status = apply_filters( 'addonify_floating_cart_invalid_nonce_message', __( 'Invalid security token.', 'addonify-floating-cart' ) );
		}

		$this->check_coupons();

		ob_start();
		do_action( 'addonify_floating_cart_sidebar_cart_applied_coupons', $this->strings_from_setting );
		$coupons = ob_get_clean();

		echo wp_json_encode(
			array(
				'couponRemoved'  => $coupon_remove,
				'status'         => $status,
				'appliedCoupons' => count( WC()->cart->get_applied_coupons() ),
				'html'           => $this->add_to_cart_ajax(),
			)
		);

		WC()->session->set( 'wc_notices', array() );

		wp_die();
	}


	/**
	 * Update billing info (ajax).
	 *
	 * @throws Exception $e Shipping exception.
	 */
	public function update_shipping_info() {
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
		if (
			! empty( $nonce ) &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-shipping' )
		) {
			$address = array(
				'country'  => '',
				'state'    => '',
				'city'     => '',
				'postcode' => '',
			);
			if ( ! empty( $_POST['calc_shipping_country'] ) ) {
				$address['country'] = sanitize_text_field( wp_unslash( $_POST['calc_shipping_country'] ) );
			}
			if ( ! empty( $_POST['calc_shipping_state'] ) ) {
				$address['state'] = sanitize_text_field( wp_unslash( $_POST['calc_shipping_state'] ) );
			}
			if ( ! empty( $_POST['calc_shipping_city'] ) ) {
				$address['city'] = sanitize_text_field( wp_unslash( $_POST['calc_shipping_city'] ) );
			}
			if ( ! empty( $_POST['calc_shipping_postcode'] ) ) {
				$address['postcode'] = sanitize_text_field( wp_unslash( $_POST['calc_shipping_postcode'] ) );
			}
			try {

				WC()->shipping()->reset_shipping();

				$address = apply_filters( 'woocommerce_cart_calculate_shipping_address', $address );

				if ( $address['postcode'] && ! WC_Validation::is_postcode( $address['postcode'], $address['country'] ) ) {
					throw new Exception( __( 'Please enter a valid postcode / ZIP.', 'addonify-floating-cart' ) );
				} elseif ( $address['postcode'] ) {
					$address['postcode'] = wc_format_postcode( $address['postcode'], $address['country'] );
				}

				if ( $address['country'] ) {
					if ( ! WC()->customer->get_billing_first_name() ) {
						WC()->customer->set_billing_location( $address['country'], $address['state'], $address['postcode'], $address['city'] );
					}
					WC()->customer->set_shipping_location( $address['country'], $address['state'], $address['postcode'], $address['city'] );
				} else {
					WC()->customer->set_billing_address_to_base();
					WC()->customer->set_shipping_address_to_base();
				}

				WC()->customer->set_calculated_shipping( true );
				WC()->customer->save();

				do_action( 'woocommerce_calculated_shipping' );

				WC()->cart->calculate_totals();

				$fragments = apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() );

				ob_start();
				do_action( 'addonify_floating_cart_sidebar_cart_shipping' );
				$fragments['#adfy__woofc-shipping-container-inner'] = ob_get_clean();

				$return_response['fragments']        = $fragments;
				$return_response['cart_items_count'] = WC()->cart->get_cart_contents_count();
			} catch ( Exception $e ) {
				$return_response = array(
					'success' => false,
					'message' => $e->getMessage(),
				);
			}
			wp_send_json( $return_response );
		} else {
			wp_send_json(
				array(
					'success' => false,
					'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', esc_html__( 'Invalid security token.', 'addonify-floating-cart' ) ),
				)
			);
		}
		wp_die();
	}

	/**
	 * Update shipping method
	 */
	public function update_shipping_method() {

		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

		if (
			$nonce &&
			wp_verify_nonce( $nonce, 'addonify-floating-cart-ajax-nonce' )
		) {

			$chosen_shipping_methods = WC()->session->get( 'chosen_shipping_methods' );
			$posted_shipping_methods = isset( $_POST['shipping_method'] ) ? wc_clean( wp_unslash( $_POST['shipping_method'] ) ) : array(); //phpcs:ignore

			if ( is_array( $posted_shipping_methods ) ) {
				foreach ( $posted_shipping_methods as $i => $value ) {
					$chosen_shipping_methods[ $i ] = $value;
				}
			}

			WC()->session->set( 'chosen_shipping_methods', $chosen_shipping_methods );
			WC()->cart->calculate_totals();
			// Fragments returned.
			$return_response['fragments']        = apply_filters( 'woocommerce_add_to_cart_fragments', $this->add_to_cart_ajax() );
			$return_response['cart_items_count'] = WC()->cart->get_cart_contents_count();
			$return_response['success']          = true;

			if ( WC()->cart->get_cart_contents_count() === 0 ) {
				$return_response['empty_cart_message'] = apply_filters( 'addonify_floating_cart_empty_cart_message', esc_html__( 'Your cart is currently empty.', 'addonify-floating-cart' ) );
			}

			wp_send_json( $return_response );
		} else {
			wp_send_json(
				array(
					'success' => false,
					'message' => apply_filters( 'addonify_floating_cart_invalid_nonce_message', esc_html__( 'Invalid security token.', 'addonify-floating-cart' ) ),
				)
			);
		}
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
	 * @param string $product_name Name of the product.
	 * @param string $cart_item_key Key of the cart item.
	 */
	public function cart_undo_template( $product_name, $cart_item_key ) {

		$product_removal_text = esc_html__( '{product_name} has been removed.', 'addonify-floating-cart' );
		$undo_text            = esc_html__( 'Undo?', 'addonify-floating-cart' );

		if ( '1' === $strings_from_setting ) {
			$saved_product_removal_text = addonify_floating_cart_get_option( 'product_removal_text' );
			if ( $saved_product_removal_text ) {
				$product_removal_text = $saved_product_removal_text;
			}

			$saved_undo_text = addonify_floating_cart_get_option( 'product_removal_undo_text' );
			if ( $saved_undo_text ) {
				$undo_text = $saved_undo_text;
			}
		}

		$product_removal_text = str_replace( '{product_name}', $product_name, $product_removal_text );

		return esc_html( $product_removal_text ) . ' <a href="#" class="adfy__woofc-restore-item adfy__woofc-link has-underline adfy__woofc-prevent-default" id="adfy__woofc_restore_item" data-item_key="' . esc_attr( $cart_item_key ) . '" class="restore-item">' . esc_html( $undo_text ) . '</a>';
	}

	/**
	 * Render template for displaying discount amount in the cart summary.
	 *
	 * @since    1.0.0
	 */
	public function discount_template() {

		return apply_filters(
			'addonify_floating_cart_discount_template',
			'<span class="woocommerce-Price-amount discount-amount"><bdi>' . get_woocommerce_currency_symbol() . WC()->cart->get_cart_discount_total() . '</bdi>
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
			'<span class="addonify-floating-cart-Price-amount subtotal-amount"><bdi>' . WC()->cart->get_cart_subtotal() . '</span>'
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
			'<span class="addonify-floating-cart-Price-amount total-amount">' . WC()->cart->get_cart_total() . '</span>'
		);
	}

	/**
	 * Render template for displaying shopping meter bar.
	 *
	 * @since    1.0.0
	 */
	public function shopping_meter_bar_template() {

		$shopping_threshold_amount = (int) addonify_floating_cart_get_option( 'customer_shopping_meter_threshold' );

		$cart_total = WC()->cart->get_cart_contents_total();

		$per = 0;

		if ( $cart_total >= $shopping_threshold_amount ) {
			$per = 100;
		} else {
			$per = 100 - ( ( $shopping_threshold_amount - $cart_total ) / $shopping_threshold_amount * 100 );
		}

		return apply_filters(
			'addonify_floating_cart_shopping_meter_bar',
			'<div 
				class="live-progress-bar shipping-bar" 
				data_percentage="' . esc_attr( number_format( floatval( $per ), 2 ) ) . '" 
				style="width:' . esc_attr( number_format( floatval( $per ), 2 ) ) . '%"
			></div>'
		);
	}

	/**
	 * Print dynamic CSS generated from settings page.
	 */
	public function dynamic_css() {

		$css_values = array(
			'--adfy_woofc_cart_width'                      => addonify_floating_cart_get_option( 'cart_modal_width' ) . 'px', // New.
			'--adfy_woofc_base_text_color'                 => addonify_floating_cart_get_option( 'cart_modal_base_text_color' ),
			'--adfy_woofc_base_link_color'                 => addonify_floating_cart_get_option( 'cart_modal_content_link_color' ),
			'--adfy_woofc_base_link_color_hover'           => addonify_floating_cart_get_option( 'cart_modal_content_link_on_hover_color' ),
			'--adfy_woofc_base_text_font_size'             => addonify_floating_cart_get_option( 'cart_modal_base_font_size' ) . 'px',
			'--adfy_woofc_border_color'                    => addonify_floating_cart_get_option( 'cart_modal_border_color' ),
			'--adfy_woofc_cart_background_color'           => addonify_floating_cart_get_option( 'cart_modal_background_color' ),
			'--adfy_woofc_cart_overlay_background_color'   => addonify_floating_cart_get_option( 'cart_modal_overlay_color' ),

			'--adfy_woofc_toggle_button_text_color'        => addonify_floating_cart_get_option( 'toggle_button_label_color' ),
			'--adfy_woofc_toggle_button_text_color_hover'  => addonify_floating_cart_get_option( 'toggle_button_on_hover_label_color' ),
			'--adfy_woofc_toggle_button_background_color'  => addonify_floating_cart_get_option( 'toggle_button_background_color' ),
			'--adfy_woofc_toggle_button_background_color_hover' => addonify_floating_cart_get_option( 'toggle_button_on_hover_background_color' ),
			'--adfy_woofc_toggle_button_border_color'      => addonify_floating_cart_get_option( 'toggle_button_border_color' ),
			'--adfy_woofc_toggle_button_border_color_hover' => addonify_floating_cart_get_option( 'toggle_button_on_hover_border_color' ),
			'--adfy_woofc_toggle_button_badge_text_color'  => addonify_floating_cart_get_option( 'toggle_button_badge_label_color' ),
			'--adfy_woofc_toggle_button_badge_text_color_hover' => addonify_floating_cart_get_option( 'toggle_button_label_on_hover_color' ),
			'--adfy_woofc_toggle_button_badge_background_color' => addonify_floating_cart_get_option( 'toggle_button_badge_background_color' ),
			'--adfy_woofc_toggle_button_badge_background_color_hover' => addonify_floating_cart_get_option( 'toggle_button_badge_on_hover_background_color' ),
			'--adfy_woofc_toggle_button_badge_width'       => addonify_floating_cart_get_option( 'toggle_button_badge_width' ), // New.
			'--adfy_woofc_toggle_button_badge_font_size'   => addonify_floating_cart_get_option( 'toggle_button_badge_font_size' ) . 'px', // New.
			'--adfy_woofc_toggle_button_size'              => addonify_floating_cart_get_option( 'cart_modal_toggle_button_width' ) . 'px',
			'--adfy_woofc_toggle_button_border_radius'     => addonify_floating_cart_get_option( 'cart_modal_toggle_button_border_radius' ) . 'px', // New.
			'--adfy_woofc_toggle_button_cart_icon_font_size' => addonify_floating_cart_get_option( 'cart_modal_toggle_button_icon_font_size' ) . 'px',
			'--adfy_woofc_toggle_button_horizental_offset' => addonify_floating_cart_get_option( 'cart_modal_toggle_button_horizontal_offset' ) . 'px',
			'--adfy_woofc_toggle_button_vertical_offset'   => addonify_floating_cart_get_option( 'cart_modal_toggle_button_vertical_offset' ) . 'px',

			// General Buttons styles.
			'--adfy_woofc_base_button_font_size'           => addonify_floating_cart_get_option( 'cart_modal_buttons_font_size' ) . 'px',
			'--adfy_woofc_base_button_font_weight'         => addonify_floating_cart_get_option( 'cart_modal_buttons_font_weight' ),
			'--adfy_woofc_base_button_letter_spacing'      => addonify_floating_cart_get_option( 'cart_modal_buttons_letter_spacing' ),
			'--adfy_woofc_base_button_border_radius'       => addonify_floating_cart_get_option( 'cart_modal_buttons_border_radius' ) . 'px',
			'--adfy_woofc_base_button_text_transform'      => addonify_floating_cart_get_option( 'cart_modal_buttons_text_transform' ),
			'--adfy_woofc_primary_button_label_color'      => addonify_floating_cart_get_option( 'cart_modal_primary_button_label_color' ),
			'--adfy_woofc_primary_button_label_color_hover' => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_label_color' ),
			'--adfy_woofc_primary_button_background_color' => addonify_floating_cart_get_option( 'cart_modal_primary_button_background_color' ),
			'--adfy_woofc_primary_button_background_color_hover' => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_background_color' ),
			'--adfy_woofc_primary_button_border_color'     => addonify_floating_cart_get_option( 'cart_modal_primary_button_border_color' ),
			'--adfy_woofc_primary_button_border_color_hover' => addonify_floating_cart_get_option( 'cart_modal_primary_button_on_hover_border_color' ),

			'--adfy_woofc_secondary_button_label_color'    => addonify_floating_cart_get_option( 'cart_modal_secondary_button_label_color' ),
			'--adfy_woofc_secondary_button_label_color_hover' => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_label_color' ),
			'--adfy_woofc_secondary_button_background_color' => addonify_floating_cart_get_option( 'cart_modal_secondary_button_background_color' ),
			'--adfy_woofc_secondary_button_background_color_hover' => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_background_color' ),
			'--adfy_woofc_secondary_button_border_color'   => addonify_floating_cart_get_option( 'cart_modal_secondary_button_border_color' ),
			'--adfy_woofc_secondary_button_border_color_hover' => addonify_floating_cart_get_option( 'cart_modal_secondary_button_on_hover_border_color' ),

			// Miscellaneous.
			'--adfy_woofc_cart_input_placeholder_color'    => addonify_floating_cart_get_option( 'cart_modal_input_field_placeholder_color' ),
			'adfy_woofc_cart_input_border_color'           => addonify_floating_cart_get_option( 'cart_modal_input_field_text_color' ),
			'--adfy_woofc_cart_input_border_color'         => addonify_floating_cart_get_option( 'cart_modal_input_field_border_color' ),
			'--adfy_woofc_cart_input_background_color'     => addonify_floating_cart_get_option( 'cart_modal_input_field_background_color' ),
			// Shopping meter.
			'--adfy_woofc_shopping_meter_initial_background_color' => addonify_floating_cart_get_option( 'cart_shopping_meter_initial_background_color' ),
			'--adfy_woofc_shopping_meter_progress_background_color' => addonify_floating_cart_get_option( 'cart_shopping_meter_progress_background_color' ),
			'--adfy_woofc_shopping_meter_threashold_reached_background_color' => addonify_floating_cart_get_option( 'cart_shopping_meter_threashold_reached_background_color' ),

			// Toast notification.
			'--adfy_woofc_toast_text_color'                => addonify_floating_cart_get_option( 'toast_notification_text_color' ),
			'--adfy_woofc_toast_icon_color'                => addonify_floating_cart_get_option( 'toast_notification_icon_color' ),
			'--adfy_woofc_toast_icon_background_color'     => addonify_floating_cart_get_option( 'toast_notification_icon_bg_color' ),
			'--adfy_woofc_toast_background_color'          => addonify_floating_cart_get_option( 'toast_notification_background_color' ),
			'--adfy_woofc_toast_button_text_color'         => addonify_floating_cart_get_option( 'toast_notification_button_label_color' ),
			'--adfy_woofc_toast_button_text_color_hover'   => addonify_floating_cart_get_option( 'toast_notification_button_on_hover_label_color' ),
			'--adfy_woofc_toast_button_background_color'   => addonify_floating_cart_get_option( 'toast_notification_button_background_color' ),
			'--adfy_woofc_toast_button_background_color_hover' => addonify_floating_cart_get_option( 'toast_notification_button_on_hover_background_color' ),

			// Cart & cart title.
			'--adfy_woofc_cart_title_text_color'           => addonify_floating_cart_get_option( 'cart_modal_title_color' ),
			'--adfy_woofc_cart_title_font_size'            => addonify_floating_cart_get_option( 'cart_title_font_size' ) . 'px', // New.
			'--adfy_woofc_cart_title_font_weight'          => addonify_floating_cart_get_option( 'cart_title_font_weight' ), // New.
			'--adfy_woofc_cart_title_letter_spacing'       => addonify_floating_cart_get_option( 'cart_title_letter_spacing' ), // New.
			'--adfy_woofc_cart_title_text_transform'       => addonify_floating_cart_get_option( 'cart_title_text_transform' ), // New.
			'--adfy_woofc_cart_title_count_badge_text_color' => addonify_floating_cart_get_option( 'cart_modal_badge_text_color' ),
			'--adfy_woofc_cart_title_count_badge_background_color' => addonify_floating_cart_get_option( 'cart_modal_badge_background_color' ),

			'--adfy_woofc_cart_close_button_text_color'    => addonify_floating_cart_get_option( 'cart_modal_close_icon_color' ),
			'--adfy_woofc_cart_close_button_text_color_hover' => addonify_floating_cart_get_option( 'cart_modal_close_icon_on_hover_color' ),

			'--adfy_woofc_cart_field_placeholder_color'    => addonify_floating_cart_get_option( 'cart_modal_input_field_placeholder_color' ), // TO DO.
			'--adfy_woofc_cart_field_background_color'     => addonify_floating_cart_get_option( 'cart_modal_input_field_background_color' ),
			'--adfy_woofc_cart_field_text_color'           => addonify_floating_cart_get_option( 'cart_modal_input_field_text_color' ),
			'--adfy_woofc_cart_field_border_color'         => addonify_floating_cart_get_option( 'cart_modal_input_field_border_color' ),

			// Product titles.
			'--adfy_woofc_cart_product_title_text_color'   => addonify_floating_cart_get_option( 'cart_modal_product_title_color' ),
			'--adfy_woofc_cart_product_title_text_color_hover' => addonify_floating_cart_get_option( 'cart_modal_product_title_on_hover_color' ),
			'--adfy_woofc_cart_product_price_quantity_text_color' => addonify_floating_cart_get_option( 'cart_modal_product_quantity_price_color' ),
			'--adfy_woofc_cart_product_quantity_text_color' => addonify_floating_cart_get_option( 'cart_modal_base_text_color' ),
			'--adfy_woofc_cart_product_quantity_input_button_text_color' => addonify_floating_cart_get_option( 'cart_modal_base_text_color' ),
			'--adfy_woofc_cart_product_remove_button_text_color' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_icon_color' ),
			'--adfy_woofc_cart_product_remove_button_text_color_hover' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_icon_color' ),
			'--adfy_woofc_cart_product_remove_button_background_color' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_background_color' ),
			'--adfy_woofc_cart_product_remove_button_background_color_hover' => addonify_floating_cart_get_option( 'cart_modal_product_remove_button_on_hover_background_color' ),
			'--adfy_woofc_cart_product_title_font_size'    => addonify_floating_cart_get_option( 'cart_modal_product_title_font_size' ) . 'px',
			'--adfy_woofc_cart_product_title_font_weight'  => addonify_floating_cart_get_option( 'cart_modal_product_title_font_weight' ),
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


