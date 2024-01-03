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
	?>
	<div id="adfy__woofc-shipping-container" data_display="hidden">
		<div class="shipping-container-header">
			<?php do_action( 'addonify_floating_cart_coupon_shipping_modal_close_button', $strings_from_setting ); ?>
		</div>
		<?php do_action( 'addonify_floating_cart_sidebar_cart_shipping', $strings_from_setting ); ?>
	</div>
</aside>
<aside id="adfy__woofc-overlay" class="<?php echo esc_attr( $overlay_class ); ?>"></aside>
<?php
