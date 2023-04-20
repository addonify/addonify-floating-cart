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
	<span class="icon">
		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 17">
			<g></g>
			<path d="M2.75 12.5c-0.965 0-1.75 0.785-1.75 1.75s0.785 1.75 1.75 1.75 1.75-0.785 1.75-1.75-0.785-1.75-1.75-1.75zM2.75 15c-0.413 0-0.75-0.337-0.75-0.75s0.337-0.75 0.75-0.75 0.75 0.337 0.75 0.75-0.337 0.75-0.75 0.75zM11.25 12.5c-0.965 0-1.75 0.785-1.75 1.75s0.785 1.75 1.75 1.75 1.75-0.785 1.75-1.75-0.785-1.75-1.75-1.75zM11.25 15c-0.413 0-0.75-0.337-0.75-0.75s0.337-0.75 0.75-0.75 0.75 0.337 0.75 0.75-0.337 0.75-0.75 0.75zM13.37 2l-0.301 2h-13.143l1.117 8.036h11.914l1.043-7.5 0.231-1.536h2.769v-1h-3.63zM12.086 11.036h-10.172l-0.84-6.036h11.852l-0.84 6.036zM11 10h-8v-3.969h1v2.969h6v-2.97h1v3.97zM4 2.969h-1v-1.969h8v1.906h-1v-0.906h-6v0.969z" />
		</svg>
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
