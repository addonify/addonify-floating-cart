<?php
/**
 * The Template for displaying form to apply coupon and display required coupon alerts.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/coupons.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$modal_close_label         = esc_html__( 'Go Back', 'addonify-floating-cart' );
$coupon_field_placeholder  = esc_html__( 'Coupon code', 'addonify-floating-cart' );
$apply_coupon_button_label = esc_html__( 'Apply Coupon', 'addonify-floating-cart' );

if ( '1' === $strings_from_setting ) {
	$saved_modal_close_label = addonify_floating_cart_get_option( 'coupon_shipping_form_modal_exit_label' );
	if ( $saved_modal_close_label ) {
		$modal_close_label = $saved_modal_close_label;
	}

	$saved_coupon_field_placeholder = addonify_floating_cart_get_option( 'coupon_field_placeholder' );
	if ( $saved_coupon_field_placeholder ) {
		$coupon_field_placeholder = $saved_coupon_field_placeholder;
	}

	$saved_apply_coupon_button_label = addonify_floating_cart_get_option( 'cart_apply_coupon_button_label' );
	if ( $saved_apply_coupon_button_label ) {
		$apply_coupon_button_label = $saved_apply_coupon_button_label;
	}
}
?>
<div id="adfy__woofc-coupon-container" data_display="hidden">
	<div class="coupon-container-header">
		<button class="adfy__woofc-fake-button" id="adfy__woofc-hide-coupon-container">
			<svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
			</svg>
			<?php echo esc_html( $modal_close_label ); ?>
		</button>
	</div>
	<form id="adfy__woofc-coupon-form">
		<div class="adfy__woofc-alert success" style="display: none"></div>
		<div class="adfy__woofc-alert error" style="display: none"></div>
		<div class="adfy__woofc-coupon-inputs">
			<?php
			$coupon_form_description = addonify_floating_cart_get_option( 'coupon_from_description' );
			if ( $coupon_form_description ) {
				?>
				<label for="adfy__woofc-coupon-input-field">
					<?php echo esc_html( $coupon_form_description ); ?>
				</label>
				<?php
			}
			?>
			<input
				type="text"
				name="adfy__woofc-coupon-input-field"
				id="adfy__woofc-coupon-input-field"
				placeholder="<?php echo esc_attr( $coupon_field_placeholder ); ?>"
			>
			<button type="submit" class="adfy__woofc-button" id="adfy__woofc-apply-coupon-button">
				<?php echo esc_html( $apply_coupon_button_label ); ?>
			</button>
		</div>
	</form>
	<?php do_action( 'addonify_floating_cart_sidebar_cart_applied_coupons', $strings_from_setting ); ?>
</div>
<?php
