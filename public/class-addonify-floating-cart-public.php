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

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'notyf', plugin_dir_url( __FILE__ ) . 'assets/build/css/conditional/notfy.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/css/public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'notyf', plugin_dir_url( __FILE__ ) . 'assets/build/js/conditional/notfy.min.js', array(), $this->version, true );

		wp_enqueue_script( $this->plugin_name .'-public', plugin_dir_url( __FILE__ ) . 'assets/build/js/public.min.js', array( 'jquery' ), $this->version, true );

	}

	public function footer_content(){
		?>
			<button id="adfy__woofc-trigger" class="adfy__show-woofc" data_display="visible" data_animation="shake" data_style="rounded" data_label="false" data_icon="true">
				<span class="icon">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 17">
						<g></g>
						<path d="M2.75 12.5c-0.965 0-1.75 0.785-1.75 1.75s0.785 1.75 1.75 1.75 1.75-0.785 1.75-1.75-0.785-1.75-1.75-1.75zM2.75 15c-0.413 0-0.75-0.337-0.75-0.75s0.337-0.75 0.75-0.75 0.75 0.337 0.75 0.75-0.337 0.75-0.75 0.75zM11.25 12.5c-0.965 0-1.75 0.785-1.75 1.75s0.785 1.75 1.75 1.75 1.75-0.785 1.75-1.75-0.785-1.75-1.75-1.75zM11.25 15c-0.413 0-0.75-0.337-0.75-0.75s0.337-0.75 0.75-0.75 0.75 0.337 0.75 0.75-0.337 0.75-0.75 0.75zM13.37 2l-0.301 2h-13.143l1.117 8.036h11.914l1.043-7.5 0.231-1.536h2.769v-1h-3.63zM12.086 11.036h-10.172l-0.84-6.036h11.852l-0.84 6.036zM11 10h-8v-3.969h1v2.969h6v-2.97h1v3.97zM4 2.969h-1v-1.969h8v1.906h-1v-0.906h-6v0.969z" />
					</svg>
				</span>
				<span class="label"></span>
				<span class="badge">3</span>
			</button>
			<aside id="adfy__floating-cart" data_type="drawer" data_position="right">
				<div class="adfy_woofc-inner">
					<header class="adfy__woofc-header">
						<h3 class="adfy__woofc-title">
							Cart
							<span class="adfy__woofc-badge">3 Items</span>
						</h3>
						<div class="adfy__close-button">
							<button class="adfy__hide-woofc">
								<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
							</button>
						</div>
					</header>
					<div class="adfy__woofc-shipping-bar">
						<span class="adfy__woofc-shipping-text">
							🔥 Spend <span class="amount">£100</span> more to qualify for a free shipping.
						</span>
						<div class="progress-bars">
							<div class="total-bar shipping-bar"></div>
							<div class="progress-bar shipping-bar" data_percentage="70" style="width: 70%"></div>
						</div>
					</div>
					<main class="adfy__woofc-content">
						<div class="adfy__woofc-content-entry" id="adfy__woofc-scrollbar">
							<div class="adfy__woofc-item">
								<figure class="thumb" data_style="round">
									<a href="#" class="adfy__woofc-link">
										<img src="<?php echo plugin_dir_url( __FILE__ ). 'images/1.jpg'; ?>" alt="....">
									</a>
									<button class="adfy__woofc-remove-cart-item">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
									</button>
								</figure>
								<div class="adfy__woofc-item-content">
									<div class="adfy__woofc-item-title">
										<h3 class="woocommerce-loop-product__title">
											<a href="#" class="adfy__woofc-link">
												Apple Smart Watch 6th Gen OLED Display
											</a>
										</h3>
									</div>
									<div class="adfy__woofc-item-price"> 
										<span class="quantity">
											1 × 
											<span class="woocommerce-Price-amount amount">
											<bdi>
												<span class="woocommerce-Price-currencySymbol">£</span>1,569.00
											</bdi>
											</span>
										</span>
									</div>
									<div class="adfy__woofc-quantity">
										<form class="adfy__woofc-quantity-form" methord="post">
											<button class="adfy__woofc-quantity-input-button adfy__woofc-inc-quantity">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
											</button>
											<input type="number" value="1" step="1" class="adfy__woofc-quantity-input-field">
											<button class="adfy__woofc-quantity-input-button adfy__woofc-dec-quantity">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>
											</button>
										</form>
									</div>
								</div>
							</div><!-- // adfy__woofc-item -->
							<div class="adfy__woofc-item">
								<figure class="thumb" data_style="round">
									<a href="#" class="adfy__woofc-link">
										<img src="<?php echo plugin_dir_url( __FILE__ ). 'images/2.jpg'; ?>" alt="....">
									</a>
									<button class="adfy__woofc-remove-cart-item">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
									</button>
								</figure>
								<div class="adfy__woofc-item-content">
									<div class="adfy__woofc-item-title">
										<h3 class="woocommerce-loop-product__title">
											<a href="#" class="adfy__woofc-link">
												Cozy Cester Soft Chair, Green Color
											</a>
										</h3>
									</div>
									<div class="adfy__woofc-item-price"> 
										<span class="quantity">
											1 × 
											<span class="woocommerce-Price-amount amount">
											<bdi>
												<span class="woocommerce-Price-currencySymbol">£</span>599.00
											</bdi>
											</span>
										</span>
									</div>
									<div class="adfy__woofc-quantity">
										<form class="adfy__woofc-quantity-form" methord="post">
											<button class="adfy__woofc-quantity-input-button adfy__woofc-inc-quantity">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
											</button>
											<input type="number" value="1" step="1" class="adfy__woofc-quantity-input-field">
											<button class="adfy__woofc-quantity-input-button adfy__woofc-dec-quantity">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>
											</button>
										</form>
									</div>
								</div>
							</div><!-- // adfy__woofc-item -->
							<div class="adfy__woofc-item">
								<figure class="thumb" data_style="round">
									<a href="#" class="adfy__woofc-link">
										<img src="<?php echo plugin_dir_url( __FILE__ ). 'images/3.jpg'; ?>" alt="....">
									</a>
									<button class="adfy__woofc-remove-cart-item">
										<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
									</button>
								</figure>
								<div class="adfy__woofc-item-content">
									<div class="adfy__woofc-item-title">
										<h3 class="woocommerce-loop-product__title">
											<a href="#" class="adfy__woofc-link">
												Beats by Dr. Dre | 12 Months Warrenty | Red Color
											</a>
										</h3>
									</div>
									<div class="adfy__woofc-item-price"> 
										<span class="quantity">
											1 × 
											<span class="woocommerce-Price-amount amount">
											<bdi>
												<span class="woocommerce-Price-currencySymbol">£</span>988.00
											</bdi>
											</span>
										</span>
									</div>
									<div class="adfy__woofc-quantity">
										<form class="adfy__woofc-quantity-form" methord="post">
											<button class="adfy__woofc-quantity-input-button adfy__woofc-inc-quantity">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
											</button>
											<input type="number" value="1" step="1" class="adfy__woofc-quantity-input-field">
											<button class="adfy__woofc-quantity-input-button adfy__woofc-dec-quantity">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg>
											</button>
										</form>
									</div>
								</div>
							</div><!-- // adfy__woofc-item -->
						</div><!-- // adfy__woofc-content-entry -->
					</main>
					<footer class="adfy__woofc-colophon">
						<div class="adfy_woofc-cart-summary">
							<ul>
								<li class="sub-total">
									<span class="label">Sub total:</span>
									<span class="value">
										<span class="woocommerce-Price-amount amount">
											<bdi>
												<span class="woocommerce-Price-currencySymbol">£</span>1,000.00
											</bdi>
										</span>
									</span>
								</li>
								<li class="discount">
									<span class="label">Discount:</span>
									<span class="value">
										<span class="woocommerce-Price-amount amount">
											<bdi>
												<span class="woocommerce-Price-currencySymbol">£</span>50.00
											</bdi>
										</span>
									</span>
								</li>
								<li class="total">
									<span class="label">Total:</span>
									<span class="value">
										<span class="woocommerce-Price-amount amount">
											<bdi>
												<span class="woocommerce-Price-currencySymbol">£</span>950.00
											</bdi>
										</span>
									</span>
								</li>
							</ul>
						</div>
						<div class="adfy__woofc-actions">
							<button class="adfy__woofc-button adfy__hide-woofc continue-shopping">
								Continue shopping
							</button>
							<a href="#" class="adfy__woofc-button proceed-to-checkout">
								Checkout
							</a>
						</div>
					</footer>
				</div>
			</aside>
			<aside id="adfy__woofc-overlay" class="adfy__hide-woofc"></aside>
		<?php
	}
}
