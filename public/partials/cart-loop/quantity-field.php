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
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>
		</button>
		<input
			id="quantity_<?php echo esc_attr( $cart_item_key ); ?>"
			name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
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
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
		</button>
	</form>
</div>
<?php
