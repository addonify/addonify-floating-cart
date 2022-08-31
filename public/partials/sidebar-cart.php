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
<aside id="adfy__floating-cart" data_type="drawer" data_position="left">	
	<div class="adfy_woofc-inner">
		<?php do_action( 'addonify_floating_cart_sidebar_cart' ); ?>
	</div>
	<?php
	if ( wc_coupons_enabled() ) {

		do_action( 'addonify_floating_cart_sidebar_cart_coupon' );
	}
	?>
</aside>
<?php
if ( addonify_floating_cart_get_option( 'close_cart_modal_on_overlay_click' ) ) {
	$hide_sidebar_class = 'adfy__hide-woofc';
} else {
	$hide_sidebar_class = '';
}
?>
<aside id="adfy__woofc-overlay" class="<?php echo esc_attr( $hide_sidebar_class ); ?>"></aside>
<?php
