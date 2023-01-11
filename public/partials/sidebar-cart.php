<?php
/**
 * The Template for displaying cart.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/sidebar-cart.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<aside id="adfy__floating-cart" data_type="drawer" data_position="<?php echo esc_attr( $position ); ?>">	
	<div class="adfy_woofc-inner">
		<?php do_action( 'addonify_floating_cart_sidebar_cart' ); ?>
	</div>
	<?php
	if ( wc_coupons_enabled() ) {

		do_action( 'addonify_floating_cart_sidebar_cart_coupon' );
	}
	$shipping_modal_close_label = esc_html__( 'Go Back', 'go-cart' );
	?>
	<div id="addonify_floating_cart-shipping-container" data_display="hidden">
		<div class="shipping-container-header">
			<button class="addonify_floating_cart-fake-button" id="addonify_floating_cart-hide-shipping-container">
				<svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
				</svg>
				<?php esc_html_e( $shipping_modal_close_label, 'go-cart' ); //phpcs:ignore ?>
			</button>
		</div>
		<?php
		do_action( 'addonify_floating_cart_sidebar_cart_shipping', array() );
		?>
	</div>
</aside>
<aside id="adfy__woofc-overlay" class="<?php echo esc_attr( $overlay_class ); ?>"></aside>
<?php
