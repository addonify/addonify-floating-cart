<?php
/**
 * The Template for displaying quantity field.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/quantity-field.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="adfy__woofc-quantity">
	<form class="adfy__woofc-quantity-form" method="post">
		<button 
			class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-dec-quantity" 
			data-product_id="<?php echo esc_attr( $product_id ); ?>"
			data-product_sku="<?php echo esc_attr( $product_sku ); ?>"
			data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>"
		>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11H7v-2h10v2z"></path></svg>
		</button>
		<input 
			type="number" 
			value="<?php echo esc_attr( $item_quantity ); ?>"
			step="<?php echo esc_attr( $step ); ?>"
			min="<?php echo esc_attr( $min ); ?>"
			max="<?php echo esc_attr( $max ); ?>"
			class="adfy__woofc-quantity-input-field" 
			data-product_id="<?php echo esc_attr( $product_id ); ?>"
			data-product_sku="<?php echo esc_attr( $product_sku ); ?>"
			data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>"
		>
		<button 
			class="adfy__woofc-fake-button adfy__woofc-quantity-input-button adfy__woofc-inc-quantity" 
			data-product_id="<?php echo esc_attr( $product_id ); ?>"
			data-product_sku="<?php echo esc_attr( $product_sku ); ?>"
			data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>"
		>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"></path></svg>
		</button>
	</form>
</div>
<?php
