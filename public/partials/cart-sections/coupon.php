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
?>
<div id="adfy__woofc-coupon-container" data_display="hidden">
	<div class="coupon-container-header">
		<button class="adfy__woofc-fake-button" id="adfy__woofc-hide-coupon-container">
			<svg viewBox="0 0 64 64"><g><path d="M10.7,44.3c-0.5,0-1-0.2-1.3-0.6l-6.9-8.2c-1.7-2-1.7-5,0-7l6.9-8.2c0.6-0.7,1.7-0.8,2.5-0.2c0.7,0.6,0.8,1.7,0.2,2.5l-6.5,7.7H61c1,0,1.8,0.8,1.8,1.8c0,1-0.8,1.8-1.8,1.8H5.6l6.5,7.7c0.6,0.7,0.5,1.8-0.2,2.5C11.5,44.2,11.1,44.3,10.7,44.3z"/></g>
			</svg>
			<?php
			$coupon_and_shipping_form_modal_exit_label = addonify_floating_cart_get_option( 'coupon_shipping_form_modal_exit_label' );

			if ( ! $coupon_and_shipping_form_modal_exit_label ) {
				$coupon_and_shipping_form_modal_exit_label = esc_html__( 'Go back', 'addonify-floating-cart' );
			}

			echo esc_html( $coupon_and_shipping_form_modal_exit_label );
			?>
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
					<?php echo esc_html( apply_filters( 'addonify_floating_cart_coupon_code_field_label', __( 'If you have a coupon code, please apply it below.', 'addonify-floating-cart' ) ) ); ?>
				</label>
				<?php
			}

			$coupon_field_placeholder_text = addonify_floating_cart_get_option( 'coupon_field_placeholder' );
			if ( ! $coupon_field_placeholder_text ) {
				$coupon_field_placeholder_text = esc_html__( 'Coupon code', 'addonify-floating-cart' );
			}
			?>
			<input
				type="text"
				name="adfy__woofc-coupon-input-field"
				id="adfy__woofc-coupon-input-field"
				placeholder="<?php echo esc_attr( $coupon_field_placeholder_text ); ?>"
			>
			<button type="submit" class="adfy__woofc-button" id="adfy__woofc-apply-coupon-button">
				<?php
				$coupon_form_submit_button_label = addonify_floating_cart_get_option( 'cart_apply_coupon_button_label' );
				if ( ! $coupon_form_submit_button_label ) {
					$coupon_form_submit_button_label = esc_html__( 'Apply Coupon', 'addonify-floating-cart' );
				}
				echo esc_html( $coupon_form_submit_button_label );
				?>
			</button>
		</div>
	</form>
	<?php do_action( 'addonify_floating_cart_sidebar_cart_applied_coupons', array() ); ?>
</div>
<?php
