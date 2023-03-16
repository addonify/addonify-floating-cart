<?php
/**
 * The Template for displaying cart content.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/body.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<main class="adfy__woofc-content">
	<div class="adfy__woofc-content-entry" id="adfy__woofc-scrollbar">
		<?php
		$cart = WC()->cart->get_cart();
		if ( is_array( $cart ) && ! empty( $cart ) ) {
			foreach ( $cart as $cart_item_key => $cart_item ) {
				$variation = null;
				if ( isset( $cart_item['variation_id'] ) && $cart_item['variation_id'] ) {

					$variation = new WC_Product_Variation( $cart_item['variation_id'] );
				} else {

					$variation = null;
				}
				$product = wc_get_product( $cart_item['product_id'] );
				?>
				<div class="adfy__woofc-item">
					<?php
					do_action(
						'addonify_floating_cart_product_image',
						array(
							'product'       => $product,
							'cart_item_key' => $cart_item_key,
							'cart_item'     => $cart_item,
							'variation'     => $variation,
						)
					);
					?>
					<div class="adfy__woofc-item-content">
						<?php
						do_action(
							'addonify_floating_cart_product_title',
							array(
								'product'   => $product,
								'cart_item' => $cart_item,
							)
						);

						do_action(
							'addonify_floating_cart_product_quantity_price',
							array(
								'product'   => $product,
								'cart_item' => $cart_item,
								'cart_item_key' => $cart_item_key,
								'variation' => $variation,
							)
						);

						do_action(
							'addonify_floating_cart_product_quantity_field',
							array(
								'product'       => $product,
								'cart_item_key' => $cart_item_key,
								'cart_item'     => $cart_item,
							)
						);
						?>
					</div>
				</div>                
				<?php
			}
		} else {
			echo esc_html( apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty.', 'addonify-floating-cart' ) ) );
		}
		?>
	</div>
</main>
<?php
