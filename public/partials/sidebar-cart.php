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
	<div id="adfy__woofc-spinner-container" class="hidden">
		<div class="adfy__woofc-spinner-inner">
			<div class="adfy__woofc-spinner">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
			</div>
		</div>
	</div>
	<div class="adfy_woofc-inner">
		<?php do_action( 'addonify_floating_cart_sidebar_cart', $strings_from_setting ); ?>
	</div>
	<?php
	if ( wc_coupons_enabled() ) {
		do_action( 'addonify_floating_cart_sidebar_cart_coupon', $strings_from_setting );
	}

	$modal_close_label = esc_html__( 'Go Back', 'addonify-floating-cart' );
	if ( '1' === $strings_from_setting ) {
		$saved_modal_close_label = addonify_floating_cart_get_option( 'coupon_shipping_form_modal_exit_label' );
		if ( $saved_modal_close_label ) {
			$modal_close_label = $saved_modal_close_label;
		}
	}
	?>
	<div id="adfy__woofc-shipping-container" class="adfy__woofc-container-canvas" data_display="hidden">
		<div class="shipping-container-header">
			<button class="adfy__woofc-fake-button" id="adfy__woofc-hide-shipping-container">
				<svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
				</svg>
				<?php esc_html( $modal_close_label ); ?>
			</button>
		</div>
		<?php do_action( 'addonify_floating_cart_sidebar_cart_shipping', $strings_from_setting ); ?>
	</div>
</aside>
<aside id="adfy__woofc-overlay" class="<?php echo esc_attr( $overlay_class ); ?>"></aside>
<?php
