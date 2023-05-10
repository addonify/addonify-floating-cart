<?php
/**
 * The Template for displaying cart toggle floating button.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/floating-button.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<button id="adfy__woofc-trigger" class="adfy__show-woofc <?php echo esc_attr( $position ); ?>" data_display="visible">
	<?php
	if ( $button_icon ) {
		echo '<span class="icon">' . $button_icon . '</span>'; // phpcs:ignore
	}
	?>
	</span>
	<?php if ( 1 === $display_badge ) { ?>
		<?php
		if ( addonify_floating_cart_get_option( 'cart_badge_items_total_count' ) === 'total_products' ) {
			$cart_items_count = count( WC()->cart->get_cart_contents() );
		} else {
			$cart_items_count = WC()->cart->get_cart_contents_count();
		}
		?>
		<span class="badge <?php echo esc_attr( $badge_position ); ?>"><span class="adfy_woofc-badge-count"><?php echo esc_html( $cart_items_count ); ?></span></span>
	<?php } ?>
</button>
<?php
