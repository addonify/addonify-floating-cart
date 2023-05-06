<?php
/**
 * The Template for displaying product title.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/title.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="adfy__woofc-item-title">
	<h3 class="woocommerce-loop-product__title">
		<a href="<?php echo esc_url( $product_permalink ); ?>" class="adfy__woofc-link">
			<?php
			if ( $aattributes ) {
				echo esc_html( $product_title ) . ' - ' . esc_html( $aattributes );
			} else {
				echo esc_html( $product_title );
			}
			?>
		</a>
	</h3>
</div>
<?php
