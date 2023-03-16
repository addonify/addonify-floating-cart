<?php
/**
 * The Template for displaying quantity and price.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/quantity-price.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="adfy__woofc-item-price"> 
	<span class="quantity">
		<div class="adfy__woofc-item-price-multiplier-quantity">
			<?php echo wp_kses_post( $quantity ); ?>
		</div>
		× 
		<span class="woocommerce-Price-amount amount">
		<bdi>
			<?php echo wp_kses_post( $price ); ?>
		</bdi>
		</span>
	</span>
</div>
<?php
