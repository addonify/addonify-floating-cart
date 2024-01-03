<?php
/**
 * The Template for displaying footer of floating cart.
 *
 * This template can be overridden by copying it to yourtheme/addonify/floating-cart/footer.php.
 *
 * @package Addonify_Floating_Cart\Public\Partials
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$tax_display_cart = get_option( 'woocommerce_tax_display_cart' );

$sub_total_label          = esc_html__( 'Sub Total ', 'addonify-floating-cart' );
$total_label              = esc_html__( 'Total', 'addonify-floating-cart' );
$coupon_form_toggler_text = esc_html__( 'Have a coupon?', 'addonify-floating-cart' );

if ( '1' === $strings_from_setting ) {

	$saved_sub_total_label = addonify_floating_cart_get_option( 'sub_total_label' );
	if ( $saved_sub_total_label ) {
		$sub_total_label = $saved_sub_total_label;
	}

	$saved_total_label = addonify_floating_cart_get_option( 'total_label' );
	if ( $saved_total_label ) {
		$total_label = $saved_total_label;
	}

	$saved_coupon_form_toggler_text = addonify_floating_cart_get_option( 'coupon_form_toggler_text' );
	if ( $saved_coupon_form_toggler_text ) {
		$coupon_form_toggler_text = $saved_coupon_form_toggler_text;
	}
}
?>
<footer class="adfy__woofc-colophon <?php echo ( WC()->cart->get_cart_contents_count() > 0 ) ? '' : 'adfy__woofc-hidden'; ?>" >
	<?php
	if ( wc_coupons_enabled() ) {
		?>
		<div class="adfy__woofc-coupon">
			<p class="coupon-text">
				<span class="icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.137,24a2.8,2.8,0,0,1-1.987-.835L12,17.051,5.85,23.169a2.8,2.8,0,0,1-3.095.609A2.8,2.8,0,0,1,1,21.154V5A5,5,0,0,1,6,0H18a5,5,0,0,1,5,5V21.154a2.8,2.8,0,0,1-1.751,2.624A2.867,2.867,0,0,1,20.137,24ZM6,2A3,3,0,0,0,3,5V21.154a.843.843,0,0,0,1.437.6h0L11.3,14.933a1,1,0,0,1,1.41,0l6.855,6.819a.843.843,0,0,0,1.437-.6V5a3,3,0,0,0-3-3Z"/></svg>
				</span>
				<a
					href="#" 
					id="adfy__woofc-coupon-trigger" 
					class="adfy__woofc-link has-underline"
				><?php echo esc_html( $coupon_form_toggler_text ); ?></a>
			</p>
		</div>
		<?php
	}
	?>
	<div class="adfy__woofc-cart-summary">
		<ul>
			<li class="sub-total">
				<span class="label"><?php echo esc_html( $sub_total_label ); ?></span>
				<span class="value">
					<span class="addonify-floating-cart-Price-amount subtotal-amount">
						<?php
						$sub_total = WC()->cart->get_cart_subtotal();
						?>
						<?php echo wp_kses_post( $sub_total ); ?>
					</span>
				</span>
			</li>
			<?php
			if ( WC()->cart->get_coupons() ) {
				$discount_label = esc_html__( 'Discount', 'addonify-floating-cart' );

				if ( '1' === $strings_from_setting ) {
					$saved_discount_label = addonify_floating_cart_get_option( 'discount_label' );
					if ( $saved_discount_label ) {
						$discount_label = $saved_discount_label;
					}
				}
				?>
				<li class="discount">
					<span class="label"><?php echo esc_html( $discount_label ); ?></span>
					<span class="value">
						<span class="addonify-floating-cart-Price-amount discount-amount">
							<bdi>
								<?php
								$discount_total = WC()->cart->get_discount_total();
								if ( 'incl' === $tax_display_cart ) {
									$discount_total = WC()->cart->get_discount_tax() + WC()->cart->get_discount_total();
								}

								echo '-' . wc_price( $discount_total ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?>
							</bdi>
						</span>
					</span>
				</li>
				<?php
			}

			if (
				addonify_floating_cart_get_option( 'display_shipping_cost_in_cart_subtotal' ) === '1' &&
				WC()->cart->needs_shipping() &&
				(
					WC()->cart->show_shipping() ||
					'yes' === get_option( 'woocommerce_enable_shipping_calc' )
				)
			) {
				$shipping_label      = esc_html__( 'Shipping', 'addonify-floating-cart' );
				$open_shipping_label = esc_html__( 'Change address', 'addonify-floating-cart' );

				if ( '1' === $strings_from_setting ) {
					$saved_shipping_label = addonify_floating_cart_get_option( 'shipping_label' );
					if ( $saved_shipping_label ) {
						$shipping_label = $saved_shipping_label;
					}

					$saved_open_shipping_label = addonify_floating_cart_get_option( 'open_shipping_label' );
					if ( $saved_open_shipping_label ) {
						$open_shipping_label = $saved_open_shipping_label;
					}
				}
				?>
				<li class="shipping">
					<span class="label">
						<?php echo esc_html( $shipping_label ); ?>
						<a id="adfy__woofc-shipping-trigger" class="adfy__woofc-link adfy__woofc-prevent-default has-underline" href='#'>
							( <?php echo esc_html( $open_shipping_label ); ?> )
						</a>
					</span>

					<span class="value">
						<span class="addonify_floating_cart-Price-amount shipping-amount">
							<?php
							$shipping_total = wc_price( WC()->cart->get_shipping_total() );
							if ( 'incl' === $tax_display_cart ) {
								$shipping_total = wc_price( WC()->cart->get_shipping_total() + WC()->cart->get_shipping_tax() ) . ' <small>' . WC()->countries->inc_tax_or_vat() . '</small>';
							}

							echo $shipping_total; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</span>
					</span>
				</li>
				<?php
			}

			if (
				addonify_floating_cart_get_option( 'display_taxes_in_cart_subtotal' ) &&
				wc_tax_enabled() &&
				! WC()->cart->display_prices_including_tax()
			) {
				$tax_label = esc_html__( 'Tax', 'addonify-floating-cart' );

				if ( '1' === $strings_from_setting ) {
					$saved_tax_label = addonify_floating_cart_get_option( 'tax_label' );
					if ( $saved_tax_label ) {
						$tax_label = $saved_tax_label;
					}
				}

				if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
					foreach ( WC()->cart->get_tax_totals() as $tax_code => $tax_obj ) {
						?>
						<li class="tax tax-rate-<?php echo esc_attr( sanitize_title( $tax_code ) ); ?>">
							<span class="label"><?php echo $tax_obj->label; //phpcs:disable ?></span>
							<span class="value">
								<span class="addonify-floating-cart-Price-amount tax-amount">
									<bdi><?php echo wp_kses_post( $tax_obj->formatted_amount ); ?></bdi>
								</span>
							</span>
						</li>
						<?php
					}
				} else {
					?>
					<li class="tax">
						<span class="label"><?php echo esc_html( $tax_label ); ?></span>
						<span class="value">
							<span class="addonify-floating-cart-Price-amount tax-amount">
								<bdi>
								<?php wc_cart_totals_taxes_total_html(); ?>
								</bdi>
							</span>
						</span>
					</li>
					<?php
				}
				?>
				<?php
			}
			?>
			<li class="total">
				<span class="label"><?php echo esc_html( $total_label ); ?></span>
				<span class="value">
					<span class="addonify-floating-cart-Price-amount total-amount">
						<?php wc_cart_totals_order_total_html(); ?>
					</span>
				</span>
			</li>
		</ul>
	</div>
	<div class="adfy__woofc-actions <?php echo ( (int) addonify_floating_cart_get_option( 'display_continue_shopping_button' ) === 0 || empty( addonify_floating_cart_get_option( 'continue_shopping_button_label' ) ) ) ? 'adfy__woofc-fullwidth' : ''; ?>">
		<?php do_action( 'addonify_floating_cart_cart_footer_button', $strings_from_setting ); ?>
	</div>
</footer>
