<?php
/**
 * The Template for displaying shopping meter.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/shipping-bar.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Bar percentage.
 *
 * @var float $percent - The percentage of the cart amount.
 * @since 1.0.0
 */
$percent = number_format( floatval( $per ), 2 );

/**
 * Amount left.
 *
 * @var float $amount_left - The amount left formatted with two decimal places.
 * @since 1.0.0
 */
$amount_left = number_format( floatval( $left ), 2 );

/**
 * Threshold reached.
 *
 * @var boolean $threshold_reached
 * @since 1.2.0
 */
$threshold_reached = $percent >= 100 && $amount_left <= 0;
?>
<div 
	class="adfy__woofc-shipping-bar 
	<?php echo ( WC()->cart->get_cart_contents_count() > 0 ) ? '' : 'adfy__woofc-hidden'; ?>"
	data-threashold_reached="<?php echo esc_attr( $threshold_reached ? 'true' : 'false' ); ?>" 
>
	<span class="adfy__woofc-shipping-text">
		<?php
		if ( $threshold_reached ) {

			echo esc_html( $post_threshold_label );

		} else {

			echo wp_kses_post( str_replace( '{amount}', wc_price( $left ), $pre_threshold_label ) );
		}
		?>
	</span>
	<div class="progress-bars">
		<div class="total-bar shipping-bar"></div>
		<div
			class="live-progress-bar shipping-bar" 
			data_percentage="<?php echo esc_attr( $percent ); ?>" 
			style="width: <?php echo esc_attr( $percent ); ?>%">
		</div>
	</div>
</div>

